<!doctype html>
<?php
require_once '../../app/config.php';

$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

// Mengambil data dari session jika ada
$post_data = get_form_data();
?>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url() ?>/assets/" data-template="front-pages" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Landing Page Pelayanan PLN Asam Asam</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/fonts/remixicon/remixicon.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/pages/front-page.css" />
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/nouislider/nouislider.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/swiper/swiper.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/pages/front-page-landing.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/select2/select2.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- custom -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/custom/style.min.css">


    <!-- Helpers -->
    <script src="<?= base_url() ?>/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/template-customizer.js"></script>
    <script src="<?= base_url() ?>/assets/js/front-config.js"></script>
</head>

<body>
    <script src="<?= base_url() ?>/assets/vendor/js/dropdown-hover.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/mega-dropdown.js"></script>

    <!-- Navbar: Start -->
    <nav class="layout-navbar container shadow-none py-0">
        <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-6">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="#" class="app-brand-link">
                    <a href="#" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="<?= base_url() ?>/assets/img/logo.png" width="38px" alt="logo">
                        </span>
                        <span class="app-brand-text demo menu-text fw-semibold">Asam Asam</span>
                    </a>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="tf-icons ri-close-fill"></i>
                </button>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow me-sm-4" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ri-22px text-heading"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- navbar button: Start -->
                <li>
                    <a href="login" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4" target="_blank"><span class="tf-icons ri-user-star-line me-md-1"></span><span class="d-none d-md-block">Login</span></a>
                </li>
                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="landingHero" class="section-py landing-hero position-relative">
            <img src="<?= base_url() ?>/assets/img/front-pages/backgrounds/hero-bg-light.png" alt="hero background" class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1" data-app-light-img="front-pages/backgrounds/hero-bg-light.png" data-app-dark-img="front-pages/backgrounds/hero-bg-dark.png" />
            <div class="container">
                <div class="card">
                    <div class="justify-content-between d-flex align-items-center">
                        <h5 class="card-header">
                            <i class="menu-icon tf-icons ri-user-star-line me-2"></i>Pendaftaran Pelanggan PLN Asam Asam
                        </h5>
                    </div>
                    <hr class="my-0">
                    <div class="card-body pt-6">
                        <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                            <div id="notif-failed" class="alert alert-solid-danger d-flex align-items-center" role="alert">
                                <i class="ri-error-warning-line me-2"></i>
                                <div>
                                    <b><?= $_SESSION['pesan'] ?></b>
                                </div>
                            </div>
                        <?php
                            $_SESSION['pesan'] = '';
                        }
                        ?>
                        <form class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nm_pelanggan" class="form-control" value="<?= isset($_POST['nm_pelanggan']) ? htmlspecialchars($_POST['nm_pelanggan']) : form_value('nm_pelanggan') ?>" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nik_pelanggan" class="form-control" maxlength="16" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?= isset($_POST['nik_pelanggan']) ? htmlspecialchars($_POST['nik_pelanggan']) : form_value('nik_pelanggan') ?>" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <?= form_dropdown('jk_pelanggan', $jk, isset($_POST['jk_pelanggan']) ? $_POST['jk_pelanggan'] : form_value('jk_pelanggan'), 'class="form-select select2" required') ?>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pekerjaan" class="form-control" value="<?= isset($_POST['pekerjaan']) ? htmlspecialchars($_POST['pekerjaan']) : form_value('pekerjaan') ?>" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat_pelanggan" class="form-control" required><?= isset($_POST['alamat_pelanggan']) ? htmlspecialchars($_POST['alamat_pelanggan']) : form_value('alamat_pelanggan') ?></textarea>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Scan KTP</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file_ktp" class="form-control" accept="image/*" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                    <small class="text-white fw-bold badge bg-primary">Hanya file gambar yang diizinkan (JPG, JPEG, PNG, GIF). Maksimum 2MB.</small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="hp_pelanggan" class="form-control" value="<?= isset($_POST['hp_pelanggan']) ? htmlspecialchars($_POST['hp_pelanggan']) : form_value('hp_pelanggan') ?>" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email_pelanggan" class="form-control" value="<?= isset($_POST['email_pelanggan']) ? htmlspecialchars($_POST['email_pelanggan']) : form_value('email_pelanggan') ?>" required>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="row justify-content-end">
                                    <div class="col-sm-9 text-end">
                                        <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

    </div>

    <!-- / Sections:End -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url() ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/node-waves/node-waves.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url() ?>/assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/swiper/swiper.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url() ?>/assets/js/front-main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url() ?>/assets/js/front-page-landing.js"></script>

    <script src="<?= base_url() ?>/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="<?= base_url() ?>/assets/js/extended-ui-sweetalert2.js"></script>

    <script src="<?= base_url() ?>/assets/vendor/libs/select2/select2.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>

    <script src="<?= base_url() ?>/assets/vendor/libs/datatables/dataTables.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/datatables/dataTables.bootstrap5.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/datatables/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/libs/datatables/responsive.bootstrap5.js"></script>

    <script src="<?= base_url() ?>/assets/js/form-validation.js"></script>
    <script src="<?= base_url() ?>/assets/js/form-layouts.js"></script>

    <script src="<?= base_url() ?>/assets/custom/script.min.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        $nm_pelanggan = $_POST['nm_pelanggan'];
        $nik_pelanggan = $_POST['nik_pelanggan'];
        $jk_pelanggan = $_POST['jk_pelanggan'];
        $pekerjaan = $_POST['pekerjaan'];
        $alamat_pelanggan = $_POST['alamat_pelanggan'];
        $hp_pelanggan = $_POST['hp_pelanggan'];
        $email_pelanggan = $_POST['email_pelanggan'];
        $time = date('Y-m-d H:i:s');

        $f_ktp = "";
        if (!empty($_FILES['file_ktp']['name'])) {
            // UPLOAD FILE 
            $file      = $_FILES['file_ktp']['name'];
            $x_file    = explode('.', $file);
            $ext_file  = end($x_file);
            $file_ktp = rand(1000000, 9999999) . '.' . $ext_file;
            $size_file = $_FILES['file_ktp']['size'];
            $tmp_file  = $_FILES['file_ktp']['tmp_name'];
            $dir_file  = '../../storage/ktp/';
            $allow_ext        = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF');
            $allow_size       = 2097152; // 2 MB

            if (in_array($ext_file, $allow_ext) === true) {
                if ($size_file <= $allow_size) {
                    move_uploaded_file($tmp_file, $dir_file . $file_ktp);
                    $f_ktp .= "Upload Success";
                } else {
                    echo "
                    <script type='text/javascript'>
                        Swal.fire({
                            text:  'Ukuran File Terlalu Besar, Maksimal 2 Mb',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false
                        }); 
                    </script>";
                    return;
                }
            } else {
                echo "
                <script type='text/javascript'>
                    Swal.fire({
                        text:  'Format File Tidak Didukung. File Harus Berupa Gambar',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    }); 
                </script>";
                return;
            }
        } else {
            echo "
            <script type='text/javascript'>
                Swal.fire({
                    text:  'File KTP harus diupload',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                }); 
            </script>";
            return;
        }

        if (!empty($f_ktp)) {
            $tambah = $con->query("INSERT INTO pelanggan VALUES (
                default, 
                '$nm_pelanggan', 
                '$nik_pelanggan',
                '$jk_pelanggan',
                '$pekerjaan',
                '$alamat_pelanggan',
                '$file_ktp',
                '$hp_pelanggan',
                '$email_pelanggan',
                '$time'
            )");

            if ($tambah) {
                $pw = md5($nik_pelanggan);
                $id_pelanggan = $con->insert_id;

                $con->query("INSERT INTO user (id_pelanggan, nm_user, username, password, level) VALUES (
                    '$id_pelanggan',
                    '$nm_pelanggan',
                    '$nik_pelanggan',
                    '$pw',
                    2
                )");
                echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title: 'Daftar Berhasil',
                        text: 'Silahkan Login menggunakan NIK anda untuk username dan passwordnya !',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'login';
                    });
                </script>";
                exit;
            } else {
                $_SESSION['pesan'] = "Data anda gagal disimpan. Ulangi sekali lagi";
            }
        }
    }
    ?>
</body>

</html>