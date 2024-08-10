<?php
require '../../../app/config.php';
$page = 'pengaduan';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM pengaduan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu WHERE id_pengaduan = '$id'")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-chat-follow-up-line me-2"></i>Detail Data Pengaduan
            </h5>
            <div class="pe-5">
                <span data-bs-toggle="modal" data-bs-target="#modal-tambah" class="btn btn-sm btn-primary me-1"><i class="ri-add-circle-fill me-2"></i>Input Tanggapan</span>
                <a href="index" class="btn btn-sm btn-secondary"><i class="ri-arrow-left-circle-line me-2"></i>Kembali</a>
            </div>
        </div>
        <hr class="my-0">
        <div class="card-body pt-6">
            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                <div id="notif-failed" class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <i class="ri-error-warning-line me-2"></i>
                    <div>
                        <b><?= $_SESSION['pesan'] ?></b>
                    </div>
                </div>
            <?php
                $_SESSION['pesan'] = '';
            }
            ?>

            <dl class="row text-start">
                <dt class="col-sm-2">Nama Pelanggan</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span><?= $row['nm_pelanggan'] ?></dd>
                <dt class="col-sm-2">NIK</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span><?= $row['nik_pelanggan'] ?> <a href="<?= base_url('storage/ktp/' . $row['file_ktp']) ?>" class="btn btn-sm btn-success p-1 me-2" target="_blank"><i class="ri-folder-user-line me-1"></i> KTP</a></dd>
                <dt class="col-sm-2">Alamat Pelanggan</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span><?= $row['alamat_pelanggan'] ?></dd>
                <dt class="col-sm-2">Nomor Handphone</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span><?= $row['hp_pelanggan'] ?></dd>
                <dt class="col-sm-2">Pesan Pengaduan</dt>
                <dd class="col-sm-10">
                    <div class="d-flex align-items-start">
                        <span class="mx-2">:</span>
                        <div class="flex-grow-1">
                            <div class="mb-2"><?= nl2br($row['pesan_pengaduan']) ?></div>
                            <a href="<?= base_url('storage/pengaduan/' . $row['bukti_pengaduan']) ?>" class="btn btn-sm btn-success p-1" target="_blank">
                                <i class="ri-folder-user-line me-1"></i> Bukti Pengaduan
                            </a>
                        </div>
                    </div>
                </dd>
                <dt class="col-sm-2">Waktu Pengaduan</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span><?= tglWaktu($row['waktu_pengaduan']) ?></dd>
                <dt class="col-sm-2">Status Pengaduan</dt>
                <dd class="col-sm-10"><span class="mx-2">:</span>
                    <?php if ($row['status_pengaduan'] == 1) { ?>
                        <span class="badge bg-success">Sudah Ditanggapi</span>
                    <?php } else { ?>
                        <span class="badge bg-warning">Belum Ditanggapi</span>
                    <?php } ?>
                </dd>
            </dl>

            <hr class="mt-1 mb-5">

            <input type="hidden" id="dataid" value="<?= $id; ?>">
            <div id="data-tanggapan"></div>
        </div>
    </div>
</div>
<!-- / Content -->

<div class="modal fade" id="modal-tambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Input Tanggapan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" novalidate id="form-tambah" enctype="multipart/form-data" action="ajax/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="id_pengaduan" value="<?= $id ?>">
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">Pesan Tanggapan</label>
                            <div class="col-sm-9">
                                <textarea type="text" id="pesan" rows="4" name="pesan_tanggapan" class="form-control" required></textarea>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">Bukti (boleh kosong)</label>
                            <div class="col-sm-9">
                                <input type="file" accept="image/*" class="form-control" id="bukti" name="bukti_tanggapan">
                                <span class="badge bg-primary">*File harus JPG, JPEG, PNG dan Ukuran file maksimal 2MB</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-end">
                                <button type="reset" class="btn btn-sm btn-danger me-2"><i class="ri-refresh-line me-2"></i>Reset</button>
                                <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-3-line me-2"></i>Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Log Book</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" novalidate id="form-edit" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" id="edit-id" name="id_tanggapan">
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea type="text" id="edit-pesan" rows="4" name="pesan_tanggapan" class="form-control" required></textarea>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">Bukti (boleh kosong)</label>
                            <div class="col-sm-9">
                                <input type="file" accept="image/*" class="form-control" id="edit-bukti" name="bukti_tanggapan">
                                <span class="badge bg-primary">*File harus JPG, JPEG, PNG dan Ukuran file maksimal 2MB</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-end">
                                <button type="button" class="btn btn-sm btn-danger me-2" data-bs-dismiss="modal"><i class="ri-close-line me-2"></i>Batal</button>
                                <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-3-line me-2"></i>Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../../layouts/footer.php';
?>

<script>
    muncul();
    var data = "ajax/tampil.php";

    function muncul() {
        $.post('ajax/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-tanggapan").html(data);
            }
        );
    }

    $(document).ready(function(e) {

        $('#modal-tambah').on('show.bs.modal', function() {
            $('#form-tambah')[0].reset();
            $('#form-tambah').removeClass('was-validated');
        });

        $('#modal-edit').on('show.bs.modal', function() {
            $('#form-edit').removeClass('was-validated');
        });

        $("#form-tambah").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "ajax/simpan.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var hasil = JSON.parse(data);
                    if (hasil.hasil == "sukses") {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data Pengaduan berhasil Ditanggapi',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#modal-tambah').modal('hide');
                            $("#pesan").val('');
                            $("#bukti").val('');

                            muncul();
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: hasil.pesan || 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        }));
    });

    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: 'ajax/get-data.php',
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#modal-edit').modal('show');
                    $('#edit-id').val(response.data.id_tanggapan);
                    $('#edit-pesan').val(response.data.pesan_tanggapan);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Gagal mengambil data.',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });

    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'ajax/update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(function() {
                        $('#modal-edit').modal('hide');

                        muncul();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });

    $(document).on('click', '#hapus', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');

        Swal.fire({
            title: "Konfirmasi Hapus Data !",
            text: "Data Akan Dihapus, Lanjutkan ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            customClass: {
                confirmButton: "btn btn-primary me-2 waves-effect waves-light",
                cancelButton: "btn btn-danger waves-effect",
            },
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post('ajax/hapus.php', {
                        id: id
                    },
                    function(response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(function() {
                                    muncul();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: data.message,
                                    icon: 'error',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            }
                        } catch (e) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan pada server.',
                                icon: 'error',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    }
                );
            }
        });
        return false;
    });
</script>