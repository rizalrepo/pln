<?php
require '../../../../app/config.php';

$bukti_tanggapan = null;
$upload_success = true;

$waktu_tanggapan = date('Y-m-d H:i:s');

// Cek apakah file diupload
if (!empty($_FILES['bukti_tanggapan']['name'])) {
    $file      = $_FILES['bukti_tanggapan']['name'];
    $x_file    = explode('.', $file);
    $ext_file  = end($x_file);
    $bukti_tanggapan = rand(1, 99999) . '.' . $ext_file;
    $size_file = $_FILES['bukti_tanggapan']['size'];
    $tmp_file  = $_FILES['bukti_tanggapan']['tmp_name'];
    $dir_file  = '../../../../storage/tanggapan/';
    $allow_ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
    $allow_size = 2097152;

    if (in_array($ext_file, $allow_ext) === true) {
        if ($size_file <= $allow_size) {
            if (!move_uploaded_file($tmp_file, $dir_file . $bukti_tanggapan)) {
                $upload_success = false;
            }
        } else {
            echo json_encode(['hasil' => 'gagal', 'pesan' => 'Ukuran File Terlalu Besar, Maksimal 2 Mb']);
            exit;
        }
    } else {
        echo json_encode(['hasil' => 'gagal', 'pesan' => 'Format File Tidak Didukung. File Harus JPG, JPEG dan PNG']);
        exit;
    }
}

if ($upload_success) {
    if ($bukti_tanggapan) {
        $tambah = $con->query("INSERT INTO tanggapan VALUES (
            default,
            '$_POST[id_pengaduan]',
            '$_POST[pesan_tanggapan]',
            '$bukti_tanggapan',
            '$waktu_tanggapan'
        )");
    } else {
        $tambah = $con->query("INSERT INTO tanggapan (id_pengaduan, pesan_tanggapan, waktu_tanggapan) VALUES (
            '$_POST[id_pengaduan]',
            '$_POST[pesan_tanggapan]',
            '$waktu_tanggapan'
        )");
    }

    if ($tambah) {
        $con->query("UPDATE pengaduan SET status_pengaduan = 1 WHERE id_pengaduan = '$_POST[id_pengaduan]' ");
        echo json_encode(['hasil' => 'sukses']);
    } else {
        echo json_encode(['hasil' => 'gagal', 'pesan' => 'Gagal menyimpan data tanggapan']);
    }
} else {
    echo json_encode(['hasil' => 'gagal', 'pesan' => 'Gagal mengupload file']);
}
