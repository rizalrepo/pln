<?php
require '../../../app/config.php';
$page = 'barang';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM barang WHERE id_barang = '$id'")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-stack-line me-2"></i>Edit Data Barang
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
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nm_barang" class="form-control" value="<?= $row['nm_barang'] ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Satuan Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="satuan" class="form-control" value="<?= $row['satuan'] ?>" required>
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
    $nm_barang = $_POST['nm_barang'];
    $satuan = $_POST['satuan'];

    $update = $con->query("UPDATE barang SET 
        nm_barang = '$nm_barang', 
        satuan = '$satuan'
        WHERE id_barang = '$id'
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