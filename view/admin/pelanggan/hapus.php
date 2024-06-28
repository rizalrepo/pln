<?php
require '../../../app/config.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'")->fetch_array();
$query = $con->query(" DELETE FROM pelanggan WHERE id_pelanggan = '$id' ");
if ($query) {
    $file = $data['file_ktp'];
    if (!empty($file)) {
        unlink('../../../storage/ktp/' . $file);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
