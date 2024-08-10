<?php
include '../../../../app/config.php';

$response = ['status' => 'error', 'message' => 'Terjadi kesalahan'];

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $data = $con->query("SELECT * FROM tanggapan WHERE id_tanggapan = '$id'")->fetch_array();
    $query = $con->query("DELETE FROM tanggapan WHERE id_tanggapan = '$id'");

    if ($query) {
        $bukti = $data['bukti_tanggapan'];
        if ($bukti != null) {
            $file_path = '../../../../storage/tanggapan/' . $bukti;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $response = ['status' => 'success', 'message' => 'Data Tanggapan Berhasil Dihapus'];
    } else {
        $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'ID tidak ditemukan'];
}

echo json_encode($response);
