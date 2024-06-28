<?php
require '../../app/config.php';
include_once '../layouts/header.php';
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-key-fill me-2"></i>Edit Password
            </h5>
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
                <div class="row mb-4 form-password-toggle">
                    <label class="col-sm-2 col-form-label">Password Sekarang</label>
                    <div class="col-sm-10">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="passlama" required>
                                </div>
                                <span class="input-group-text rounded-end cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 form-password-toggle">
                    <label class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="passbaru" required>
                                </div>
                                <span class="input-group-text rounded-end cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 form-password-toggle">
                    <label class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-10">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="confirm" required>
                                </div>
                                <span class="input-group-text rounded-end cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row justify-content-end">
                        <div class="col-sm-9 text-end">
                            <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                            <button type="submit" name="submit" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Update Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- / Content -->

<?php
include_once '../layouts/footer.php';

$user = $_SESSION['id_user'];
if (isset($_POST['submit'])) {
    $passlama     = $_POST['passlama'];
    $passbaru     = $_POST['passbaru'];
    $confirmpass  = $_POST['confirm'];

    $enc = md5($passbaru);

    $cek = $con->query("SELECT * FROM user WHERE id_user = '$user'")->fetch_array();

    if (md5($passlama) == $cek['password']) {

        if ($passbaru == $confirmpass) {
            $submit = $con->query("UPDATE user SET password = '$enc' WHERE id_user = '$user'");
            if ($submit) {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        Swal.fire({
                            title: 'Ubah Password Berhasil',
                            text:  'Silahkan Login Menggunakan Password Baru!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.replace('logout');
                        });     
                    });
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {    
                    Swal.fire({
                        title: 'Ubah Password Gagal',
                        text:  'Password Baru Tidak Sama !',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.history.back();
                    });     
                });
            </script>";
        }
    } else {
        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Ubah Password Gagal',
                    text:  'Password Sekarang Salah !',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                }).then(function() {
                    window.history.back();
                });     
            });
        </script>";
    }
}
?>