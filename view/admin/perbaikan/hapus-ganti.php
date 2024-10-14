<?php
require '../../../app/config.php';

$id = $_GET['id'];
$ids = $_GET['ids'];

$data = $con->query("SELECT * FROM barang_keluar WHERE id_barang_keluar = '$id' ")->fetch_array();
$query = $con->query(" DELETE FROM barang_keluar WHERE id_barang_keluar = '$id' ");
if ($query) {
    $con->query("UPDATE barang SET stok = (stok + '$data[jumlah]') WHERE id_barang = '$data[id_barang]'");
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=ganti?id=$ids'>";
} else {
    $_SESSION['error'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=ganti?id=$ids'>";
}
