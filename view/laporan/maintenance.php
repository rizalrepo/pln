<?php
include '../../app/config.php';

$no = 1;
$gardu = isset($_GET['gardu']) ? $_GET['gardu'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : null;

$query = "SELECT * FROM maintenance a LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE 1 = 1";
$conditions = [];
$label_parts = [];

if ($gardu !== null && $gardu !== '') {
    $conditions[] = "a.id_gardu = '$gardu'";
    $rowt = $con->query("SELECT * FROM gardu WHERE id_gardu = '$gardu'")->fetch_array();
    $label_parts['gardu'] = "Area : " . $rowt['area'];
}

// Menangani bulan dan tahun
if ($bulan && $tahun) {
    $conditions[] = "MONTH(a.tgl_mulai_maintenance) = '$bulan' AND YEAR(a.tgl_mulai_maintenance) = '$tahun'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan) . " " . $tahun;
} elseif ($bulan) {
    $conditions[] = "MONTH(a.tgl_mulai_maintenance) = '$bulan'";
    $label_parts['periode'] = "Bulan : " . bulan($bulan);
} elseif ($tahun) {
    $conditions[] = "YEAR(a.tgl_mulai_maintenance) = '$tahun'";
    $label_parts['periode'] = "Tahun : " . $tahun;
} else {
    $orderBy = " ORDER BY id_maintenance DESC";
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
$label = 'LAPORAN MAINTENANCE';
if (!empty($label_parts)) {
    $label .= '<br>' . implode('<br>', $label_parts);
}

require_once '../../assets/vendor/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN MAINTENANCE</title>
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
                            <th>Nama Gardu</th>
                            <th>Area</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>UP3</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sql as $row) :
                        ?>
                            <tr>
                                <td align="center"><?= $no++; ?></td>
                                <td><?= $row['nm_gardu'] ?></td>
                                <td align="center"><?= $row['area'] ?></td>
                                <td align="center"><?= $row['tgl_mulai_maintenance'] !== $row['tgl_selesai_maintenance'] ? tgl($row['tgl_mulai_maintenance']) . ' - ' . tgl($row['tgl_selesai_maintenance']) : tgl($row['tgl_mulai_maintenance']) ?></td>
                                <td><?= nl2br($row['deskripsi_maintenance']) ?></td>
                                <td>
                                    <?php $dataPetugas = $con->query("SELECT * FROM maintenance_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_maintenance = '$row[id_maintenance]' "); ?>
                                    <?php
                                    $no2 = 1;
                                    while ($d2 = $dataPetugas->fetch_assoc()) {
                                        echo '<span class="me-2 mt-1">' . $no2++ . '.</span>';
                                        echo $d2['nm_up3'];
                                        echo '<hr style="margin: 3px 0;">';
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php if ($row['tgl_mulai_maintenance'] > date('Y-m-d')) : ?>
                                        Belum Berjalan
                                    <?php elseif ($row['tgl_selesai_maintenance'] < date('Y-m-d')) : ?>
                                        Selesai
                                    <?php elseif ($row['tgl_mulai_maintenance'] >= date('Y-m-d') && $row['tgl_selesai_maintenance'] >= date('Y-m-d')) : ?>
                                        Sedang Berjalan
                                    <?php endif ?>
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