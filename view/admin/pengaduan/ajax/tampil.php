<div class="table-responsive text-nowrap">
    <table id="tbl" class="table table-hover table-bordered table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggapan</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../../../../app/config.php";
            $id1 = $_POST['id'];
            $no = 1;
            $data = $con->query("SELECT * FROM tanggapan l LEFT JOIN pengaduan a ON l.id_pengaduan = a.id_pengaduan WHERE l.id_pengaduan = '$id1' ORDER BY id_tanggapan DESC");
            while ($row = $data->fetch_array()) { ?>
                <tr>
                    <td class="text-center" width="5%"><?= $no++ ?></td>
                    <td><?= nl2br($row['pesan_tanggapan']) ?></td>
                    <td class="text-center"><?= tglWaktu($row['waktu_tanggapan']) ?></td>
                    <td class="text-center" width="14%">
                        <?php if ($row['bukti_tanggapan']) { ?>
                            <a href="<?= base_url('storage/tanggapan/' . $row['bukti_tanggapan']) ?>" target="_blank" class="btn btn-xs btn-success"><i class="ri-file-image-line me-2"></i>Bukti</a>
                        <?php } ?>
                        <span class="btn text-white btn-info btn-xs detail-btn" id="edit" data-id="<?= $row[0]; ?>">
                            <i class=" ri-edit-2-line me-2"></i>Edit
                        </span>
                        <span class="btn text-white btn-danger btn-xs detail-btn" id="hapus" data-id="<?= $row[0]; ?>">
                            <i class="ri-delete-bin-line me-2"></i>Hapus
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>