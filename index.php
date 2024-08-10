<?php
require_once 'app/config.php';
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 3) {
        header('Location: ' . base_url() . '/view/admin');
        exit;
    } else if ($_SESSION['level'] == 2) {
        header('Location: ' . base_url() . '/view/pelanggan');
        exit;
    }
} else {
    header('Location: ' . base_url() . '/landing');
    exit;
}
