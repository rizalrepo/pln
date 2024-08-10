<?php
include '../../../../app/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = $con->query("SELECT * FROM tanggapan WHERE id_tanggapan = '$id'");
    $data = $query->fetch_assoc();

    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
}
