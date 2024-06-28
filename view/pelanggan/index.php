<?php
include_once '../../app/config.php';
$page = 'dashboard';
include_once '../layouts/header.php';

// $a = $con->query("SELECT COUNT(*) AS total FROM pelanggan")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card Border Shadow -->
    <div class="row g-6">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-user-star-line ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Pelanggan</p>
                            <span class="text-info mb-0 h5">0 Data</span>
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