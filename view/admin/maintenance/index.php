<?php
require '../../../app/config.php';
$page = 'maintenance';
include_once '../../layouts/header.php';
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-tools-line me-2"></i>Data Maintenance
            </h5>
            <div class="pe-5">
                <a href="tambah" class="btn btn-sm btn-primary"><i class="ri-add-circle-fill me-2"></i>Tambah Data</a>
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
                            <th>Area</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>UP3</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM maintenance a LEFT JOIN gardu c ON a.id_gardu = c.id_gardu ORDER BY id_maintenance DESC");
                        while ($row = $data->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center" width="5%"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['area'] ?></td>
                                <td class="text-center"><?= $row['tgl_mulai_maintenance'] !== $row['tgl_selesai_maintenance'] ? tgl($row['tgl_mulai_maintenance']) . ' - ' . tgl($row['tgl_selesai_maintenance']) : tgl($row['tgl_mulai_maintenance']) ?></td>
                                <td><?= nl2br($row['deskripsi_maintenance']) ?></td>
                                <td>
                                    <?php $dataPetugas = $con->query("SELECT * FROM maintenance_up3 a LEFT JOIN up3 b ON a.id_up3 = b.id_up3 WHERE a.id_maintenance = '$row[id_maintenance]' "); ?>
                                    <?php
                                    $no2 = 1;
                                    while ($d2 = $dataPetugas->fetch_assoc()) {
                                        echo '<span class="me-2 mt-1">' . $no2++ . '.</span>';
                                        echo $d2['nm_up3'];
                                        echo '<hr class="my-1">';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['tgl_mulai_maintenance'] > date('Y-m-d')) : ?>
                                        <span class="badge bg-secondary">Belum Berjalan</span>
                                    <?php elseif ($row['tgl_selesai_maintenance'] < date('Y-m-d')) : ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php elseif ($row['tgl_mulai_maintenance'] >= date('Y-m-d') && $row['tgl_selesai_maintenance'] >= date('Y-m-d')) : ?>
                                        <span class="badge bg-info">Sedang Berjalan</span>
                                    <?php endif ?>
                                </td>
                                <td align="center" width="14%">
                                    <a href="edit?id=<?= $row[0] ?>" class="btn text-white btn-info btn-xs" title="Edit"><i class="ri-edit-2-line me-2"></i>Edit</a>
                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs confirm-hapus" title="Hapus"><i class="ri-delete-bin-line me-2"></i> Hapus</a>
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

<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-information-line me-2"></i>Detail Data Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
</div>

<?php
include_once '../../layouts/footer.php';
?>

<script>
    $(document).ready(function() {
        $('#example tbody').on('click', '.detail-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var id = $(this).data('id');

            if (!id) {
                console.error('ID tidak ditemukan');
                alert('Tidak dapat memuat detail. ID tidak ditemukan.');
                return;
            }

            $.ajax({
                url: '../../detail/maintenance.php',
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
    });
</script>