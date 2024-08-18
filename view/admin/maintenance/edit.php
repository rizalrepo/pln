<?php
require '../../../app/config.php';
$page = 'maintenance';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM maintenance WHERE id_maintenance = '$id'")->fetch_array();

$selected_up3 = $con->query("SELECT id_up3 FROM maintenance_up3 WHERE id_maintenance = '$id'")->fetch_all(MYSQLI_ASSOC);
$selected_up3_ids = array_column($selected_up3, 'id_up3');

$post_data = get_form_data();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-tools-line me-2"></i>Edit Data Maintenance
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
                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl_mulai_maintenance" class="form-control" value="<?= $row['tgl_mulai_maintenance'] ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl_selesai_maintenance" class="form-control" value="<?= $row['tgl_selesai_maintenance'] ?>" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi_maintenance" class="form-control" required><?= isset($_POST['deskripsi_maintenance']) ? htmlspecialchars($_POST['deskripsi_maintenance']) : htmlspecialchars($row['deskripsi_maintenance']) ?></textarea>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">UP3</label>
                    <div class="col-sm-10">
                        <select name="id_up3[]" class="form-select select2" multiple required>
                            <?php
                            $up3_query = "SELECT * FROM up3";
                            $up3 = $con->query($up3_query);
                            while ($data = $up3->fetch_assoc()) {
                                $selected = in_array($data['id_up3'], $selected_up3_ids) ? 'selected' : '';
                            ?>
                                <option value="<?= $data['id_up3'] ?>" <?= $selected ?>><?= $data['nm_up3'] ?></option>
                            <?php } ?>
                        </select>
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
    $id_gardu = $_POST['id_gardu'];
    $tgl_mulai_maintenance = $_POST['tgl_mulai_maintenance'];
    $tgl_selesai_maintenance = $_POST['tgl_selesai_maintenance'];
    $deskripsi_maintenance = $_POST['deskripsi_maintenance'];

    $id_up3_array = isset($_POST['id_up3']) ? $_POST['id_up3'] : [];

    $update = $con->query("UPDATE maintenance SET
        id_gardu = '$id_gardu',
        tgl_mulai_maintenance = '$tgl_mulai_maintenance',
        tgl_selesai_maintenance = '$tgl_selesai_maintenance',
        deskripsi_maintenance = '$deskripsi_maintenance'
        WHERE id_maintenance = '$id'
    ");

    if ($update) {

        // Ambil data up3 yang sudah ada
        $existing_up3 = $con->query("SELECT id_up3 FROM maintenance_up3 WHERE id_maintenance = '$id'")->fetch_all(MYSQLI_ASSOC);
        $existing_up3_ids = array_column($existing_up3, 'id_up3');

        // Identifikasi up3 yang perlu dihapus
        $up3_to_delete = array_diff($existing_up3_ids, $id_up3_array);

        // Hapus up3 yang tidak ada lagi dalam pilihan
        if (!empty($up3_to_delete)) {
            $delete_ids = implode(',', array_map([$con, 'real_escape_string'], $up3_to_delete));
            $con->query("DELETE FROM maintenance_up3 WHERE id_maintenance = '$id' AND id_up3 IN ($delete_ids)");
        }

        // Identifikasi up3 baru yang perlu ditambahkan
        $up3_to_add = array_diff($id_up3_array, $existing_up3_ids);

        // Tambahkan up3 baru
        if (!empty($up3_to_add)) {
            $values = [];
            foreach ($up3_to_add as $id_up3) {
                $id_up3 = $con->real_escape_string($id_up3);
                $values[] = "('$id', '$id_up3')";
            }

            $sql = "INSERT INTO maintenance_up3 (id_maintenance, id_up3) VALUES " . implode(", ", $values);
            $con->query($sql);
        }

        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
        exit;
    } else {
        $_SESSION['pesan'] = "Data anda gagal diupdate. Ulangi sekali lagi";
    }
}
?>