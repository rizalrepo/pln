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
if (!isset($_POST['id_pemasangan']) || !isset($_POST['verif'])) {
    echo debugResponse('error', 'Missing required parameters', ['post_data' => $_POST]);
    exit;
}

$id = $_POST['id_pemasangan'];
$verif = $_POST['verif'];

$debug_info = [
    'id_pemasangan' => $id,
    'verif' => $verif,
    'post_data' => $_POST
];

$action = isset($_POST['setuju']) ? 'setuju' : (isset($_POST['tolak']) ? 'tolak' : ($verif == '1' ? 'setuju' : 'tolak'));

if ($action === 'setuju') {
    if (!isset($_POST['tgl_pemasangan'])) {
        echo json_encode(['status' => 'error', 'message' => 'Tanggal pemasangan harus diisi']);
        exit;
    }

    $tgl_pemasangan = $con->real_escape_string($_POST['tgl_pemasangan']);

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

    $update = $con->query("UPDATE pemasangan SET 
        verif = '$verif',
        tgl_pemasangan = '$tgl_pemasangan',
        pesan_ditolak = NULL
        WHERE id_pemasangan = '$id'
    ");

    if ($update) {
        // Proses UP3
        $existing_up3 = $con->query("SELECT id_up3 FROM pemasangan_up3 WHERE id_pemasangan = '$id'")->fetch_all(MYSQLI_ASSOC);
        $existing_up3_ids = array_column($existing_up3, 'id_up3');

        $up3_to_delete = array_diff($existing_up3_ids, $id_up3_array);
        $up3_to_add = array_diff($id_up3_array, $existing_up3_ids);

        if (!empty($up3_to_delete)) {
            $delete_ids = implode(',', array_map([$con, 'real_escape_string'], $up3_to_delete));
            $con->query("DELETE FROM pemasangan_up3 WHERE id_pemasangan = '$id' AND id_up3 IN ($delete_ids)");
        }

        if (!empty($up3_to_add)) {
            $insert_query = "INSERT INTO pemasangan_up3 (id_pemasangan, id_up3) VALUES ";
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

        echo debugResponse('success', 'Pengajuan Pemasangan Baru Disetujui', $debug_info);
    } else {
        echo debugResponse('error', 'Data gagal diverifikasi. Ulangi sekali lagi', array_merge($debug_info, ['sql_error' => $con->error]));
    }
} else if ($action === 'tolak') {
    if (!isset($_POST['pesan_ditolak']) || trim($_POST['pesan_ditolak']) === '') {
        echo debugResponse('error', 'Pesan penolakan harus diisi', $debug_info);
        exit;
    }

    $pesan_ditolak = $_POST['pesan_ditolak'];

    $update = $con->query("UPDATE pemasangan SET 
        verif = '$verif',
        tgl_pemasangan = NULL,
        pesan_ditolak = '$pesan_ditolak'
        WHERE id_pemasangan = '$id'
    ");

    if ($update) {
        $con->query("DELETE FROM pemasangan_up3 WHERE id_pemasangan = '$id'");
        echo debugResponse('success', 'Pengajuan Pemasangan Baru Ditolak', $debug_info);
    } else {
        echo debugResponse('error', 'Data gagal diverifikasi. Ulangi sekali lagi', array_merge($debug_info, ['sql_error' => $con->error]));
    }
} else {
    echo debugResponse('error', 'Invalid action. Neither setuju nor tolak is set.', $debug_info);
}
