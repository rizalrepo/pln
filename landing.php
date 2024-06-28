<!doctype html>
<?php require_once 'app/config.php'; ?>

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
                    <a href="view/auth/login" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4" target="_blank"><span class="tf-icons ri-user-star-line me-md-1"></span><span class="d-none d-md-block">Login / Daftar</span></a>
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
                <div class="text-center">
                    <h2 class="hero-title fs-2 my-3">SISTEM INFORMASI LAYANAN PELANGGAN <br> KANTOR PELAYANAN PLN ASAM ASAM</h2>
                    <a href="#landingFeatures" class="btn btn-lg btn-primary mt-3">Selengkapnya <i class="ri-arrow-down-s-line ms-2"></i></a>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Useful features: Start -->
        <section id="landingFeatures" class="section-py landing-features pt-0 mt-0">
            <div class="container">
                <h5 class="text-center mb-2">
                    <img src="<?= base_url() ?>/assets/img/front-pages/icons/section-tilte-icon.png" alt="ikon judul bagian" class="me-3" />
                    <span class="display-5 fs-4 fw-bold">Fitur Layanan</span>
                </h5>
                <p class="text-center fw-medium mb-4 mb-md-12">
                    Berikut Layanan Pelanggan PLN Asam Asam yang sudah tersedia.
                </p>
                <div class="features-icon-wrapper row gx-0 gy-12 gx-sm-6 mt-n4 mt-sm-0">
                    <div class="col-lg-3 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-4">
                            <i class="ri-customer-service-2-line ri-3x text-primary"></i>
                        </div>
                        <h5 class="mb-2">Pengaduan</h5>
                        <p class="features-icon-description">
                            Sampaikan keluhan atau masalah Anda dengan mudah melalui sistem kami yang responsif.
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-4">
                            <i class="ri-tools-line ri-3x text-primary"></i>
                        </div>
                        <h5 class="mb-2">Lapor Kerusakan</h5>
                        <p class="features-icon-description">
                            Laporkan kerusakan dengan cepat agar dapat segera ditangani oleh tim UP3 PLN Asam Asam.
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-4">
                            <i class="ri-plug-line ri-3x text-primary"></i>
                        </div>
                        <h5 class="mb-2">Pemasangan Baru</h5>
                        <p class="features-icon-description">
                            Ajukan permintaan pemasangan baru dengan proses yang sederhana dan efisien.
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-4">
                            <i class="ri-flashlight-line ri-3x text-primary"></i>
                        </div>
                        <h5 class="mb-2">Ubah Daya</h5>
                        <p class="features-icon-description">
                            Sesuaikan kebutuhan daya listrik Anda dengan mudah melalui layanan perubahan daya PLN Asam Asam.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Useful features: End -->
    </div>

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <footer class="landing-footer">
        <div class="footer-bottom py-5">
            <div class="container d-flex flex-wrap justify-content-center flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        Sistem Informasi Layanan Pelanggan dan Monitoring Penyelesaian Laporan Gangguan Kantor Pelayanan PLN Asam Asam
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
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
</body>

</html>