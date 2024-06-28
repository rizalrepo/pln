<?php
require '../../../app/config.php';
$page = 'daya';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM daya WHERE id_daya = '$id'")->fetch_array();
$jenis = [
    '' => '-- Pilih --',
    'Pelayanan Sosial' => 'Pelayanan Sosial',
    'Rumah Tangga' => 'Rumah Tangga',
    'Bisnis' => 'Bisnis',
    'Industri' => 'Industri',
];
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-calculator-line me-2"></i>Edit Data Daya
            </h5>
            <div class="pe-5">
                <a href="index" class="btn btn-sm btn-secondary"><i class="ri-arrow-left-circle-line me-2"></i>Kembali</a>
            </div>
        </div>
        <hr class="my-0">
        <div class="card-body pt-6">
            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                <div id="notif-failed" class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <i class="ri-error-warning-line"></i>
                    <div>
                        <b><?= $_SESSION['pesan'] ?></b>
                    </div>
                </div>
            <?php $_SESSION['pesan'] = '';
            } ?>
            <form class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jenis Keperluan</label>
                    <div class="col-sm-10">
                        <?= form_dropdown('jenis_daya', $jenis, $row['jenis_daya'], 'class="form-select select2" required') ?>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Golongan</label>
                    <div class="col-sm-10">
                        <input type="text" name="golongan" class="form-control" value="<?= $row['golongan'] ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jumlah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" name="jml_daya" class="form-control" value="<?= $row['jml_daya'] ?>" placeholder="Contoh : 900 VA, 220 kVA" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Biaya Pasang</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_pasang" class="form-control rupiah" value="<?= rupiah($row['biaya_pasang']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Biaya Ubah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_ubah_daya" class="form-control rupiah" value="<?= rupiah($row['biaya_ubah_daya']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
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
    $jenis_daya = $_POST['jenis_daya'];
    $golongan = $_POST['golongan'];
    $jml_daya = $_POST['jml_daya'];
    $biaya_pasang = angka($_POST['biaya_pasang']);
    $biaya_ubah_daya = angka($_POST['biaya_ubah_daya']);

    $update = $con->query("UPDATE daya SET 
        jenis_daya = '$jenis_daya', 
        golongan = '$golongan', 
        jml_daya = '$jml_daya', 
        biaya_pasang = '$biaya_pasang', 
        biaya_ubah_daya = '$biaya_ubah_daya' 
        WHERE id_daya = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        $_SESSION['pesan'] = "Data anda gagal diupdate. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}
?>