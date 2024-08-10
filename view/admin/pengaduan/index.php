<?php
require '../../../app/config.php';
$page = 'pengaduan';
include_once '../../layouts/header.php';
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-chat-follow-up-line me-2"></i>Data Pengaduan
            </h5>
            <div class="pe-5">
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
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Area</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM pengaduan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan LEFT JOIN gardu c ON a.id_gardu = c.id_gardu ORDER BY id_pengaduan DESC");
                        while ($row = $data->fetch_array()) {

                            $jmlTanggapan = $con->query("SELECT COUNT(*) AS total FROM tanggapan WHERE id_pengaduan = '$row[0]' ")->fetch_array();
                        ?>
                            <tr>
                                <td class="text-center" width="5%"><?= $no++ ?></td>
                                <td><?= $row['nm_pelanggan'] ?></td>
                                <td class="text-center"><?= $row['nik_pelanggan'] ?></td>
                                <td class="text-center"><?= $row['area'] ?></td>
                                <td><?= nl2br($row['pesan_pengaduan']) ?></td>
                                <td class="text-center">
                                    <?php if ($row['status_pengaduan'] == 1) { ?>
                                        <span class="badge bg-success">Sudah Ditanggapi</span>
                                        <br>
                                        <small class="fw-semibold">Jumlah Tanggapan : <?= $jmlTanggapan['total']; ?> Data</small>
                                    <?php } else { ?>
                                        <span class="badge bg-warning">Belum Ditanggapi</span>
                                    <?php } ?>
                                </td>
                                <td align="center" width="14%">
                                    <span class="btn text-white btn-primary btn-xs detail-btn" data-id="<?= $row[0]; ?>" title="Detail">
                                        <i class="ri-information-line me-2"></i>Detail
                                    </span>
                                    <a href="detail?id=<?= $row[0] ?>" class="btn text-white btn-success btn-xs"><i class="ri-edit-2-line me-2"></i>Tanggapan</a>
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
                <h5 class="modal-title"><i class="ri-information-line me-2"></i>Detail Data Pengaduan</h5>
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
                url: '../../detail/pengaduan.php',
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