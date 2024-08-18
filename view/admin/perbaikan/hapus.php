<?php
require '../../../app/config.php';

$id = $_GET['id'];
$ids = $_GET['ids'];

$query = $con->query("DELETE FROM perbaikan WHERE id_perbaikan = '$id' ");
if ($query) {
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=proses?id=$ids'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=proses?id=$ids'>";
}
