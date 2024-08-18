<?php
require '../../app/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $q = $con->query("SELECT * FROM kerusakan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE a.id_kerusakan = '$id'");
    $d = $q->fetch_array();

    $perbaikan = $con->query("SELECT * FROM perbaikan WHERE id_kerusakan = '$id' ORDER BY tgl_mulai_perbaikan DESC");

    $checkperbaikan = $perbaikan->fetch_array();
?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <dl class="row text-start my-3">
                    <dt class="col-sm-2">Nama Pelanggan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['nm_pelanggan'] ?></dd>
                    <dt class="col-sm-2">NIK</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['nik_pelanggan'] ?> <a href="<?= base_url('storage/ktp/' . $d['file_ktp']) ?>" class="btn btn-sm btn-success p-1 me-2" target="_blank"><i class="ri-folder-user-line me-1"></i> KTP</a></dd>
                    <dt class="col-sm-2">Alamat Pelanggan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['alamat_pelanggan'] ?></dd>
                    <dt class="col-sm-2">Nomor Handphone</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['hp_pelanggan'] ?></dd>
                    <dt class="col-sm-2">Pesan kerusakan</dt>
                    <dd class="col-sm-10">
                        <div class="d-flex align-items-start">
                            <span class="mx-2">:</span>
                            <div class="flex-grow-1">
                                <div class="mb-2"><?= nl2br($d['pesan_kerusakan']) ?></div>
                                <a href="<?= base_url('storage/kerusakan/' . $d['bukti_kerusakan']) ?>" class="btn btn-sm btn-success p-1" target="_blank">
                                    <i class="ri-folder-user-line me-1"></i> Bukti kerusakan
                                </a>
                            </div>
                        </div>
                    </dd>
                    <dt class="col-sm-2">Area kerusakan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['area'] ?></dd>
                    <dt class="col-sm-2">Waktu kerusakan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= tglWaktu($d['waktu_laporan']) ?></dd>
                    <dt class="col-sm-2">Status Verifikasi</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span>
                        <?php if ($d['verif'] == 1) { ?>
                            <span class="badge bg-success">Disetujui</span>
                        <?php } else if ($d['verif'] == 2) { ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php } else { ?>
                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                        <?php } ?>
                    </dd>
                    <?php if ($d['pesan_verifikasi']) : ?>
                        <dt class="col-sm-2">Pesan Verifikasi</dt>
                        <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['pesan_verifikasi'] ?></dd>
                    <?php endif;
                    if ($d['status_kerusakan'] !== NULL) : ?>
                        <dt class="col-sm-2">Status Perbaikan</dt>
                        <dd class="col-sm-10"><span class="mx-2">:</span>
                            <?php if ($d['status_kerusakan'] == 1) { ?>
                                <span class="badge bg-success">Perbaikan Selesai</span>
                            <?php } else if ($d['status_kerusakan'] == 0) { ?>
                                <span class="badge bg-info">Menunggu Perbaikan</span>
                            <?php } ?>
                        </dd>
                    <?php endif ?>
                </dl>

                <?php if ($checkperbaikan): ?>
                    <hr class="mt-1 mb-5">
                    <h6>History Perbaikan kerusakan</h6>

                    <?php foreach ($perbaikan as $tg): ?>

                        <?php $dataPetugas = $con->query("SELECT * FROM perbaikan_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_perbaikan = '$tg[id_perbaikan]' "); ?>

                        <div class="alert bg-primary text-white mb-3" role="alert">
                            <h6 class="alert-heading d-flex align-items-center"><span class="alert-icon bg-info rounded"><i class="ri-shield-check-line"></i></span><?= $tg['tgl_mulai_perbaikan'] !== $tg['tgl_selesai_perbaikan'] ? tgl($tg['tgl_mulai_perbaikan']) . ' - ' . tgl($tg['tgl_selesai_perbaikan']) : tgl($tg['tgl_mulai_perbaikan'])  ?></h6>
                            <p class="my-1">
                                <?php if ($tg['status_perbaikan'] == 1) { ?>
                                    <span class="badge bg-success mb-1">Perbaikan Selesai</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning mb-1">Menunggu Perbaikan</span>
                                <?php } ?>
                                <br>
                                <?= nl2br($tg['pesan_perbaikan']) ?>
                            </p>
                            Petugas Perbaikan : <br>
                            <div class="mt-2">
                                <?php
                                $no2 = 1;
                                while ($d2 = $dataPetugas->fetch_assoc()) {
                                    echo '<span class="me-2 mt-1">' . $no2++ . '.</span>';
                                    echo $d2['nm_up3'];
                                    echo '<hr class="my-1">';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
}
?>