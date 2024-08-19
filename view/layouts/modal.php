<div class="modal fade" id="lapPemasangan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Pengajuan Pemasangan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPemasangan" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/pemasangan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Daya</label>
                                <select name="daya" id="dayaPemasangan" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM daya ORDER BY jenis_daya ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_daya'] ?>"><?= $row['jenis_daya'] . ' | ' . $row['jml_daya'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Area</label>
                                <select name="gardu" id="garduPemasangan" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gardu ORDER BY area ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gardu'] ?>"><?= $row['area'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Pengajuan</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanPemasangan" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunPemasangan" class="form-control">
                                    </div>
                                </div>
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

<div class="modal fade" id="lapUbahDaya" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Pengajuan Ubah Daya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUbahDaya" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/ubah-daya') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Daya</label>
                                <select name="daya" id="dayaUbahDaya" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM daya ORDER BY jenis_daya ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_daya'] ?>"><?= $row['jenis_daya'] . ' | ' . $row['jml_daya'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Pengajuan</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanUbahDaya" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunUbahDaya" class="form-control">
                                    </div>
                                </div>
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

<div class="modal fade" id="lapPengaduan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Pengaduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPengaduan" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/pengaduan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Area</label>
                                <select name="gardu" id="garduPengaduan" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gardu ORDER BY area ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gardu'] ?>"><?= $row['area'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Pengaduan</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanPengaduan" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunPengaduan" class="form-control">
                                    </div>
                                </div>
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

<div class="modal fade" id="lapKerusakan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Kerusakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formKerusakan" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/kerusakan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Area</label>
                                <select name="gardu" id="garduKerusakan" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gardu ORDER BY area ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gardu'] ?>"><?= $row['area'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Kerusakan</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanKerusakan" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunKerusakan" class="form-control">
                                    </div>
                                </div>
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

<div class="modal fade" id="lapPerbaikan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPerbaikan" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/perbaikan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Area</label>
                                <select name="gardu" id="garduPerbaikan" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gardu ORDER BY area ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gardu'] ?>"><?= $row['area'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Perbaikan</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanPerbaikan" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunPerbaikan" class="form-control">
                                    </div>
                                </div>
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

<div class="modal fade" id="lapMaintenance" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-printer-cloud-fill me-2"></i>Laporan Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formMaintenance" class="needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/maintenance') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Area</label>
                                <select name="gardu" id="garduMaintenance" class="select2 form-select">
                                    <option value="">-- pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gardu ORDER BY area ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gardu'] ?>"><?= $row['area'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Bulan dan Tahun Maintenance</label>
                                <div class="row">
                                    <div class="col-9">
                                        <select name="bulan" id="selectBulanMaintenance" class="select2 form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="tahun" id="tahunMaintenance" class="form-control">
                                    </div>
                                </div>
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
    $(document).ready(function() {

        // Fungsi untuk mengatur required pada tahun
        function setYearRequired(bulanSelectId, tahunInputId) {
            var $bulanSelect = $('#' + bulanSelectId);
            var $tahunInput = $('#' + tahunInputId);

            function updateYearRequired() {
                if ($bulanSelect.val()) {
                    $tahunInput.attr('data-required', 'true').addClass('is-invalid');
                } else {
                    $tahunInput.attr('data-required', 'false').removeClass('is-invalid');
                }
            }

            $bulanSelect.on('change', updateYearRequired);
            updateYearRequired(); // Inisialisasi status
        }

        // Fungsi validasi kustom
        function validateForm(formId) {
            var isValid = true;
            $('#' + formId + ' [data-required="true"]').each(function() {
                var $this = $(this);
                var isEmpty = $this.val() === '' || $this.val() === null;

                if ($this.hasClass('select2')) {
                    $this.next('.select2-container').toggleClass('is-invalid', isEmpty);
                } else {
                    $this.toggleClass('is-invalid', isEmpty);
                }

                if (isEmpty) {
                    isValid = false;
                }
            });
            return isValid;
        }

        // Fungsi untuk menambahkan validasi ke form
        function addFormValidation(formId) {
            $('#' + formId).on('submit', function(e) {
                if (!validateForm(formId)) {
                    e.preventDefault();
                }
            });
        }

        // Fungsi untuk mereset form
        function resetForm(modalId) {
            $(modalId).on('hidden.bs.modal', function() {
                var $modal = $(this);
                $modal.find('form')[0].reset();
                $modal.find('select.select2').val(null).trigger('change');
                $modal.find('.select2-container, .form-control').removeClass('is-invalid');

                // Perbarui status required untuk semua pasangan bulan-tahun
                $modal.find('select[id^="selectBulan"]').each(function() {
                    var bulanId = $(this).attr('id');
                    var tahunId = bulanId.replace('selectBulan', 'tahun');
                    setYearRequired(bulanId, tahunId);
                });
            });
        }

        // Menerapkan validasi dan reset untuk setiap form
        addFormValidation('formPemasangan');
        addFormValidation('formUbahDaya');
        addFormValidation('formPengaduan');
        addFormValidation('formKerusakan');
        addFormValidation('formPerbaikan');
        addFormValidation('formMaintenance');
        resetForm('#lapPemasangan');
        resetForm('#lapUbahDaya');
        resetForm('#lapPengaduan');
        resetForm('#lapKerusakan');
        resetForm('#lapPerbaikan');
        resetForm('#lapMaintenance');

        // Menerapkan validasi kondisional bulan-tahun untuk semua form yang memerlukan
        setYearRequired('selectBulanPemasangan', 'tahunPemasangan');
        setYearRequired('selectBulanUbahDaya', 'tahunUbahDaya');
        setYearRequired('selectBulanPengaduan', 'tahunPengaduan');
        setYearRequired('selectBulanKerusakan', 'tahunKerusakan');
        setYearRequired('selectBulanPerbaikan', 'tahunPerbaikan');
        setYearRequired('selectBulanMaintenance', 'tahunMaintenance');

        // Custom validasi untuk Select2
        $(document).on('select2:select select2:unselect', 'select.select2[data-required="true"]', function(e) {
            $(this).next('.select2-container').toggleClass('is-invalid', !this.value);
        });
    });
</script>