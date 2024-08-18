<?php
require '../../../app/config.php';

if (isset($_GET['id']) && isset($_GET['verif'])) {
    $id = $_GET['id'];
    $verif = $_GET['verif'];

    $q = $con->query("SELECT * FROM kerusakan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE a.id_kerusakan = '$id'");
    $d = $q->fetch_array();
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

                <hr>

                <form class="needs-validation" id="form-proses" method="POST" novalidate action="update.php">
                    <input type="hidden" name="id_kerusakan" value="<?= $id ?>">
                    <input type="hidden" name="verif" value="<?= $verif ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pesan Verifikasi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="pesan_verifikasi" rows="3" required><?= $d['pesan_verifikasi'] ? $d['pesan_verifikasi'] : $_GET['pesan'] ?></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="row justify-content-end">
                            <div class="col-sm-9 text-end">
                                <button type="reset" class="btn btn-sm btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                                <button type="submit" name="proses" class="btn btn-sm btn-success"><i class="ri-save-3-fill me-2"></i>Verifikasi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#form-proses').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        Swal.fire({
                            text: result.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            $('#verifModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            text: result.message,
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    </script>
<?php
}
?>