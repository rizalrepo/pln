<?php
require '../../app/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $q = $con->query("SELECT * FROM pengaduan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE a.id_pengaduan = '$id'");
    $d = $q->fetch_array();

    $dataPetugas = $con->query("SELECT * FROM pemasangan_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_pemasangan = '$d[0]' ");

    $tanggapan = $con->query("SELECT * FROM tanggapan WHERE id_pengaduan = '$id' ORDER BY waktu_tanggapan DESC");

    $checkTanggapan = $tanggapan->fetch_array();
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
                    <dt class="col-sm-2">Pesan Pengaduan</dt>
                    <dd class="col-sm-10">
                        <div class="d-flex align-items-start">
                            <span class="mx-2">:</span>
                            <div class="flex-grow-1">
                                <div class="mb-2"><?= nl2br($d['pesan_pengaduan']) ?></div>
                                <a href="<?= base_url('storage/pengaduan/' . $d['bukti_pengaduan']) ?>" class="btn btn-sm btn-success p-1" target="_blank">
                                    <i class="ri-folder-user-line me-1"></i> Bukti Pengaduan
                                </a>
                            </div>
                        </div>
                    </dd>
                    <dt class="col-sm-2">Area Pengaduan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['area'] ?></dd>
                    <dt class="col-sm-2">Waktu Pengaduan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= tglWaktu($d['waktu_pengaduan']) ?></dd>
                    <dt class="col-sm-2">Status Pengaduan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span>
                        <?php if ($d['status_pengaduan'] == 1) { ?>
                            <span class="badge bg-success">Sudah Ditanggapi</span>
                        <?php } else { ?>
                            <span class="badge bg-warning">Belum Ditanggapi</span>
                        <?php } ?>
                    </dd>
                </dl>

                <?php if ($checkTanggapan): ?>
                    <hr class="mt-1 mb-5">
                    <h6>History Tanggapan Pengaduan</h6>

                    <?php foreach ($tanggapan as $tg): ?>
                        <div class="alert bg-primary text-white mb-3" role="alert">
                            <h6 class="alert-heading d-flex align-items-center"><span class="alert-icon bg-info rounded"><i class="ri-chat-follow-up-line"></i></span><?= tglWaktu($tg['waktu_tanggapan']) ?></h6>
                            <p class="my-1">
                                <?= nl2br($tg['pesan_tanggapan']) ?>
                                <?php if ($tg['bukti_tanggapan']) : ?>
                                    <br>
                                    <a href="<?= base_url('storage/tanggapan/' . $tg['bukti_tanggapan']) ?>" class="btn btn-sm btn-success mt-2 p-1" target="_blank"><i class="ri-folder-user-line me-1"></i>Lihat Bukti Tanggapan</a>
                                <?php endif ?>
                            </p>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
}
?>