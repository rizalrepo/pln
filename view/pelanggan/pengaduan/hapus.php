<?php
require '../../../app/config.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'")->fetch_array();
$query = $con->query(" DELETE FROM pengaduan WHERE id_pengaduan = '$id' ");
if ($query) {
    $file = $data['bukti_pengaduan'];
    if (!empty($file)) {
        unlink('../../../storage/pengaduan/' . $file);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
