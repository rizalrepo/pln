<?php
require '../../../app/config.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fungsi untuk menambahkan informasi debug ke respons
function debugResponse($status, $message, $debug = [])
{
    return json_encode([
        'status' => $status,
        'message' => $message,
        'debug' => $debug
    ]);
}

// Periksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo debugResponse('error', 'Invalid request method', ['method' => $_SERVER['REQUEST_METHOD']]);
    exit;
}

// Periksa keberadaan parameter yang diperlukan
if (!isset($_POST['id_ubah_daya']) || !isset($_POST['verif_ubah_daya'])) {
    echo debugResponse('error', 'Missing required parameters', ['post_data' => $_POST]);
    exit;
}

$id = $_POST['id_ubah_daya'];

$ubah_daya_data = $con->query("SELECT id_daya, id_pemasangan FROM ubah_daya WHERE id_ubah_daya = '$id' ")->fetch_array();

$verif_ubah_daya = $_POST['verif_ubah_daya'];

$debug_info = [
    'id_ubah_daya' => $id,
    'verif_ubah_daya' => $verif_ubah_daya,
    'post_data' => $_POST
];

$action = isset($_POST['setuju']) ? 'setuju' : (isset($_POST['tolak']) ? 'tolak' : ($verif_ubah_daya == '1' ? 'setuju' : 'tolak'));

if ($action === 'setuju') {
    if (!isset($_POST['tgl_ubah_daya'])) {
        echo json_encode(['status' => 'error', 'message' => 'Tanggal ubah_daya harus diisi']);
        exit;
    }

    $tgl_ubah_daya = $con->real_escape_string($_POST['tgl_ubah_daya']);

    $id_up3_array = [];
    if (isset($_POST['id_up3'])) {
        if (is_array($_POST['id_up3'])) {
            foreach ($_POST['id_up3'] as $id_up3) {
                $id_up3_array[] = $con->real_escape_string($id_up3);
            }
        } else {
            // Jika hanya satu nilai yang dikirim (bukan array)
            $id_up3_array[] = $con->real_escape_string($_POST['id_up3']);
        }
    }

    // Untuk debugging
    $debug_info['id_up3_array'] = $id_up3_array;

    $update = $con->query("UPDATE ubah_daya SET 
        verif_ubah_daya = '$verif_ubah_daya',
        tgl_ubah_daya = '$tgl_ubah_daya',
        ubah_daya_ditolak = NULL
        WHERE id_ubah_daya = '$id'
    ");

    if ($update) {
        // Proses UP3
        $existing_up3 = $con->query("SELECT id_up3 FROM ubah_daya_up3 WHERE id_ubah_daya = '$id'")->fetch_all(MYSQLI_ASSOC);
        $existing_up3_ids = array_column($existing_up3, 'id_up3');

        $up3_to_delete = array_diff($existing_up3_ids, $id_up3_array);
        $up3_to_add = array_diff($id_up3_array, $existing_up3_ids);

        if (!empty($up3_to_delete)) {
            $delete_ids = implode(',', array_map([$con, 'real_escape_string'], $up3_to_delete));
            $con->query("DELETE FROM ubah_daya_up3 WHERE id_ubah_daya = '$id' AND id_up3 IN ($delete_ids)");
        }

        if (!empty($up3_to_add)) {
            $insert_query = "INSERT INTO ubah_daya_up3 (id_ubah_daya, id_up3) VALUES ";
            $insert_values = [];
            foreach ($up3_to_add as $id_up3) {
                $id_up3 = $con->real_escape_string($id_up3);
                $insert_values[] = "('$id', '$id_up3')";
            }
            $insert_query .= implode(", ", $insert_values);

            // Tambahkan penanganan error untuk query INSERT
            if (!$con->query($insert_query)) {
                echo debugResponse('error', 'Gagal menambahkan UP3', [
                    'sql_error' => $con->error,
                    'insert_query' => $insert_query
                ]);
                exit;
            }
        }

        $con->query("UPDATE pemasangan SET id_daya = '$ubah_daya_data[id_daya]' WHERE id_pemasangan = '$ubah_daya_data[id_pemasangan]' ");

        echo debugResponse('success', 'Pengajuan Ubah Daya Disetujui', $debug_info);
    } else {
        echo debugResponse('error', 'Data gagal diverifikasi. Ulangi sekali lagi', array_merge($debug_info, ['sql_error' => $con->error]));
    }
} else if ($action === 'tolak') {
    if (!isset($_POST['ubah_daya_ditolak']) || trim($_POST['ubah_daya_ditolak']) === '') {
        echo debugResponse('error', 'Pesan penolakan harus diisi', $debug_info);
        exit;
    }

    $ubah_daya_ditolak = $_POST['ubah_daya_ditolak'];

    $update = $con->query("UPDATE ubah_daya SET 
        verif_ubah_daya = '$verif_ubah_daya',
        tgl_ubah_daya = NULL,
        ubah_daya_ditolak = '$ubah_daya_ditolak'
        WHERE id_ubah_daya = '$id'
    ");

    if ($update) {
        $con->query("DELETE FROM ubah_daya_up3 WHERE id_ubah_daya = '$id'");
        echo debugResponse('success', 'Pengajuan Ubah Daya Ditolak', $debug_info);
    } else {
        echo debugResponse('error', 'Data gagal diverifikasi. Ulangi sekali lagi', array_merge($debug_info, ['sql_error' => $con->error]));
    }
} else {
    echo debugResponse('error', 'Invalid action. Neither setuju nor tolak is set.', $debug_info);
}
