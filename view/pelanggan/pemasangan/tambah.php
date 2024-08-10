<?php
require '../../../app/config.php';
$page = 'pemasangan';
include_once '../../layouts/header.php';

$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

$query = $con->query("SELECT MAX(SUBSTRING(no_pemasangan, 4)) AS max_id FROM pemasangan");
$row = $query->fetch_assoc();
$max_id = $row['max_id'];

// Membuat nomor pemasangan baru
if ($max_id) {
    $newNumber = 'NPB' . str_pad($max_id + 1, 6, '0', STR_PAD_LEFT);
} else {
    $newNumber = 'NPB000001';
}

?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-plug-line me-2"></i>Pengajuan Pemasangan Baru
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
                    <label class="col-sm-2 col-form-label">Nomor Pemasangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= $newNumber ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pilih Daya</label>
                    <div class="col-sm-10">
                        <select name="id_daya" id="id_daya" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $daya_query = "SELECT * FROM daya ORDER BY id_daya ASC";
                            $daya = $con->query($daya_query);
                            while ($data = $daya->fetch_assoc()) { ?>
                                <option value="<?= $data['id_daya'] ?>" data-biaya_pasang="<?= rupiah($data['biaya_pasang']) ?>"><?= $data['golongan'] . ' | ' . $data['jenis_daya'] . ' - ' . $data['jml_daya'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Biaya Pasang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" id="biaya_pasang" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Area Pemasangan</label>
                    <div class="col-sm-10">
                        <select name="id_gardu" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $gardu_query = "SELECT * FROM gardu ORDER BY id_gardu ASC";
                            $gardu = $con->query($gardu_query);
                            while ($data = $gardu->fetch_assoc()) { ?>
                                <option value="<?= $data['id_gardu'] ?>"><?= $data['area'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Alamat Pemasangan</label>
                    <div class="col-sm-10">
                        <textarea name="alamat_pemasangan" class="form-control" required></textarea>
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
    $id_daya = $_POST['id_daya'];
    $id_gardu = $_POST['id_gardu'];
    $alamat_pemasangan = $_POST['alamat_pemasangan'];
    $waktu_pengajuan = date('Y-m-d H:i:s');

    $tambah = $con->query("INSERT INTO pemasangan VALUES (
        default, 
        '$_SESSION[id_pelanggan]', 
        '$newNumber',
        '$id_daya',
        '$id_gardu',
        '$alamat_pemasangan',
        '$waktu_pengajuan',
        0,
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
?>

<script>
    $(document).ready(function() {
        $('#id_daya').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#biaya_pasang').val(selectedOption.data('biaya_pasang'));
        });
    });
</script>