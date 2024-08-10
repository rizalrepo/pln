<?php
include_once '../../app/config.php';
$page = 'dashboard';
include_once '../layouts/header.php';

$a = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$a1 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 0 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$a2 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 2 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$a3 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 1 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$b = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b1 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 0 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b2 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 2 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b3 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 1 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$c = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$c1 = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE status_pengaduan = 0 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$c2 = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE status_pengaduan = 1 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card Border Shadow -->
    <div class="row g-6">
        <div class="col-12">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-plug-line ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Pemasangan Baru</p>
                            <span class="text-info mb-0 h6"><?= $a['total'] ?> Total Data</span>
                            <span class="mx-2"> | </span>
                            <span class="text-warning mb-0 h6"><?= $a1['total'] ?> Data Menunggu Verifikasi</span>
                            <span class="mx-2"> | </span>
                            <span class="text-danger mb-0 h6"><?= $a2['total'] ?> Data Ditolak</span>
                            <span class="mx-2"> | </span>
                            <span class="text-success mb-0 h6"><?= $a3['total'] ?> Data Disetujui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-speed-up-line ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Ubah Daya</p>
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
        <!-- <div class="col-12">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial rounded-3 bg-label-info"><i class="ri-chat-follow-up-fill ri-24px"></i></span>
                        </div>
                        <div class="content-right">
                            <p class="mb-1 fw-medium">Pengaduan</p>
                            <span class="text-info mb-0 h6"><?= $c['total'] ?> Total Data</span>
                            <span class="mx-2"> | </span>
                            <span class="text-warning mb-0 h6"><?= $c1['total'] ?> Data Belum Ditanggapi</span>
                            <span class="mx-2"> | </span>
                            <span class="text-success mb-0 h6"><?= $c2['total'] ?> Data Ditanggapi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!--/ On route vehicles Table -->
</div>
<!-- / Content -->

<?php
include_once '../layouts/footer.php';
?>