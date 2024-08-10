<?php
require '../../../app/config.php';
$page = 'pemasangan';
include_once '../../layouts/header.php';
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-plug-line me-2"></i>Data Pemasangan Baru
            </h5>
            <div class="pe-5">
                <a href="tambah" class="btn btn-sm btn-primary"><i class="ri-add-circle-fill me-2"></i>Input Pengajuan</a>
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
                            <th>No. Pemasangan</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Daya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM pemasangan a LEFT JOIN daya b ON a.id_daya = b.id_daya LEFT JOIN gardu c ON a.id_gardu = c.id_gardu LEFT JOIN pelanggan d ON a.id_pelanggan = d.id_pelanggan WHERE a.id_pelanggan = '$_SESSION[id_pelanggan]' ORDER BY id_pemasangan DESC");
                        while ($row = $data->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center" width="5%"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['no_pemasangan'] ?></td>
                                <td><?= $row['nm_pelanggan'] ?></td>
                                <td class="text-center"><?= $row['nik_pelanggan'] ?></td>
                                <td class="text-center"><?= $row['jenis_daya'] . ' - ' . $row['jml_daya'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['verif'] == 1) { ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php } else if ($row['verif'] == 2) { ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php } else { ?>
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    <?php } ?>
                                </td>
                                <td align="center" width="14%">
                                    <span class="btn text-white btn-primary btn-xs detail-btn" data-id="<?= $row[0]; ?>" title="Detail">
                                        <i class="ri-information-line me-2"></i>Detail
                                    </span>
                                    <?php if ($row['verif'] == 0) { ?>
                                        <a href="edit?id=<?= $row[0] ?>" class="btn text-white btn-info btn-xs" title="Edit"><i class="ri-edit-2-line me-2"></i>Edit</a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs confirm-hapus" title="Hapus"><i class="ri-delete-bin-line me-2"></i>Hapus</a>
                                    <?php } ?>
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
                <h5 class="modal-title"><i class="ri-information-line me-2"></i>Detail Data Pengajuan Pemasangan Baru</h5>
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
        $('select[name="periode"]').on('change', function() {
            $(this).closest('form').submit();
        });

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
                url: '../../detail/pemasangan.php',
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