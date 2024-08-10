<?php
require '../../../app/config.php';
$page = 'pelanggan';
include_once '../../layouts/header.php';

$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

// Mengambil data dari session jika ada
$post_data = get_form_data();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-user-star-line me-2"></i>Tambah Data Pelanggan
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
                        <input type="text" name="nm_pelanggan" class="form-control" value="<?= isset($_POST['nm_pelanggan']) ? htmlspecialchars($_POST['nm_pelanggan']) : form_value('nm_pelanggan') ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" name="nik_pelanggan" class="form-control" maxlength="16" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?= isset($_POST['nik_pelanggan']) ? htmlspecialchars($_POST['nik_pelanggan']) : form_value('nik_pelanggan') ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <?= form_dropdown('jk_pelanggan', $jk, isset($_POST['jk_pelanggan']) ? $_POST['jk_pelanggan'] : form_value('jk_pelanggan'), 'class="form-select select2" required') ?>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="pekerjaan" class="form-control" value="<?= isset($_POST['pekerjaan']) ? htmlspecialchars($_POST['pekerjaan']) : form_value('pekerjaan') ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat_pelanggan" class="form-control" required><?= isset($_POST['alamat_pelanggan']) ? htmlspecialchars($_POST['alamat_pelanggan']) : form_value('alamat_pelanggan') ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Scan KTP</label>
                    <div class="col-sm-10">
                        <input type="file" name="file_ktp" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        <small class="text-white fw-bold badge bg-primary">Hanya file gambar yang diizinkan (JPG, JPEG, PNG, GIF). Maksimum 2MB.</small>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">No. HP</label>
                    <div class="col-sm-10">
                        <input type="number" name="hp_pelanggan" class="form-control" value="<?= isset($_POST['hp_pelanggan']) ? htmlspecialchars($_POST['hp_pelanggan']) : form_value('hp_pelanggan') ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email_pelanggan" class="form-control" value="<?= isset($_POST['email_pelanggan']) ? htmlspecialchars($_POST['email_pelanggan']) : form_value('email_pelanggan') ?>">
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row justify-content-end">
                        <div class="col-sm-9 text-end">
                            <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                            <button type="submit" name="submit" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Simpan</button>
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
    $time = date('Y-m-d H:i:s');

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
        echo "
        <script type='text/javascript'>
            Swal.fire({
                text:  'File KTP harus diupload',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false
            }); 
        </script>";
        return;
    }

    if (!empty($f_ktp)) {
        $tambah = $con->query("INSERT INTO pelanggan VALUES (
            default, 
            '$nm_pelanggan', 
            '$nik_pelanggan',
            '$jk_pelanggan',
            '$pekerjaan',
            '$alamat_pelanggan',
            '$file_ktp',
            '$hp_pelanggan',
            '$email_pelanggan',
            '$time'
        )");

        if ($tambah) {
            $pw = md5($nik_pelanggan);
            $id_pelanggan = $con->insert_id;

            $con->query("INSERT INTO user (id_pelanggan, nm_user, username, password, level) VALUES (
                '$id_pelanggan',
                '$nm_pelanggan',
                '$nik_pelanggan',
                '$pw',
                2
            )");
            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
            exit;
        } else {
            $_SESSION['pesan'] = "Data anda gagal disimpan. Ulangi sekali lagi";
        }
    }
}
?>