<?php
require '../../../app/config.php';
$page = 'up3';
include_once '../../layouts/header.php';
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-user-settings-line me-2"></i>Data Unit Pelaksana Pelayanan Pelanggan (UP3)
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Gender</th>
                            <th>TTL</th>
                            <th>Usia</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>TMT</th>
                            <th>Masa Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM up3 ORDER BY id_up3 DESC");
                        while ($row = $data->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center" width="5%"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['kode_up3'] ?></td>
                                <td><?= $row['nm_up3'] ?></td>
                                <td class="text-center"><?= $row['nik_up3'] ?></td>
                                <td class="text-center"><?= $row['jk_up3'] ?></td>
                                <td><?= $row['tmpt_lahir_up3'] . ', ' . tgl($row['tgl_lahir_up3']) ?></td>
                                <td class="text-center"><?= usia($row['tgl_lahir_up3']) ?></td>
                                <td class="text-center"><?= $row['agama_up3'] ?></td>
                                <td><?= $row['alamat_up3'] ?></td>
                                <td class="text-center"><?= $row['hp_up3'] ?></td>
                                <td class="text-center"><?= tgl($row['tmt']) ?></td>
                                <td class="text-center"><?= usia($row['tmt']) ?></td>
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

<?php
include_once '../../layouts/footer.php';
?>