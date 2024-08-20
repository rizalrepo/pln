<?php
include '../../app/config.php';

$no = 1;
$daya = isset($_GET['daya']) ? $_GET['daya'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : null;

$query = "SELECT * FROM ubah_daya ub LEFT JOIN pemasangan a ON ub.id_pemasangan = a.id_pemasangan LEFT JOIN daya b ON ub.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE 1 = 1";
$conditions = [];
$label_parts = [];

// Menambahkan kondisi berdasarkan parameter yang ada
if ($daya !== null && $daya !== '') {
    $conditions[] = "ub.id_daya = '$daya'";
    $rowt = $con->query("SELECT * FROM daya WHERE id_daya = '$daya'")->fetch_array();
    $label_parts['daya'] = "Daya : " . $rowt['jenis_daya'] . ' | ' . $rowt['jml_daya'];
}

// Menangani bulan dan tahun
if ($bulan && $tahun) {
    $conditions[] = "MONTH(ub.waktu_pengajuan_ubah_daya) = '$bulan' AND YEAR(ub.waktu_pengajuan_ubah_daya) = '$tahun'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan) . " " . $tahun;
} elseif ($bulan) {
    $conditions[] = "MONTH(ub.waktu_pengajuan_ubah_daya) = '$bulan'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan);
} elseif ($tahun) {
    $conditions[] = "YEAR(ub.waktu_pengajuan_ubah_daya) = '$tahun'";
    $label_parts['periode'] = "Tahun : " . $tahun;
} else {
    $orderBy = " ORDER BY id_ubah_daya DESC";
}

// Menggabungkan kondisi jika ada
if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}

// Menambahkan pengurutan
$query .= $orderBy;

// Eksekusi query
$sql = $con->query($query);

// Menyusun label
$label = 'LAPORAN UBAH DAYA';
if (!empty($label_parts)) {
    $label .= '<br>' . implode('<br>', $label_parts);
}

require_once '../../assets/vendor/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [439, 235]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN UBAH DAYA</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/img/logo.jpg') ?>" align="left" height="80">
                </td>
                <td align="center">
                    <h1>PT PLN (Persero)</h1>
                    <h3>KANTOR PELAYANAN PLN ASAM ASAM</h3>
                    <h6>Desa Asam Asam, Kecamatan Jorong, Kabupaten Tanah Laut Provinsi Kalimantan Selatan Kodepos 70881</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/img/pelengkap.jpg') ?>" align="right" height="80">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#666CFF" align="center">
                            <th>No</th>
                            <th>Nomor Pemasangan</th>
                            <th>Nama Pelanggan</th>
                            <th>NIK</th>
                            <th>Nomor Handphone</th>
                            <th>Alamat Pengajuan</th>
                            <th>Daya Sekarang</th>
                            <th>Pengajuan Ubah Daya</th>
                            <th>Biaya Ubah Daya</th>
                            <th>Waktu Pengajuan</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sql as $row) :
                            $old = $con->query("SELECT * FROM ubah_daya a LEFT JOIN daya b ON a.id_daya_lama = b.id_daya LEFT JOIN pemasangan c ON a.id_pemasangan = c.id_pemasangan WHERE a.id_ubah_daya = '$row[id_ubah_daya]'")->fetch_array();
                        ?>
                            <tr>
                                <td align="center" rowspan="2"><?= $no++; ?></td>
                                <td><?= $row['no_ubah_daya'] ?></td>
                                <td><?= $row['nm_pelanggan'] ?></td>
                                <td align="center">
                                    <?= $row['nik_pelanggan'] ?>
                                </td>
                                <td align="center"><?= $row['hp_pelanggan'] ?></td>
                                <td><?= $row['area'] . ' - ' . $row['alamat_pemasangan'] ?></td>
                                <td align="center"><?= $old['jenis_daya'] . ' - ' . $old['jml_daya'] ?></td>
                                <td align="center"><?= $row['jenis_daya'] . ' - ' . $row['jml_daya'] ?></td>
                                <td align="center"><?= rupiah($row['biaya_ubah_daya']) ?></td>
                                <td align="center"><?= tglWaktu($row['waktu_pengajuan_ubah_daya']) ?></td>
                                <td align="center">
                                    <?php if ($row['verif_ubah_daya'] == 1) : ?>
                                        Disetujui
                                    <?php elseif ($row['verif_ubah_daya'] == 2) : ?>
                                        Ditolak
                                    <?php else : ?>
                                        Menunggu Verifikasi
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <strong>Keterangan:</strong>
                                    <?php if ($row['verif_ubah_daya'] == 1) : ?>
                                        Pengajuan Ubah Daya telah Disetujui, Ubah Daya akan dilakukan pada tanggal <?= tgl($row['tgl_ubah_daya']) ?> oleh Petugas dibawah ini ; <br>
                                        <?php
                                        $dataPetugas = $con->query("SELECT * FROM ubah_daya_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_ubah_daya = '$row[id_ubah_daya]' ");
                                        $no2 = 1;
                                        foreach ($dataPetugas as $row2) :
                                            echo $no2++ . '. ' . $row2['nm_up3'] . '<br>';
                                        endforeach;
                                        ?>
                                    <?php elseif ($row['verif_ubah_daya'] == 2) : ?>
                                        Ubah Daya ditolak karena <?= $row['pesan_ditolak'] ?>
                                    <?php else : ?>
                                        Menunggu verif_ubah_dayaikasi
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="85%">
                </td>
                <td align="center">
                    <h6>
                        <?= tgl_indo(date('Y-m-d')) ?><br>
                        Mengetahui, <br>
                        Direktur Pelayanan <br> PLN Asam Asam
                        <br><br><br><br><br><br>
                        ________________________________<br>
                        <br>
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>