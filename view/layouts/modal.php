<div class="modal fade" id="lapSample" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Sample</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/sample') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Nama</label>
                                <select name="user" class="select2 form-select">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM user ORDER BY nm_user ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_user'] ?>"><?= $row['nm_user'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="ri-printer-cloud-fill me-2"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?= base_url() ?>/assets/vendor/libs/jquery/jquery.js"></script>

<script>
    $(function() {
        $('#selectSample').select2({
            dropdownParent: $('#lapSample')
        });
    });
</script>