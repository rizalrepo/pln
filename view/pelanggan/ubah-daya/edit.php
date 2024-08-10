<?php
require '../../../app/config.php';
$page = 'ubah_daya';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM ubah_daya a LEFT JOIN daya b ON a.id_daya = b.id_daya WHERE a.id_ubah_daya = '$id'")->fetch_array();
$old = $con->query("SELECT * FROM ubah_daya a LEFT JOIN daya b ON a.id_daya_lama = b.id_daya LEFT JOIN pemasangan c ON a.id_pemasangan = c.id_pemasangan WHERE a.id_ubah_daya = '$id'")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-speed-up-line me-2"></i>Edit Data Pengajuan Ubah Daya
            </h5>
            <div class="pe-5">
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
            <form class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Nomor Ubah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= $row['no_ubah_daya'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Daya Sekarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= $old['golongan'] . ' | ' . $old['jenis_daya'] . ' - ' . $old['jml_daya'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Nomor Pemasangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= $old['no_pemasangan'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Tanggal Pemasangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= tgl($old['tgl_pemasangan']) ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pilih Daya Baru</label>
                    <div class="col-sm-10">
                        <select name="id_daya" id="id_daya" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $daya_query = "SELECT * FROM daya ORDER BY id_daya ASC";
                            $daya = $con->query($daya_query);
                            while ($data = $daya->fetch_assoc()) { ?>
                                <option value="<?= $data['id_daya'] ?>" data-biaya_ubah_daya="<?= rupiah($data['biaya_ubah_daya']) ?>" <?= $data['id_daya'] == $row['id_daya'] ? 'selected' : ''; ?>><?= $data['golongan'] . ' | ' . $data['jenis_daya'] . ' - ' . $data['jml_daya'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Biaya Ubah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" id="biaya_ubah_daya" value="<?= rupiah($row['biaya_ubah_daya']) ?>" readonly>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row justify-content-end">
                        <div class="col-sm-9 text-end">
                            <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                            <button type="submit" name="submit" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- / Content -->

<?php
include_once '../../layouts/footer.php';

if (isset($_POST['submit'])) {
    $id_daya = $_POST['id_daya'];
    $waktu_pengajuan = date('Y-m-d H:i:s');

    $update = $con->query("UPDATE ubah_daya SET
        id_daya = '$id_daya',
        waktu_pengajuan_ubah_daya = '$waktu_pengajuan'
        WHERE id_ubah_daya = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
        exit;
    } else {
        $_SESSION['pesan'] = "Data anda gagal diupdate. Ulangi sekali lagi";
    }
}
?>

<script>
    $(document).ready(function() {
        $('#id_daya').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#biaya_ubah_daya').val(selectedOption.data('biaya_ubah_daya'));
        });
    });
</script>