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
if (!isset($_POST['id_kerusakan'], $_POST['verif'], $_POST['pesan_verifikasi'])) {
    echo debugResponse('error', 'Missing required parameters', ['post_data' => $_POST]);
    exit;
}

$id = $_POST['id_kerusakan'];
$verif = $_POST['verif'];
$pesan_verifikasi = $_POST['pesan_verifikasi'];

$debug_info = [
    'id_kerusakan' => $id,
    'verif' => $verif,
    'pesan_verifikasi' => $pesan_verifikasi,
    'post_data' => $_POST
];

$action = 'proses';

if ($action === 'proses') {
    $now = date('Y-m-d H:i:s');
    $tgl = date('Y-m-d');

    $msg = ($verif == 1) ? 'Disetujui' : 'Ditolak';

    if ($verif == 1) :
        $update = $con->query("UPDATE kerusakan SET 
            status_kerusakan = 0,
            verif = '$verif',
            pesan_verifikasi = '$pesan_verifikasi'
            WHERE id_kerusakan = '$id'
        ");
    else :
        $update = $con->query("UPDATE kerusakan SET 
            verif = '$verif',
            pesan_verifikasi = '$pesan_verifikasi'
            WHERE id_kerusakan = '$id'
        ");
    endif;

    if ($update) {
        echo debugResponse('success', 'Laporan Kerusakan telah ' . $msg, array_merge($debug_info));
    } else {
        echo debugResponse('error', 'Data gagal diproses. Ulangi sekali lagi', array_merge($debug_info, ['sql_error' => $con->error]));
    }
} else {
    echo debugResponse('error', 'Invalid action.', $debug_info);
}
