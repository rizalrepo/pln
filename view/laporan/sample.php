<?php
include '../../app/config.php';

$no = 1;
$user = $_GET['user'];
$cekuser = isset($user);

if ($user == $cekuser) {
    $sql = $con->query("SELECT * FROM user WHERE id_user = '$user' ORDER BY nm_user ASC");
    $dt = $con->query("SELECT * FROM user WHERE id_user = '$user'")->fetch_array();
    $label = 'LAPORAN USER <br> Nama : ' . $dt['nm_user'];
} else {
    $sql = $con->query("SELECT * FROM user ORDER BY nm_user ASC");
    $label = 'LAPORAN USER';
}

require_once '../../assets/vendor/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan User</title>
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
                    <img src="<?= base_url('assets/img/logo.png') ?>" align="left" height="100">
                </td>
                <td align="center">
                    <h1>Aplikasi</h1>
                    <h3>Aplikasi</h3>
                    <h6>Alamat</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/img/pelengkap.png') ?>" align="right" height="100">
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
                            <th>Nama</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = $sql->fetch_array()) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_user']; ?></td>
                            </tr>
                        <?php } ?>
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
                        Mengetahui <br>
                        Nama
                        <br><br><br><br><br>
                        ______________________<br>
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