<!doctype html>

<?php require '../../app/config.php'; ?>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url() ?>/assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Sistem</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/pages/page-auth.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Helpers -->
    <script src="<?= base_url() ?>/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/template-customizer.js"></script>
    <script src="<?= base_url() ?>/assets/js/config.js"></script>

    <style>
        .input-group.input-group-merge> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: -3px !important;
            height: 48px !important;
        }
    </style>
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="<?= base_url() ?>/assets/img/logo.png" alt="logo" width="150px">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h6 class="mb-6 text-center">Login Sistem Layanan Pelanggan dan Monitoring Penyelesaian Laporan Gangguan Kantor Pelayanan PLN Asam Asam</h6>

                        <form class="mb-5 needs-validation" method="POST" novalidate>
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" id="username" class="form-control" name="username" required autofocus />
                                <label for="username">Username</label>
                                <div class="invalid-feedback"> Input Username !</div>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline" style="position: static;">
                                            <input type="password" id="password" class="form-control" name="password" required />
                                            <label for="password">Password</label>
                                            <div class="invalid-feedback"> Input Password !</div>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100" type="submit" name="sign">
                                <span class="d-inline-flex align-items-center justify-content-center">
                                    Sign in <i class="ri-login-box-line ms-1"></i>
                                </span>
                            </button>
                            <p class="text-center mt-4 mb-0">
                                <span>Belum Punya Akun?</span>
                                <a href="daftar">
                                    <span>Daftar Sekarang</span>
                                </a>
                                <br>
                                <a href="<?= base_url() ?>/landing" class="mt-5">Landing Page</a>
                            </p>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
                <img alt="mask" src="<?= base_url() ?>/assets/img/illustrations/auth-basic-login-mask-light.png" class="authentication-image d-none d-lg-block" data-app-light-img="illustrations/auth-basic-login-mask-light.png" data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url() ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url() ?>/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url() ?>/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url() ?>/assets/js/form-validation.js"></script>

    <script src="<?= base_url() ?>/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
</body>

</html>

<?php
if (isset($_POST['sign'])) {
    $user = $con->real_escape_string($_POST['username']);
    $pass = $con->real_escape_string($_POST['password']);

    $pass = md5($pass);
    $query = $con->query("SELECT * FROM user WHERE username = '$user' AND password='$pass'");
    $data = $query->fetch_array();
    $username = $data['username'];
    $password = $data['password'];
    $id = $data['id_user'];
    $id_pelanggan = $data['id_pelanggan'];
    $level = $data['level'];
    $usr = $data['nm_user'];

    if ($user == $username && $pass == $password) {

        $_SESSION["login"] = true;
        $_SESSION['id_user'] = $id;
        $_SESSION['id_pelanggan'] = $id_pelanggan;
        $_SESSION['level'] = $level;
        $_SESSION['nm_user'] = $usr;
        $_SESSION['username'] = $username;

        if ($level == 1 || $level == 3) {
            $url = '../admin/';
        } else if ($level == 2) {
            $url = '../pelanggan/';
        }

        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Login Berhasil',
                    text:  'Kamu Login Sebagai $usr',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });     
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('$url');
            } ,2000);   
        </script>";
    } else {
        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Login Gagal',
                    text:  'Username atau Password Tidak Ditemukan',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });     
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('login');
            } ,2000);   
        </script>";
    }
}
