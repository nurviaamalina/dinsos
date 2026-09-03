<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/datalayanan.css') ?>">
</head>
<body>
    <div class="datalayanan-container">
        <!-- Sidebar -->
        <?= $this->include('admin/layout/sidebar') ?>

        <main class="main-content">
            <div class="page-header">
                <div>
                    <h3>Edit Data Pelayanan</h3>
                    <p class="subtitle">Kliklah selanjutnya Data</p>
                </div>
                <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <span><i class="fas fa-exclamation-circle"></i> Terjadi kesalahan:</span>
                    <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-pen"></i> Form Edit Data Pelayanan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/datalayanan/update/' . $layanan->id) ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pendaftar">Pendaftar <span class="required">*</span></label>
                                <input type="text" class="form-control <?= session('errors.pendaftar') ? 'is-invalid' : '' ?>" 
                                       id="pendaftar" name="pendaftar" value="<?= old('pendaftar', $layanan->pendaftar) ?>" 
                                       placeholder="Nama pendaftar" required>
                                <?php if(session('errors.pendaftar')): ?>
                                    <div class="invalid-feedback"><?= session('errors.pendaftar') ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal <span class="required">*</span></label>
                                <input type="date" class="form-control <?= session('errors.tanggal') ? 'is-invalid' : '' ?>" 
                                       id="tanggal" name="tanggal" value="<?= old('tanggal', $layanan->tanggal) ?>" required>
                                <?php if(session('errors.tanggal')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tanggal') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="status">Status <span class="required">*</span></label>
                                <select class="form-control <?= session('errors.status') ? 'is-invalid' : '' ?>" 
                                        id="status" name="status" required>
                                    <option value="Pending" <?= old('status', $layanan->status) == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Proses" <?= old('status', $layanan->status) == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= old('status', $layanan->status) == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Ditolak" <?= old('status', $layanan->status) == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                </select>
                                <?php if(session('errors.status')): ?>
                                    <div class="invalid-feedback"><?= session('errors.status') ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah <span class="required">*</span></label>
                                <input type="number" class="form-control <?= session('errors.jumlah') ? 'is-invalid' : '' ?>" 
                                       id="jumlah" name="jumlah" value="<?= old('jumlah', $layanan->jumlah) ?>" 
                                       placeholder="0" min="0" required>
                                <?php if(session('errors.jumlah')): ?>
                                    <div class="invalid-feedback"><?= session('errors.jumlah') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr style="margin: 1.5rem 0;">

                        <h6 style="margin-bottom: 1rem; color: var(--primary-color);"><i class="fas fa-car"></i> Kendaraan</h6>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" 
                                       value="<?= old('jenis_kendaraan', $layanan->jenis_kendaraan) ?>" 
                                       placeholder="Contoh: Mobil, Motor">
                            </div>
                            <div class="form-group">
                                <label for="merek_kendaraan">Merek Kendaraan</label>
                                <input type="text" class="form-control" id="merek_kendaraan" name="merek_kendaraan" 
                                       value="<?= old('merek_kendaraan', $layanan->merek_kendaraan) ?>" 
                                       placeholder="Contoh: Toyota, Honda">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="warna_kendaraan">Warna Kendaraan</label>
                                <input type="text" class="form-control" id="warna_kendaraan" name="warna_kendaraan" 
                                       value="<?= old('warna_kendaraan', $layanan->warna_kendaraan) ?>" 
                                       placeholder="Contoh: Merah, Hitam">
                            </div>
                            <div class="form-group">
                                <label for="lokasi_kendaraan">Lokasi Kendaraan</label>
                                <input type="text" class="form-control" id="lokasi_kendaraan" name="lokasi_kendaraan" 
                                       value="<?= old('lokasi_kendaraan', $layanan->lokasi_kendaraan) ?>" 
                                       placeholder="Alamat/lokasi kendaraan">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kategori_kendaraan">Kategori Kendaraan</label>
                                <input type="text" class="form-control" id="kategori_kendaraan" name="kategori_kendaraan" 
                                       value="<?= old('kategori_kendaraan', $layanan->kategori_kendaraan) ?>" 
                                       placeholder="Contoh: SUV, Sedan">
                            </div>
                        </div>

                        <hr style="margin: 1.5rem 0;">

                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>