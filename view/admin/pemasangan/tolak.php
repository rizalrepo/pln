<?php
require '../../../app/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $q = $con->query("SELECT * FROM pemasangan a LEFT JOIN daya b ON a.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE a.id_pemasangan = '$id'");
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
                    <dt class="col-sm-2">Nomor Pemasangan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['no_pemasangan'] ?></dd>
                    <dt class="col-sm-2">Daya</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['golongan'] . ' | ' . $d['jenis_daya'] . ' - ' . $d['jml_daya'] ?></dd>
                    <dt class="col-sm-2">Biaya Pasang</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= rupiah($d['biaya_pasang']) ?></dd>
                    <dt class="col-sm-2">Alamat Pemasangan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= $d['area'] . ' - ' . $d['alamat_pemasangan'] ?></dd>
                    <dt class="col-sm-2">Waktu Pengajuan</dt>
                    <dd class="col-sm-10"><span class="mx-2">:</span><?= tglWaktu($d['waktu_pengajuan']) ?></dd>
                </dl>

                <hr class="mt-1 mb-5">

                <form class="needs-validation" id="form-tolak" method="POST" novalidate action="verif.php">
                    <input type="hidden" name="id_pemasangan" value="<?= $id ?>">
                    <input type="hidden" name="verif" value="2">
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Alasan Pengajuan Ditolak</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="pesan_ditolak" required><?= $d['pesan_ditolak'] ?></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="row justify-content-end">
                            <div class="col-sm-9 text-end">
                                <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                                <button type="submit" name="tolak" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Verifikasi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $('#form-tolak').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                console.log(response);
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    Swal.fire({
                        text: 'Pengajuan Pemasangan Baru Ditolak',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        $('#tolakModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        text: 'Data gagal diverifikasi. Ulangi sekali lagi',
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