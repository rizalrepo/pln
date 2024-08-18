<?php
require '../../../app/config.php';
$page = 'kerusakan';
include_once '../../layouts/header.php';
// Mengambil data dari session jika ada
$post_data = get_form_data();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-alarm-warning-line me-2"></i>Tambah Data Laporan Kerusakan
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
                    <label class="col-sm-2 col-form-label">Pesan kerusakan</label>
                    <div class="col-sm-10">
                        <textarea name="pesan_kerusakan" class="form-control" rows="5" placeholder="Masukkan Pesan, Waktu dan Tempat dengan detail" required><?= isset($_POST['pesan_kerusakan']) ? htmlspecialchars($_POST['pesan_kerusakan']) : form_value('pesan_kerusakan') ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Area kerusakan</label>
                    <div class="col-sm-10">
                        <select name="id_gardu" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $gardu_query = "SELECT * FROM gardu ORDER BY id_gardu ASC";
                            $gardu = $con->query($gardu_query);
                            while ($data = $gardu->fetch_assoc()) {
                                $selected = '';
                                if (isset($_POST['id_gardu']) && $_POST['id_gardu'] == $data['id_gardu']) {
                                    $selected = 'selected';
                                } elseif (form_value('id_gardu') == $data['id_gardu']) {
                                    $selected = 'selected';
                                }
                            ?>
                                <option value="<?= $data['id_gardu'] ?>" <?= $selected ?>><?= $data['area'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Upload Bukti kerusakan</label>
                    <div class="col-sm-10">
                        <input type="file" name="bukti_kerusakan" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        <small class="text-white fw-bold badge bg-primary">Hanya file gambar yang diizinkan (JPG, JPEG, PNG, GIF). Maksimum 2MB.</small>
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
    $pesan_kerusakan = $_POST['pesan_kerusakan'];
    $id_gardu = $_POST['id_gardu'];
    $waktu_laporan = date('Y-m-d H:i:s');

    $f_bukti_kerusakan = "";
    if (!empty($_FILES['bukti_kerusakan']['name'])) {
        // UPLOAD FILE 
        $file      = $_FILES['bukti_kerusakan']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $bukti_kerusakan = rand(1000000, 9999999) . '.' . $ext_file;
        $size_file = $_FILES['bukti_kerusakan']['size'];
        $tmp_file  = $_FILES['bukti_kerusakan']['tmp_name'];
        $dir_file  = '../../../storage/kerusakan/';
        $allow_ext        = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF');
        $allow_size       = 2097152; // 2 MB

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $bukti_kerusakan);
                $f_bukti_kerusakan .= "Upload Success";
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
                text:  'File Bukti harus diupload',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false
            }); 
        </script>";
        return;
    }

    if (!empty($f_bukti_kerusakan)) {
        $tambah = $con->query("INSERT INTO kerusakan VALUES (
            default, 
            '$_SESSION[id_pelanggan]',
            '$pesan_kerusakan', 
            '$id_gardu',
            '$bukti_kerusakan',
            0,
            '$waktu_laporan',
            default,
            default
        )");

        if ($tambah) {
            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
            exit;
        } else {
            $_SESSION['pesan'] = "Data anda gagal disimpan. Ulangi sekali lagi";
        }
    }
}
?>