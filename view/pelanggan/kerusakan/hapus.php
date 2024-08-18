<?php
require '../../../app/config.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM kerusakan WHERE id_kerusakan = '$id'")->fetch_array();
$query = $con->query(" DELETE FROM kerusakan WHERE id_kerusakan = '$id' ");
if ($query) {
    $file = $data['bukti_kerusakan'];
    if (!empty($file)) {
        unlink('../../../storage/kerusakan/' . $file);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
