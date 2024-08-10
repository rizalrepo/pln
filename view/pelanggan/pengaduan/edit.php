<?php
require '../../../app/config.php';
$page = 'pengaduan';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'")->fetch_array();

$post_data = get_form_data();
$file_lama = $row['bukti_pengaduan'];
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-chat-follow-up-line me-2"></i>Edit Data pengaduan
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
                    <label class="col-sm-2 col-form-label">Pesan Pengaduan</label>
                    <div class="col-sm-10">
                        <textarea name="pesan_pengaduan" class="form-control" rows="5" placeholder="Masukkan Pesan, Waktu dan Tempat dengan detail" required><?= isset($_POST['pesan_pengaduan']) ? htmlspecialchars($_POST['pesan_pengaduan']) : htmlspecialchars($row['pesan_pengaduan']) ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Area Pengaduan</label>
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
                                } elseif ($row['id_gardu'] == $data['id_gardu']) {
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
                    <label class="col-sm-2 col-form-label">Bukti Pengaduan</label>
                    <div class="col-sm-10">
                        <input type="file" name="bukti_pengaduan" class="form-control" accept="image/*">
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        <small class="text-white fw-bold badge bg-primary">Hanya file gambar yang diizinkan (JPG, JPEG, PNG, GIF). Maksimum 2MB. kosongkan jika tidak ingin mengedit KTP</small>
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
    $pesan_pengaduan = $_POST['pesan_pengaduan'];
    $id_gardu = $_POST['id_gardu'];
    $waktu_pengaduan = date('Y-m-d H:i:s');

    $f_bukti_pengaduan = "";
    if (!empty($_FILES['bukti_pengaduan']['name'])) {
        // UPLOAD FILE 
        $file      = $_FILES['bukti_pengaduan']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $bukti_pengaduan = rand(1000000, 9999999) . '.' . $ext_file;
        $size_file = $_FILES['bukti_pengaduan']['size'];
        $tmp_file  = $_FILES['bukti_pengaduan']['tmp_name'];
        $dir_file  = '../../../storage/pengaduan/';
        $allow_ext        = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF');
        $allow_size       = 2097152; // 2 MB

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                // Hapus file lama jika ada
                if (!empty($file_lama) && file_exists($dir_file . $file_lama)) {
                    unlink($dir_file . $file_lama);
                }
                move_uploaded_file($tmp_file, $dir_file . $bukti_pengaduan);
                $f_bukti_pengaduan .= "Upload Success";
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
        $bukti_pengaduan = $file_lama; // Gunakan file KTP yang sudah ada
    }

    $update = $con->query("UPDATE pengaduan SET
        pesan_pengaduan = '$pesan_pengaduan',
        id_gardu = '$id_gardu',
        bukti_pengaduan = '$bukti_pengaduan',
        waktu_pengaduan = '$waktu_pengaduan'
        WHERE id_pengaduan = '$id'
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