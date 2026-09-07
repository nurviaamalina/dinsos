<?= $this->include('admin/layout/header') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/datalayanan.css') ?>">
<?= $this->include('admin/layout/sidebar') ?>

<div class="datalayanan-container">
    <main class="main-content">
        <div class="page-header create-page-header">
            <div>
                <h3>Edit Data Pelayanan</h3>
                <p class="subtitle">Kelola seluruh Data</p>
            </div>
        </div>

        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>Terjadi kesalahan:</span>
                <ul>
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?= session()->getFlashdata('success') ?></span>
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        <?php endif; ?>

        <div class="card create-card">
            <div class="card-header">
                <h5>Form Edit Data</h5>
                <a href="<?= base_url('admin/datalayanan/import') ?>" class="create-import-link">
                    <i class="bi bi-upload"></i> Import Data
                </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/datalayanan/update/' . $layanan->id) ?>" method="post" class="create-form">
                    <?= csrf_field() ?>

                    <div class="create-form-grid">
                        <div class="form-group create-period-field">
                            <label for="periode">Periode Bulan dan Tahun <span class="required">*</span></label>
                            <input type="text" class="form-control <?= session('errors.periode') ? 'is-invalid' : '' ?>"
                                   id="periode" name="periode" value="<?= old('periode', esc($layanan->periode)) ?>"
                                   placeholder="Contoh: Juli 2026" required>
                            <?php if(session('errors.periode')): ?>
                                <div class="invalid-feedback"><?= esc(session('errors.periode')) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group create-number-field">
                            <label for="jumlah">Jumlah <span class="required">*</span></label>
                            <input type="number" class="form-control <?= session('errors.jumlah') ? 'is-invalid' : '' ?>"
                                   id="jumlah" name="jumlah" value="<?= old('jumlah', esc($layanan->jumlah)) ?>" placeholder="0" min="0" required>
                            <?php if(session('errors.jumlah')): ?>
                                <div class="invalid-feedback"><?= esc(session('errors.jumlah')) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group create-number-field">
                            <label for="selesai">Selesai</label>
                            <input type="number" class="form-control" id="selesai" name="selesai"
                                   value="<?= old('selesai', esc($layanan->selesai ?? 0)) ?>" placeholder="0" min="0">
                        </div>

                        <div class="form-group create-number-field">
                            <label for="proses">Dalam Proses</label>
                            <input type="number" class="form-control" id="proses" name="proses"
                                   value="<?= old('proses', esc($layanan->proses ?? 0)) ?>" placeholder="0" min="0">
                        </div>

                        <div class="form-group create-service-field">
                            <label for="layanan">Nama Layanan <span class="required">*</span></label>
                            <?php $selectedLayanan = old('layanan', $layanan->layanan); ?>
                            <select class="form-control <?= session('errors.layanan') ? 'is-invalid' : '' ?>"
                                    id="layanan" name="layanan" required>
                                <option value="">Pilih Nama Layanan</option>
                                <?php foreach ($layananMaster as $item): ?>
                                    <option value="<?= esc($item['nama_layanan']) ?>"
                                        <?= $selectedLayanan === $item['nama_layanan'] ? 'selected' : '' ?>>
                                        <?= esc($item['nama_layanan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if(session('errors.layanan')): ?>
                                <div class="invalid-feedback"><?= esc(session('errors.layanan')) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group create-district-field">
                            <label for="kecamatan">Kecamatan <span class="required">*</span></label>
                            <?php $selectedKecamatan = old('kecamatan', $layanan->kecamatan); ?>
                            <select class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>"
                                    id="kecamatan" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                                <?php foreach ($kecamatan as $item): ?>
                                    <option value="<?= esc($item['nama_kecamatan']) ?>"
                                        <?= $selectedKecamatan === $item['nama_kecamatan'] ? 'selected' : '' ?>>
                                        <?= esc($item['nama_kecamatan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if(session('errors.kecamatan')): ?>
                                <div class="invalid-feedback"><?= esc(session('errors.kecamatan')) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group create-sector-field">
                            <label for="bidang">Bidang <span class="required">*</span></label>
                            <?php $selectedBidang = old('bidang', $layanan->bidang); ?>
                            <select class="form-control <?= session('errors.bidang') ? 'is-invalid' : '' ?>"
                                    id="bidang" name="bidang" required>
                                <option value="">Pilih Bidang</option>
                                <?php foreach ($bidang as $item): ?>
                                    <option value="<?= esc($item['nama_bidang']) ?>"
                                        <?= $selectedBidang === $item['nama_bidang'] ? 'selected' : '' ?>>
                                        <?= esc($item['nama_bidang']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if(session('errors.bidang')): ?>
                                <div class="invalid-feedback"><?= esc(session('errors.bidang')) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions create-form-actions">
                        <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?= $this->include('admin/layout/footer') ?>