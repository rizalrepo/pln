<?php
require '../../../app/config.php';
$page = 'maintenance';
include_once '../../layouts/header.php';
// Mengambil data dari session jika ada
$post_data = get_form_data();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-tools-line me-2"></i>Tambah Data Maintenance
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
                    <label class="col-sm-2 col-form-label">Area Maintenance</label>
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
                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl_mulai_maintenance" class="form-control" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl_selesai_maintenance" class="form-control" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi_maintenance" class="form-control" required><?= isset($_POST['deskripsi_maintenance']) ? htmlspecialchars($_POST['deskripsi_maintenance']) : form_value('deskripsi_maintenance') ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">UP3</label>
                    <div class="col-sm-10">
                        <select name="id_up3[]" class="form-select select2" multiple required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $up3_query = "SELECT * FROM up3";
                            $up3 = $con->query($up3_query);
                            while ($data = $up3->fetch_assoc()) { ?>
                                <option value="<?= $data['id_up3'] ?>"><?= $data['nm_up3'] ?></option>
                            <?php } ?>
                        </select>
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
    $id_gardu = $_POST['id_gardu'];
    $tgl_mulai_maintenance = $_POST['tgl_mulai_maintenance'];
    $tgl_selesai_maintenance = $_POST['tgl_selesai_maintenance'];
    $deskripsi_maintenance = $_POST['deskripsi_maintenance'];

    $tambah = $con->query("INSERT INTO maintenance VALUES (
        default, 
        '$id_gardu',
        '$tgl_mulai_maintenance', 
        '$tgl_selesai_maintenance', 
        '$deskripsi_maintenance'
    )");

    if ($tambah) {

        $id_maintenance = $con->insert_id;
        $id_up3_array = $_POST['id_up3'];

        if (!empty($id_up3_array)) {
            $values = [];
            foreach ($id_up3_array as $id_up3) {
                $id_up3 = $con->real_escape_string($id_up3);
                $values[] = "('$id_maintenance', '$id_up3')";
            }

            $sql = "INSERT INTO maintenance_up3 (id_maintenance, id_up3) VALUES " . implode(", ", $values);

            if ($con->query($sql)) {
                echo "Data berhasil disimpan";
            } else {
                echo "Error: " . $con->error;
            }
        } else {
            echo "Tidak ada yang dipilih";
        }

        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
        exit;
    } else {
        $_SESSION['pesan'] = "Data anda gagal disimpan. Ulangi sekali lagi";
    }
}
?>