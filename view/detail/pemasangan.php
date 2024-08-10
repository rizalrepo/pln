<?php
require '../../app/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $q = $con->query("SELECT * FROM pemasangan a LEFT JOIN daya b ON a.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE a.id_pemasangan = '$id'");
    $d = $q->fetch_array();

    $dataPetugas = $con->query("SELECT * FROM pemasangan_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_pemasangan = '$d[0]' ");

    $ubah_daya = $con->query("SELECT * FROM ubah_daya ub LEFT JOIN pemasangan a ON ub.id_pemasangan = a.id_pemasangan LEFT JOIN daya b ON a.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE a.id_pemasangan = '$id' AND ub.verif_ubah_daya = 1 ORDER BY tgl_ubah_daya DESC ");

    $check_ubah_daya = $ubah_daya->fetch_array();
?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <dl class="row text-start my-3">
                    <dt class="col-sm-2">Nomor Pemasangan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['no_pemasangan'] ?></dd>
                    <dt class="col-sm-2">Nama Pelanggan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['nm_pelanggan'] ?></dd>
                    <dt class="col-sm-2">NIK</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['nik_pelanggan'] ?> <a href="<?= base_url('storage/ktp/' . $d['file_ktp']) ?>" class="btn btn-sm btn-success p-1 me-2" target="_blank"><i class="ri-folder-user-line me-1"></i> KTP</a></dd>
                    <dt class="col-sm-2">Alamat Pelanggan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['alamat_pelanggan'] ?></dd>
                    <dt class="col-sm-2">Nomor Handphone</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['hp_pelanggan'] ?></dd>
                    <dt class="col-sm-2">Daya</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['golongan'] . ' | ' . $d['jenis_daya'] . ' - ' . $d['jml_daya'] ?></dd>
                    <dt class="col-sm-2">Biaya Pasang</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= rupiah($d['biaya_pasang']) ?></dd>
                    <dt class="col-sm-2">Alamat Pemasangan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['area'] . ' - ' . $d['alamat_pemasangan'] ?></dd>
                    <dt class="col-sm-2">Waktu Pengajuan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= tglWaktu($d['waktu_pengajuan']) ?></dd>
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
                    <dt class="col-sm-2">Keterangan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span>
                        <?php if ($d['verif'] == 1) { ?>
                            Pemasangan Baru telah Disetujui, Pemasangan akan dilakukan pada tanggal <?= tgl($d['tgl_pemasangan']) ?> oleh Petugas dibawah ini
                            <div class="mt-2">
                                <?php
                                $no2 = 1;
                                while ($d2 = $dataPetugas->fetch_assoc()) {
                                    echo '<span class="me-2 ms-5 mt-1">' . $no2++ . '.</span>';
                                    echo $d2['nm_up3'];
                                    echo '<hr class="my-1">';
                                }
                                ?>
                            </div>
                        <?php } else if ($d['verif'] == 2) { ?>
                            Pemasangan Baru ditolak karena <?= $d['pesan_ditolak'] ?>
                        <?php } else { ?>
                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                        <?php } ?>
                    </dd>
                </dl>

                <?php if ($check_ubah_daya): ?>
                    <hr class="mt-1 mb-5">
                    <h6>History Ubah Daya</h6>

                    <?php foreach ($ubah_daya as $ud):
                        $old = $con->query("SELECT * FROM ubah_daya a LEFT JOIN daya b ON a.id_daya_lama = b.id_daya LEFT JOIN pemasangan c ON a.id_pemasangan = c.id_pemasangan WHERE a.id_ubah_daya = '$ud[id_ubah_daya]'")->fetch_array();
                    ?>
                        <div class="alert bg-primary text-white mb-3" role="alert">
                            <h6 class="alert-heading d-flex align-items-center"><span class="alert-icon bg-info rounded"><i class="ri-speed-up-line"></i></span><?= tgl($ud['tgl_ubah_daya']) ?></h6>
                            <dl class="row text-start my-1">
                                <dt class="col-sm-2">Nomor Ubah Daya</dt>
                                <dd class="col-sm-10"><span class="mx-2">:</span><?= $ud['no_ubah_daya'] ?></dd>
                                <dt class="col-sm-2">Daya Lama</dt>
                                <dd class="col-sm-10"><span class="mx-2">:</span><?= $old['golongan'] . ' | ' . $old['jenis_daya'] . ' - ' . $old['jml_daya'] ?></dd>
                            </dl>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
}
?>