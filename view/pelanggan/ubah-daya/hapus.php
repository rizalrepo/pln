<?php
require '../../../app/config.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM ubah_daya WHERE id_ubah_daya = '$id'")->fetch_array();
$query = $con->query(" DELETE FROM ubah_daya WHERE id_ubah_daya = '$id' ");
if ($query) {
    $file = $data['bukti_pembayaran'];
    if (!empty($file)) {
        unlink('../../../storage/pembayaran/' . $file);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    $_SESSION['pesan'] = "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
