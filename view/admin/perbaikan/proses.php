<?php
require '../../../app/config.php';
$page = 'perbaikan';
include_once '../../layouts/header.php';

$id = $_GET['id'];

$cek = $con->query("SELECT status_kerusakan FROM kerusakan WHERE id_kerusakan = '$id' ")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-shield-check-line me-2"></i>Data Perbaikan
            </h5>
            <div class="pe-5">
                <span class="btn btn-primary btn-sm detail-btn" data-id="<?= $id; ?>" title="Detail">
                    <i class="ri-information-line me-2"></i>Detail Kerusakan
                </span>
                <?php if ($cek['status_kerusakan'] == 0) : ?>
                    <span class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-perbaikan">
                        <i class="ri-add-circle-fill me-2"></i>Input Perbaikan
                    </span>
                <?php endif ?>
                <a href="index" class="btn btn-sm btn-secondary"><i class="ri-arrow-left-circle-line me-2"></i>Kembali</a>
            </div>
        </div>
        <hr class="my-0">
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
                            <th>Tanggal</th>
                            <th>Pesan Perbaikan</th>
                            <th>Status Perbaikan</th>
                            <th>Petugas</th>
                            <?php if ($cek['status_kerusakan'] == 0) : ?>
                                <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM perbaikan WHERE id_kerusakan = '$id' ORDER BY id_perbaikan DESC");
                        while ($row = $data->fetch_array()) { ?>
                            <tr>
                                <td class="text-center" width="5%"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['tgl_mulai_perbaikan'] !== $row['tgl_selesai_perbaikan'] ? tgl($row['tgl_mulai_perbaikan']) . ' - ' . tgl($row['tgl_selesai_perbaikan']) : tgl($row['tgl_mulai_perbaikan']) ?></td>
                                <td><?= nl2br($row['pesan_perbaikan']) ?></td>
                                <td class="text-center">
                                    <?php if ($row['status_perbaikan'] == 1) { ?>
                                        <span class="badge bg-success">Perbaikan Selesai</span>
                                    <?php } else { ?>
                                        <span class="badge bg-info">Proses Perbaikan</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php $dataPetugas = $con->query("SELECT * FROM perbaikan_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_perbaikan = '$row[id_perbaikan]' "); ?>
                                    <?php
                                    $no2 = 1;
                                    while ($d2 = $dataPetugas->fetch_assoc()) {
                                        echo '<span class="me-2 mt-1">' . $no2++ . '.</span>';
                                        echo $d2['nm_up3'];
                                        echo '<hr class="my-1">';
                                    }
                                    ?>
                                </td>
                                <?php if ($cek['status_kerusakan'] == 0) : ?>
                                    <td align="center" width="10%">
                                        <a href="hapus?id=<?= $row[0] ?>&ids=<?= $id ?>" class="btn btn-danger btn-xs confirm-hapus" title="Hapus"><i class="ri-delete-bin-line me-2"></i> Hapus</a>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-information-line me-2"></i>Detail Data Laporan Kerusakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah-perbaikan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-add-circle-fill me-2"></i>Input Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-perbaikan" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Tanggal Perbaikan</label>
                        <div class="col-sm-5">
                            <input type="date" name="tgl_mulai_perbaikan" id="tgl_mulai_perbaikan" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih tanggal mulai Perbaikan" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                        <div class="col-sm-5">
                            <input type="date" name="tgl_selesai_perbaikan" id="tgl_selesai_perbaikan" data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih tanggal selesai Perbaikan" class="form-control" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Pesan Perbaikan</label>
                        <div class="col-sm-10">
                            <textarea name="pesan_perbaikan" id="pesan_perbaikan" class="form-control" required></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">UP3</label>
                        <div class="col-sm-10">
                            <select name="id_up3[]" id="id_up3" class="form-select select2" multiple required>
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
                                <button type="submit" name="tambah" class="btn btn-success"><i class="ri-save-3-fill me-2"></i>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../../layouts/footer.php';

if (isset($_POST['tambah'])) {
    $tgl_mulai_perbaikan = $_POST['tgl_mulai_perbaikan'];
    $tgl_selesai_perbaikan = $_POST['tgl_selesai_perbaikan'];
    $pesan_perbaikan = $_POST['pesan_perbaikan'];

    $tambah = $con->query("INSERT INTO perbaikan VALUES (
        default,
        '$id',
        '$tgl_mulai_perbaikan', 
        '$tgl_selesai_perbaikan',
        '$pesan_perbaikan',
        0
    )");

    if ($tambah) {

        $id_perbaikan = $con->insert_id;
        $id_up3_array = $_POST['id_up3'];

        if (!empty($id_up3_array)) {
            $values = [];
            foreach ($id_up3_array as $id_up3) {
                $id_up3 = $con->real_escape_string($id_up3);
                $values[] = "('$id_perbaikan', '$id_up3')";
            }

            $sql = "INSERT INTO perbaikan_up3 (id_perbaikan, id_up3) VALUES " . implode(", ", $values);

            if ($con->query($sql)) {
                echo "Data berhasil disimpan";
            } else {
                echo "Error: " . $con->error;
            }
        } else {
            echo "Tidak ada yang dipilih";
        }

        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=proses?id=$id'>";
    } else {
        $_SESSION['pesan'] = "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=prosese?id=$id'>";
    }
}
?>

<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var id = $(this).data('id');

            if (!id) {
                console.error('ID tidak ditemukan');
                alert('Tidak dapat memuat detail. ID tidak ditemukan.');
                return;
            }

            $.ajax({
                url: '../../detail/kerusakan.php',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#modalContent').html(response);
                    $('#detailModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', status, error);
                    alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
                }
            });
        });

        $('#tambah-perbaikan').on('show.bs.modal', function(e) {
            $('#tgl_mulai_perbaikan').val('');
            $('#tgl_selesai_perbaikan').val('');
            $('#pesan_perbaikan').val('');
            $('#form-tambah-perbaikan').removeClass('was-validated');
        });
    });
</script>