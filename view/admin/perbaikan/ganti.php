<?php
require '../../../app/config.php';
$page = 'perbaikan';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM kerusakan WHERE id_kerusakan = '$id'")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-tools-line me-2"></i>Data Ganti Barang
            </h5>
            <div class="pe-5">
                <a href="index" class="btn btn-sm btn-secondary"><i class="ri-arrow-left-circle-line me-2"></i>Kembali</a>
            </div>
        </div>
        <hr class="my-0">
        <div class="card-body pt-6">
            <?php if (isset($_SESSION['error']) && $_SESSION['error'] <> '') { ?>
                <div id="notif-failed" class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <i class="ri-error-warning-line me-2"></i>
                    <div>
                        <b><?= $_SESSION['error'] ?></b>
                    </div>
                </div>
            <?php $_SESSION['error'] = '';
            } ?>
            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                <div id="notif-failed" class="alert alert-solid-success d-flex align-items-center" role="alert">
                    <i class="ri-checkbox-circle-line me-2"></i>
                    <div>
                        <b><?= $_SESSION['pesan'] ?></b>
                    </div>
                </div>
            <?php $_SESSION['pesan'] = '';
            } ?>
            <form id="formBarang" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pilih Barang</label>
                    <div class="col-sm-10">
                        <select name="id_barang" id="id_barang" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $barang_query = "SELECT * FROM barang WHERE stok > 0 ORDER BY id_barang ASC";
                            $barang = $con->query($barang_query);
                            while ($data = $barang->fetch_assoc()) { ?>
                                <option value="<?= $data['id_barang'] ?>" data-stok="<?= $data['stok'] . ' ' . $data['satuan'] ?>" data-stok_num="<?= $data['stok'] ?>"><?= $data['nm_barang'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Stok Tersedia</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="stok_num" readonly>
                        <input type="text" class="form-control bg-light" id="stok" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        <div class="invalid-feedback" id="jumlah-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row justify-content-end">
                        <div class="col-sm-9 text-end">
                            <button type="reset" class="btn btn-danger me-1"><i class="ri-refresh-line me-2"></i>Reset</button>
                            <button type="submit" name="submit" id="submitBtn" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body pt-3">
            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                <div id="notif-success" class="alert alert-solid-info d-flex align-items-center" role="alert">
                    <i class="ri-checkbox-circle-line me-2"></i>
                    <div>
                        <b><?= $_SESSION['pesan'] ?></b>
                    </div>
                </div>
            <?php $_SESSION['pesan'] = '';
            } ?>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-hover table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama barang</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM barang_keluar a LEFT JOIN barang b ON a.id_barang = b.id_barang WHERE a.id_kerusakan = '$id' ORDER BY a.id_barang_keluar DESC");
                        while ($row2 = $data->fetch_array()) {
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++ ?></td>
                                <td><?= $row2['nm_barang'] ?></td>
                                <td class="text-center"><?= $row2['jumlah'] . ' ' . $row2['satuan'] ?></td>
                                <td align="center">
                                    <a href="hapus-ganti?id=<?= $row2[0] ?>&ids=<?= $id ?>" class="btn btn-danger btn-xs confirm-hapus" title="Hapus"><i class="ri-delete-bin-line me-2"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->

<?php
include_once '../../layouts/footer.php';

if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $tambah = $con->query("INSERT INTO barang_keluar VALUES (
        default,
        '$id', 
        default,
        '$id_barang',
        '$jumlah'
    )");

    if ($tambah) {
        $con->query("UPDATE barang SET stok = (stok - '$jumlah') WHERE id_barang = '$id_barang'");
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=ganti?id=$id'>";
    } else {
        $_SESSION['error'] = "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=ganti?id=$id'>";
    }
}
?>

<script>
    $(document).ready(function() {
        $('#id_barang').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#stok').val(selectedOption.data('stok'));
            $('#stok_num').val(selectedOption.data('stok_num'));
        });

        $('#jumlah').on('input', function() {
            validateQuantity();
        });

        $('#formBarang').submit(function(e) {
            if (!validateQuantity()) {
                e.preventDefault();
            }
        });

        function validateQuantity() {
            var stokNum = parseInt($('#stok_num').val()) || 0;
            var jumlah = parseInt($('#jumlah').val()) || 0;
            var jumlahInput = $('#jumlah');
            var jumlahFeedback = $('#jumlah-feedback');
            var submitBtn = $('#submitBtn');

            if (jumlah > stokNum) {
                jumlahInput.addClass('is-invalid');
                jumlahFeedback.text('Jumlah melebihi stok tersedia!');
                submitBtn.prop('disabled', true);
                return false;
            } else if (jumlah <= 0) {
                jumlahInput.addClass('is-invalid');
                jumlahFeedback.text('Jumlah harus lebih dari 0!');
                submitBtn.prop('disabled', true);
                return false;
            } else {
                jumlahInput.removeClass('is-invalid');
                jumlahFeedback.text('');
                submitBtn.prop('disabled', false);
                return true;
            }
        }
    });
</script>