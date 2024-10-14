<?php
require '../../../app/config.php';
$page = 'barang';
include_once '../../layouts/header.php';

$id = $_GET['id'];
$row = $con->query("SELECT * FROM barang WHERE id_barang = '$id'")->fetch_array();
?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="justify-content-between d-flex align-items-center">
            <h5 class="card-header">
                <i class="menu-icon tf-icons ri-download-2-line me-2"></i>Data Barang Masuk (<?= $row['nm_barang'] ?>)
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
            <form class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $row['nm_barang'] ?>" class="form-control bg-light" readonly>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-6">
                        <input type="number" name="jumlah" class="form-control" required>
                        <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" value="<?= $row['satuan'] ?>" class="form-control bg-light" readonly>
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
                            <th>Tanggal</th>
                            <th>Nama barang</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = $con->query("SELECT * FROM barang_masuk a LEFT JOIN barang b ON a.id_barang = b.id_barang WHERE a.id_barang = '$id' ORDER BY a.tanggal DESC");
                        while ($row2 = $data->fetch_array()) {
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++ ?></td>
                                <td class="text-center"><?= tgl($row2['tanggal']) ?></td>
                                <td><?= $row2['nm_barang'] ?></td>
                                <td class="text-center"><?= $row2['jumlah'] . ' ' . $row2['satuan'] ?></td>
                                <td align="center">
                                    <a href="hapus-masuk?id=<?= $row2[0] ?>&ids=<?= $id ?>" class="btn btn-danger btn-xs confirm-hapus" title="Hapus"><i class="ri-delete-bin-line me-2"></i> Hapus</a>
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
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $tambah = $con->query("INSERT INTO barang_masuk VALUES (
        default,
        '$tanggal', 
        '$id', 
        '$jumlah'
    )");

    if ($tambah) {
        $con->query("UPDATE barang SET stok = (stok + '$jumlah') WHERE id_barang = '$id'");
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=masuk?id=$id'>";
    } else {
        $_SESSION['error'] = "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=masuk?id=$id'>";
    }
}
?>