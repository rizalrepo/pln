<?php
include_once '../../app/config.php';
$page = 'dashboard';
include_once '../layouts/header.php';

$b = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b1 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 0 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b2 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 2 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$b3 = $con->query("SELECT COUNT(*) AS total FROM pemasangan WHERE verif = 1 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$c = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$c1 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 0 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$c2 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 2 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$c3 = $con->query("SELECT COUNT(*) AS total FROM ubah_daya a LEFT JOIN pemasangan b ON a.id_pemasangan = b.id_pemasangan WHERE a.verif_ubah_daya = 1 AND b.id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$d = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$d1 = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE status_pengaduan = 0 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$d2 = $con->query("SELECT COUNT(*) AS total FROM pengaduan WHERE status_pengaduan = 1 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$e = $con->query("SELECT COUNT(*) AS total FROM kerusakan WHERE id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$e1 = $con->query("SELECT COUNT(*) AS total FROM kerusakan WHERE verif = 0 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$e2 = $con->query("SELECT COUNT(*) AS total FROM kerusakan WHERE verif = 2 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();
$e3 = $con->query("SELECT COUNT(*) AS total FROM kerusakan WHERE verif = 1 AND id_pelanggan = '$_SESSION[id_pelanggan]' ")->fetch_array();

$categories = [
    ['title' => 'Pemasangan Baru', 'icon' => 'ri-plug-line', 'data' => $b, 'waiting' => $b1, 'rejected' => $b2, 'approved' => $b3],
    ['title' => 'Ubah Daya', 'icon' => 'ri-speed-up-line', 'data' => $c, 'waiting' => $c1, 'rejected' => $c2, 'approved' => $c3],
    ['title' => 'Pengaduan', 'icon' => 'ri-chat-follow-up-fill', 'data' => $d, 'waiting' => $d1, 'responded' => $d2],
    ['title' => 'Laporan Kerusakan', 'icon' => 'ri-alarm-warning-line', 'data' => $e, 'waiting' => $e1, 'rejected' => $e2, 'approved' => $e3],
];
?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <?php foreach ($categories as $category) : ?>
            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 me-3">
                            <h5 class="card-title mb-1"><?= $category['title'] ?></h5>
                            <p class="mb-2 fw-semibold"><?= $category['data']['total'] ?> Total Data</p>
                            <div class="d-flex flex-wrap gap-1">
                                <?php if (isset($category['waiting'])) : ?>
                                    <span class="badge bg-label-warning"><?= $category['waiting']['total'] ?> Menunggu</span>
                                <?php endif; ?>
                                <?php if (isset($category['rejected'])) : ?>
                                    <span class="badge bg-label-danger"><?= $category['rejected']['total'] ?> Ditolak</span>
                                <?php endif; ?>
                                <?php if (isset($category['approved'])) : ?>
                                    <span class="badge bg-label-success"><?= $category['approved']['total'] ?> Disetujui</span>
                                <?php endif; ?>
                                <?php if (isset($category['responded'])) : ?>
                                    <span class="badge bg-label-info"><?= $category['responded']['total'] ?> Ditanggapi</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-xl">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="<?= $category['icon'] ?> fs-3"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- / Content -->

<?php
include_once '../layouts/footer.php';
?>

<style>
    .avatar-xl {
        width: 60px;
        height: 60px;
    }

    .avatar-xl .avatar-initial {
        font-size: 1.5rem;
    }

    .badge {
        font-size: 0.8rem;
    }

    .card-body {
        padding: 1.5rem;
    }
</style>