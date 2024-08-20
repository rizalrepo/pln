<!doctype html>
<?php
if (!isset($_SESSION['login'])) {
    echo "<script> alert('Silahkan login terlebih dahulu'); </script>";
    header('Location: ' . base_url() . '/view/auth/login');
    exit;
}
?>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url() ?>/assets/" data-template="horizontal-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Layanan Pelanggan dan Monitoring Penyelesaian Laporan Gangguan Kantor Pelayanan PLN Asam Asam</title>

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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/pages/app-logistics-dashboard.css" />

    <!-- custom -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/custom/style.min.css">

    <!-- Form Validation -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/@form-validation/form-validation.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/flatpickr/flatpickr.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/datatables/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/datatables/responsive.bootstrap5.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/select2/select2.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Helpers -->
    <script src="<?= base_url() ?>/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js/template-customizer.js"></script>
    <script src="<?= base_url() ?>/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="<?= base_url() ?>/assets/img/logo.png" width="38px" alt="logo">
                            </span>
                            <span class="app-brand-text demo menu-text fw-semibold">PLN Asam Asam</span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="ri-close-fill align-middle"></i>
                        </a>
                    </div>

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="ri-menu-fill ri-22px"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- Style Switcher -->
                            <li class="nav-item dropdown-style-switcher dropdown me-1">
                                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="ri-22px"></i>
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
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= base_url() ?>/assets/img/avatars/1.png" alt="" class="rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-2">
                                                    <i class="ri-shield-user-fill ri-40px"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block small"><?= $_SESSION['nm_user'] ?></span>
                                                    <small class="text-muted"><?= $_SESSION['username'] ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url() ?>/view/auth/edit-password">
                                            <i class="ri-key-fill ri-22px me-3"></i><span class="align-middle">Edit Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="d-grid px-4 pt-2 pb-1">
                                            <a class="btn btn-sm btn-danger d-flex confirm-logout" href="<?= base_url() ?>/view/auth/logout" target="_blank">
                                                <small class="align-middle">Logout</small>
                                                <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->

                    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                        <div class="container-xxl d-flex h-100">
                            <ul class="menu-inner">
                                <?php if ($_SESSION['level'] == 1) {  ?>
                                    <li class="menu-item <?= isActive($page, 'dashboard') ?>">
                                        <a href="<?= base_url() ?>/view/admin" class="menu-link">
                                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                                            <div>Dashboard</div>
                                        </a>
                                    </li>
                                    <li class="menu-item <?= isOpenActive($page, ['user', 'daya', 'gardu', 'up3', 'pelanggan']) ?>">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons ri-database-line"></i>
                                            <div>Data Master</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item <?= isActive($page, 'user') ?>">
                                                <a href="<?= base_url() ?>/view/admin/user" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-group-2-fill"></i>
                                                    <div>Pengguna</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'daya') ?>">
                                                <a href="<?= base_url() ?>/view/admin/daya" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-calculator-line"></i>
                                                    <div>Daya</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'gardu') ?>">
                                                <a href="<?= base_url() ?>/view/admin/gardu" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-building-line"></i>
                                                    <div>Gardu</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'up3') ?>">
                                                <a href="<?= base_url() ?>/view/admin/up3" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-user-settings-line"></i>
                                                    <div>UP3</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'pelanggan') ?>">
                                                <a href="<?= base_url() ?>/view/admin/pelanggan" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-user-star-line"></i>
                                                    <div>Pelanggan</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item <?= isOpenActive($page, ['pemasangan', 'ubah_daya', 'pengaduan', 'kerusakan', 'perbaikan', 'maintenance']) ?>">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons ri-customer-service-2-line"></i>
                                            <div>Data Layanan</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item <?= isActive($page, 'pemasangan') ?>">
                                                <a href="<?= base_url() ?>/view/admin/pemasangan" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-plug-line"></i>
                                                    <div>Data Pemasangan Baru</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'ubah_daya') ?>">
                                                <a href="<?= base_url() ?>/view/admin/ubah-daya" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-speed-up-line"></i>
                                                    <div>Data Ubah Daya</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'pengaduan') ?>">
                                                <a href="<?= base_url() ?>/view/admin/pengaduan" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-chat-follow-up-fill"></i>
                                                    <div>Data Pengaduan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'kerusakan') ?>">
                                                <a href="<?= base_url() ?>/view/admin/kerusakan" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-alarm-warning-fill"></i>
                                                    <div>Data Kerusakan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'perbaikan') ?>">
                                                <a href="<?= base_url() ?>/view/admin/perbaikan" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-shield-check-fill"></i>
                                                    <div>Data Perbaikan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= isActive($page, 'maintenance') ?>">
                                                <a href="<?= base_url() ?>/view/admin/maintenance" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-tools-fill"></i>
                                                    <div>Data Maintenance</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-header mt-1">
                                        <span class="menu-header-text">Laporan</span>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons ri-printer-fill"></i>
                                            <div>Cetak Laporan</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPemasangan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Pemasangan Baru</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapUbahDaya">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Ubah Daya</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPengaduan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Pengaduan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapKerusakan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Kerusakan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPerbaikan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Perbaikan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapMaintenance">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Maintenance</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="<?= base_url('view/laporan/daya') ?>" target="_blank" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Rekapitulasi Daya Listrik Terpasang</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="<?= base_url('view/laporan/up3') ?>" target="_blank" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Rekapitulasi Aktivitas UP3</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } else if ($_SESSION['level'] == 2) { ?>
                                    <li class="menu-item <?= isActive($page, 'dashboard') ?>">
                                        <a href="<?= base_url() ?>/view/pelanggan" class="menu-link">
                                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                                            <div>Dashboard</div>
                                        </a>
                                    </li>
                                    <li class="menu-item <?= isActive($page, 'pemasangan') ?>">
                                        <a href="<?= base_url() ?>/view/pelanggan/pemasangan" class="menu-link">
                                            <i class="menu-icon tf-icons ri-plug-line"></i>
                                            <div>Data Pemasangan Baru</div>
                                        </a>
                                    </li>
                                    <li class="menu-item <?= isActive($page, 'ubah_daya') ?>">
                                        <a href="<?= base_url() ?>/view/pelanggan/ubah-daya" class="menu-link">
                                            <i class="menu-icon tf-icons ri-speed-up-line"></i>
                                            <div>Data Ubah Daya</div>
                                        </a>
                                    </li>
                                    <li class="menu-item <?= isActive($page, 'pengaduan') ?>">
                                        <a href="<?= base_url() ?>/view/pelanggan/pengaduan" class="menu-link">
                                            <i class="menu-icon tf-icons ri-chat-follow-up-fill"></i>
                                            <div>Data Pengaduan</div>
                                        </a>
                                    </li>
                                    <li class="menu-item <?= isActive($page, 'kerusakan') ?>">
                                        <a href="<?= base_url() ?>/view/pelanggan/kerusakan" class="menu-link">
                                            <i class="menu-icon tf-icons ri-alarm-warning-fill"></i>
                                            <div>Data Kerusakan</div>
                                        </a>
                                    </li>
                                <?php } else if ($_SESSION['level'] == 3) { ?>
                                    <li class="menu-item <?= isActive($page, 'dashboard') ?>">
                                        <a href="<?= base_url() ?>/view/admin" class="menu-link">
                                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                                            <div>Dashboard</div>
                                        </a>
                                    </li>
                                    <li class="menu-header mt-1">
                                        <span class="menu-header-text">Laporan</span>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons ri-printer-fill"></i>
                                            <div>Cetak Laporan</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPemasangan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Pemasangan Baru</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapUbahDaya">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Ubah Daya</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPengaduan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Pengaduan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapKerusakan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Kerusakan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapPerbaikan">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Perbaikan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#lapMaintenance">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Laporan Maintenance</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="<?= base_url('view/laporan/daya') ?>" target="_blank" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Rekapitulasi Daya Listrik Terpasang</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="<?= base_url('view/laporan/up3') ?>" target="_blank" class="menu-link">
                                                    <i class="menu-icon tf-icons ri-file-text-line"></i>
                                                    <div>Rekapitulasi Aktivitas UP3</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </aside>
                    <!-- / Menu -->