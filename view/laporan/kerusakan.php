<?php
include '../../app/config.php';

$no = 1;
$gardu = isset($_GET['gardu']) ? $_GET['gardu'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : null;

$query = "SELECT * FROM kerusakan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE 1 = 1";
$conditions = [];
$label_parts = [];

if ($gardu !== null && $gardu !== '') {
    $conditions[] = "a.id_gardu = '$gardu'";
    $rowt = $con->query("SELECT * FROM gardu WHERE id_gardu = '$gardu'")->fetch_array();
    $label_parts['gardu'] = "Area : " . $rowt['area'];
}

// Menangani bulan dan tahun
if ($bulan && $tahun) {
    $conditions[] = "MONTH(a.waktu_laporan) = '$bulan' AND YEAR(a.waktu_laporan) = '$tahun'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan) . " " . $tahun;
} elseif ($bulan) {
    $conditions[] = "MONTH(a.waktu_laporan) = '$bulan'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan);
} elseif ($tahun) {
    $conditions[] = "YEAR(a.waktu_laporan) = '$tahun'";
    $label_parts['periode'] = "Tahun : " . $tahun;
} else {
    $orderBy = " ORDER BY id_kerusakan DESC";
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
$label = 'LAPORAN KERUSAKAN';
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
    <title>LAPORAN KERUSAKAN</title>
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
                            <th>Nama Pelanggan</th>
                            <th>NIK</th>
                            <th>Alamat Pelanggan</th>
                            <th>Nomor Handphone</th>
                            <th>Pesan Kerusakan</th>
                            <th>Area Kerusakan</th>
                            <th>Waktu Laporan</th>
                            <th>Status Laporan</th>
                            <th>Pesan Verifikasi</th>
                            <th>Status Perbaikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sql as $row) :
                        ?>
                            <tr>
                                <td align="center"><?= $no++; ?></td>
                                <td><?= $row['nm_pelanggan'] ?></td>
                                <td align="center">
                                    <?= $row['nik_pelanggan'] ?>
                                </td>
                                <td><?= $row['alamat_pelanggan'] ?></td>
                                <td align="center"><?= $row['hp_pelanggan'] ?></td>
                                <td><?= nl2br($row['pesan_kerusakan']) ?></td>
                                <td align="center"><?= $row['area'] ?></td>
                                <td align="center"><?= tglWaktu($row['waktu_laporan']) ?></td>
                                <td align="center">
                                    <?php if ($row['verif'] == 1) : ?>
                                        Disetujui
                                    <?php elseif ($row['verif'] == 2) : ?>
                                        Ditolak
                                    <?php else : ?>
                                        Menunggu Verifikasi
                                    <?php endif; ?>
                                </td>
                                <td><?= nl2br($row['pesan_verifikasi']) ?></td>\
                                <td align="center">
                                    <?php if ($row['status_kerusakan'] == 1) : ?>
                                        Perbaikan Selesai
                                    <?php elseif ($row['status_kerusakan'] == 0) : ?>
                                        Menunggu Perbaikan
                                    <?php else : ?>
                                        Laporan Ditolak
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