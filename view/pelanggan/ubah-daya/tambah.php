<?php
require '../../../app/config.php';
$page = 'ubah_daya';
include_once '../../layouts/header.php';

$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

$query = $con->query("SELECT MAX(SUBSTRING(no_ubah_daya, 4)) AS max_id FROM ubah_daya");
$row = $query->fetch_assoc();
$max_id = $row['max_id'];

// Membuat nomor ubah_daya baru
if ($max_id) {
    $newNumber = 'NUD' . str_pad($max_id + 1, 6, '0', STR_PAD_LEFT);
} else {
    $newNumber = 'NUD000001';
}

?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-speed-up-line me-2"></i>Pengajuan Ubah Daya
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
                    <label class="col-sm-2 col-form-label">Nomor Ubah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" value="<?= $newNumber ?>" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pilih Daya Sekarang</label>
                    <div class="col-sm-10">
                        <select name="id_pemasangan" id="id_pemasangan" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $pemasangan_query = "SELECT * FROM pemasangan a LEFT JOIN daya b ON a.id_daya = b.id_daya WHERE a.id_pelanggan = '$_SESSION[id_pelanggan]' AND a.verif = 1 ORDER BY id_pemasangan ASC";
                            $pemasangan = $con->query($pemasangan_query);
                            while ($data = $pemasangan->fetch_assoc()) { ?>
                                <option value="<?= $data['id_pemasangan'] ?>" data-id_daya_lama="<?= $data['id_daya'] ?>" data-no_pemasangan="<?= $data['no_pemasangan'] ?>" data-tgl_pemasangan="<?= tgl($data['tgl_pemasangan']) ?>"><?= $data['golongan'] . ' | ' . $data['jenis_daya'] . ' - ' . $data['jml_daya'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Nomor Pemasangan</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control bg-light" id="id_daya_lama" name="id_daya_lama" required>
                        <input type="text" class="form-control bg-light" id="no_pemasangan" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Tanggal Pemasangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" id="tgl_pemasangan" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Pilih Daya Baru</label>
                    <div class="col-sm-10">
                        <select name="id_daya" id="id_daya" class="form-select select2" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $daya_query = "SELECT * FROM daya ORDER BY id_daya ASC";
                            $daya = $con->query($daya_query);
                            while ($data = $daya->fetch_assoc()) { ?>
                                <option value="<?= $data['id_daya'] ?>" data-biaya_ubah_daya="<?= rupiah($data['biaya_ubah_daya']) ?>"><?= $data['golongan'] . ' | ' . $data['jenis_daya'] . ' - ' . $data['jml_daya'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Biaya Ubah Daya</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light" id="biaya_ubah_daya" readonly>
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
    $id_pemasangan = $_POST['id_pemasangan'];
    $id_daya_lama = $_POST['id_daya_lama'];
    $id_daya = $_POST['id_daya'];
    $waktu_pengajuan = date('Y-m-d H:i:s');

    $tambah = $con->query("INSERT INTO ubah_daya VALUES (
        default, 
        '$newNumber',
        '$id_pemasangan',
        '$id_daya_lama',
        '$id_daya',
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
            $('#biaya_ubah_daya').val(selectedOption.data('biaya_ubah_daya'));
        });

        $('#id_pemasangan').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#no_pemasangan').val(selectedOption.data('no_pemasangan'));
            $('#tgl_pemasangan').val(selectedOption.data('tgl_pemasangan'));
            $('#id_daya_lama').val(selectedOption.data('id_daya_lama'));
        });
    });
</script>