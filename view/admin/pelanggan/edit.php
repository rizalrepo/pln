<?php
require '../../../app/config.php';
$page = 'pelanggan';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'")->fetch_array();

$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

$post_data = get_form_data();
$file_lama = $row['file_ktp'];
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-user-star-line me-2"></i>Edit Data Pelanggan
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
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nm_pelanggan" class="form-control" value="<?= isset($_POST['nm_pelanggan']) ? htmlspecialchars($_POST['nm_pelanggan']) : htmlspecialchars($row['nm_pelanggan']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" name="nik_pelanggan" class="form-control" maxlength="16" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?= isset($_POST['nik_pelanggan']) ? htmlspecialchars($_POST['nik_pelanggan']) : htmlspecialchars($row['nik_pelanggan']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <?= form_dropdown('jk_pelanggan', $jk, isset($_POST['jk_pelanggan']) ? $_POST['jk_pelanggan'] : $row['jk_pelanggan'], 'class="form-select select2" required') ?>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="pekerjaan" class="form-control" value="<?= isset($_POST['pekerjaan']) ? htmlspecialchars($_POST['pekerjaan']) : htmlspecialchars($row['pekerjaan']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat_pelanggan" class="form-control" required><?= isset($_POST['alamat_pelanggan']) ? htmlspecialchars($_POST['alamat_pelanggan']) : htmlspecialchars($row['alamat_pelanggan']) ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Scan KTP</label>
                    <div class="col-sm-10">
                        <input type="file" name="file_ktp" class="form-control" accept="image/*">
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        <small class="text-white fw-bold badge bg-primary">Hanya file gambar yang diizinkan (JPG, JPEG, PNG, GIF). Maksimum 2MB. kosongkan jika tidak ingin mengedit KTP</small>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">No. HP</label>
                    <div class="col-sm-10">
                        <input type="number" name="hp_pelanggan" class="form-control" value="<?= isset($_POST['hp_pelanggan']) ? htmlspecialchars($_POST['hp_pelanggan']) : htmlspecialchars($row['hp_pelanggan']) ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email_pelanggan" class="form-control" value="<?= isset($_POST['email_pelanggan']) ? htmlspecialchars($_POST['email_pelanggan']) : htmlspecialchars($row['email_pelanggan']) ?>">
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
    $nm_pelanggan = $_POST['nm_pelanggan'];
    $nik_pelanggan = $_POST['nik_pelanggan'];
    $jk_pelanggan = $_POST['jk_pelanggan'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $hp_pelanggan = $_POST['hp_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];

    $f_ktp = "";
    if (!empty($_FILES['file_ktp']['name'])) {
        // UPLOAD FILE 
        $file      = $_FILES['file_ktp']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $file_ktp = rand(1000000, 9999999) . '.' . $ext_file;
        $size_file = $_FILES['file_ktp']['size'];
        $tmp_file  = $_FILES['file_ktp']['tmp_name'];
        $dir_file  = '../../../storage/ktp/';
        $allow_ext        = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF');
        $allow_size       = 2097152; // 2 MB

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                // Hapus file lama jika ada
                if (!empty($file_lama) && file_exists($dir_file . $file_lama)) {
                    unlink($dir_file . $file_lama);
                }
                move_uploaded_file($tmp_file, $dir_file . $file_ktp);
                $f_ktp .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    Swal.fire({
                        text:  'Ukuran File Terlalu Besar, Maksimal 2 Mb',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    }); 
                </script>";
                return;
            }
        } else {
            echo "
            <script type='text/javascript'>
                Swal.fire({
                    text:  'Format File Tidak Didukung. File Harus Berupa Gambar',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                }); 
            </script>";
            return;
        }
    } else {
        $file_ktp = $file_lama; // Gunakan file KTP yang sudah ada
    }

    $update = $con->query("UPDATE pelanggan SET
        nm_pelanggan = '$nm_pelanggan',
        nik_pelanggan = '$nik_pelanggan',
        jk_pelanggan = '$jk_pelanggan',
        pekerjaan = '$pekerjaan',
        alamat_pelanggan = '$alamat_pelanggan',
        file_ktp = '$file_ktp',
        hp_pelanggan = '$hp_pelanggan',
        email_pelanggan = '$email_pelanggan'
        WHERE id_pelanggan = '$id'
    ");

    if ($update) {
        $pw = md5($nik_pelanggan);
        $con->query("UPDATE user SET
            nm_user = '$nm_pelanggan',
            username = '$nik_pelanggan',
            password = '$pw'
            WHERE id_pelanggan = '$id' 
        ");
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
        exit;
    } else {
        $_SESSION['pesan'] = "Data anda gagal diupdate. Ulangi sekali lagi";
    }
}
?>