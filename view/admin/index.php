<?php
include_once '../../app/config.php';
$page = 'dashboard';
include_once '../layouts/header.php';

$a = $con->query("SELECT COUNT(*) AS total FROM pelanggan")->fetch_array();

$b = $con->query("SELECT COUNT(*) AS total FROM pemasangan")->fetch_array();
$b1 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 0")->fetch_array();
$b2 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 2")->fetch_array();
$b3 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 1")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card Border Shadow -->
    <div class="row g-6">
        <div class="col-12 col-lg-3">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-user-star-line ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Pelanggan</p>
                            <span class="text-info mb-0 h5"><?= $a['total'] ?> Data</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-plug-line ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Pemasangan Baru</p>
                            <span class="text-info mb-0 h6"><?= $b['total'] ?> Total Data</span>
                            <span class="mx-2"> | </span>
                            <span class="text-warning mb-0 h6"><?= $b1['total'] ?> Data Menunggu Verifikasi</span>
                            <span class="mx-2"> | </span>
                            <span class="text-danger mb-0 h6"><?= $b2['total'] ?> Data Ditolak</span>
                            <span class="mx-2"> | </span>
                            <span class="text-success mb-0 h6"><?= $b3['total'] ?> Data Disetujui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ On route vehicles Table -->
</div>
<!-- / Content -->

<?php
include_once '../layouts/footer.php';
?>