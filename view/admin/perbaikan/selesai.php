<?php
require '../../../app/config.php';

$id = $_GET['id'];

$query = $con->query("UPDATE kerusakan SET status_kerusakan = 1 WHERE id_kerusakan = '$id'");
if ($query) {
    $query = $con->query("UPDATE perbaikan SET status_perbaikan = 1 WHERE id_kerusakan = '$id'");
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
