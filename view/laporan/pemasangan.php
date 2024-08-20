<?php
include '../../app/config.php';

$no = 1;
$daya = isset($_GET['daya']) ? $_GET['daya'] : null;
$gardu = isset($_GET['gardu']) ? $_GET['gardu'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : null;

$query = "SELECT * FROM pemasangan a LEFT JOIN daya b ON a.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE 1 = 1";
$conditions = [];
$label_parts = [];

// Menambahkan kondisi berdasarkan parameter yang ada
if ($daya !== null && $daya !== '') {
    $conditions[] = "a.id_daya = '$daya'";
    $rowt = $con->query("SELECT * FROM daya WHERE id_daya = '$daya'")->fetch_array();
    $label_parts['daya'] = "Daya : " . $rowt['jenis_daya'] . ' | ' . $rowt['jml_daya'];
}

if ($gardu !== null && $gardu !== '') {
    $conditions[] = "a.id_gardu = '$gardu'";
    $rowt = $con->query("SELECT * FROM gardu WHERE id_gardu = '$gardu'")->fetch_array();
    $label_parts['gardu'] = "Area : " . $rowt['area'];
}

// Menangani bulan dan tahun
if ($bulan && $tahun) {
    $conditions[] = "MONTH(a.waktu_pengajuan) = '$bulan' AND YEAR(a.waktu_pengajuan) = '$tahun'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan) . " " . $tahun;
} elseif ($bulan) {
    $conditions[] = "MONTH(a.waktu_pengajuan) = '$bulan'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan);
} elseif ($tahun) {
    $conditions[] = "YEAR(a.waktu_pengajuan) = '$tahun'";
    $label_parts['periode'] = "Tahun : " . $tahun;
} else {
    $orderBy = " ORDER BY id_pemasangan DESC";
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
$label = 'LAPORAN PEMASANGAN DAYA';
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
    <title>LAPORAN PEMASANGAN DAYA</title>
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
                            <th>Alamat Pelanggan</th>
                            <th>Nomor Handphone</th>
                            <th>Daya</th>
                            <th>Biaya Pasang</th>
                            <th>Alamat Pemasangan</th>
                            <th>Waktu Pengajuan</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sql as $row) :
                        ?>
                            <tr>
                                <td align="center" rowspan="2"><?= $no++; ?></td>
                                <td><?= $row['no_pemasangan'] ?></td>
                                <td><?= $row['nm_pelanggan'] ?></td>
                                <td align="center">
                                    <?= $row['nik_pelanggan'] ?>
                                </td>
                                <td><?= $row['alamat_pelanggan'] ?></td>
                                <td align="center"><?= $row['hp_pelanggan'] ?></td>
                                <td><?= $row['jenis_daya'] . ' - ' . $row['jml_daya'] ?></td>
                                <td align="center"><?= rupiah($row['biaya_pasang']) ?></td>
                                <td><?= $row['area'] . ' - ' . $row['alamat_pemasangan'] ?></td>
                                <td align="center"><?= tglWaktu($row['waktu_pengajuan']) ?></td>
                                <td align="center">
                                    <?php if ($row['verif'] == 1) : ?>
                                        Disetujui
                                    <?php elseif ($row['verif'] == 2) : ?>
                                        Ditolak
                                    <?php else : ?>
                                        Menunggu Verifikasi
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <strong>Keterangan:</strong>
                                    <?php if ($row['verif'] == 1) : ?>
                                        Pemasangan Baru telah Disetujui, Pemasangan akan dilakukan pada tanggal <?= tgl($row['tgl_pemasangan']) ?> oleh Petugas dibawah ini ; <br>
                                        <?php
                                        $dataPetugas = $con->query("SELECT * FROM pemasangan_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_pemasangan = '$row[id_pemasangan]' ");
                                        $no2 = 1;
                                        foreach ($dataPetugas as $row2) :
                                            echo $no2++ . '. ' . $row2['nm_up3'] . '<br>';
                                        endforeach;
                                        ?>
                                    <?php elseif ($row['verif'] == 2) : ?>
                                        Pemasangan Baru ditolak karena <?= $row['pesan_ditolak'] ?>
                                    <?php else : ?>
                                        Menunggu Verifikasi
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