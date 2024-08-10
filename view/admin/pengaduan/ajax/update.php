<?php
include '../../../../app/config.php';

if (isset($_POST['id_tanggapan'])) {
    $id = $_POST['id_tanggapan'];
    $pesan_tanggapan = $_POST['pesan_tanggapan'];
    $waktu_tanggapan = date('Y-m-d H:i:s');
    // Ambil data tanggapan yang ada
    $existing_data = $con->query("SELECT bukti_tanggapan FROM tanggapan WHERE id_tanggapan = '$id'")->fetch_assoc();

    // Handling file upload
    if (!empty($_FILES['bukti_tanggapan']['name'])) {
        $file = $_FILES['bukti_tanggapan']['name'];
        $x_file = explode('.', $file);
        $ext_file = end($x_file);
        $bukti_tanggapan = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['bukti_tanggapan']['size'];
        $tmp_file = $_FILES['bukti_tanggapan']['tmp_name'];
        $dir_file = '../../../../storage/tanggapan/';
        $allow_ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
        $allow_size = 2097152; // 2 MB

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                // Hapus file lama jika ada
                if (!empty($existing_data['bukti_tanggapan'])) {
                    $old_file = $dir_file . $existing_data['bukti_tanggapan'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }

                // Upload file baru
                if (move_uploaded_file($tmp_file, $dir_file . $bukti_tanggapan)) {
                    $query = $con->query("UPDATE tanggapan SET pesan_tanggapan = '$pesan_tanggapan', bukti_tanggapan = '$bukti_tanggapan', waktu_tanggapan = '$waktu_tanggapan' WHERE id_tanggapan = '$id'");
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mengupload file baru']);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ukuran file terlalu besar, maksimal 2 MB']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Format file tidak didukung. File harus JPG, JPEG, atau PNG']);
            exit;
        }
    } else {
        // Jika tidak ada file baru diupload, hanya update deskripsi
        $query = $con->query("UPDATE tanggapan SET pesan_tanggapan = '$pesan_tanggapan', waktu_tanggapan = '$waktu_tanggapan' WHERE id_tanggapan = '$id'");
    }

    if ($query) {
        echo json_encode(['status' => 'success', 'message' => 'Data Tanggapan berhasil diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data: ' . $con->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
}
