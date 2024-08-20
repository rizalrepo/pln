<?php
include '../../app/config.php';

$no = 1;

$query = "SELECT * FROM v_rekap_semua_aktivitas_up3";
// Eksekusi query
$sql = $con->query($query);

// Menyusun label
$label = 'REKAPITULASI AKTIVITAS UP3';

require_once '../../assets/vendor/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>REKAPITULASI AKTIVITAS UP3</title>
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
                            <th width="3%">No</th>
                            <th>Kode</th>
                            <th>Nama Lengkap</th>
                            <th>Usia</th>
                            <th>Alamat</th>
                            <th>Masa Kerja</th>
                            <th>Pemasangan Baru</th>
                            <th>Ubah Daya</th>
                            <th>Perbaikan</th>
                            <th>Maintenance</th>
                            <th>Total Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sql as $row) :
                        ?>
                            <tr>
                                <td align="center"><?= $no++; ?></td>
                                <td align="center"><?= $row['kode_up3'] ?></td>
                                <td><?= $row['nm_up3'] ?></td>
                                <td align="center"><?= usia($row['tgl_lahir_up3']) ?></td>
                                <td><?= $row['alamat_up3'] ?></td>
                                <td align="center"><?= usia($row['tmt']) ?></td>
                                <td align="center"><?= $row['jumlah_pemasangan'] ?> Pemasangan</td>
                                <td align="center"><?= $row['jumlah_ubah_daya'] ?> Ubah Daya</td>
                                <td align="center"><?= $row['jumlah_perbaikan'] ?> Perbaikan</td>
                                <td align="center"><?= $row['jumlah_maintenance'] ?> Maintenance</td>
                                <td align="center"><?= $row['total_aktivitas'] ?> Aktivitas</td>
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