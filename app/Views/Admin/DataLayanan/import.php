<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/datalayanan.css') ?>">
</head>
<body>
    <div class="datalayanan-container">
        <!-- Sidebar -->
        <?= $this->include('admin/layout/sidebar') ?>

        <main class="main-content">
            <div class="page-header">
                <div>
                    <h3>Import Data Pelayanan</h3>
                    <p class="subtitle">Kliklah selanjutnya Untuk ...</p>
                </div>
                <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Flash Messages -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <span><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></span>
                    <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <span><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></span>
                    <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-file-csv"></i> Import dari File CSV</h5>
                </div>
                <div class="card-body">
                    <!-- Informasi Format File -->
                    <div class="alert" style="background: #d1ecf1; color: #0c5460; border-left: 4px solid var(--info-color);">
                        <i class="fas fa-info-circle"></i>
                        <strong>Format File:</strong> CSV dengan header: Pendaftar, Tanggal, Status, Jumlah, Jenis Kendaraan, Merek, Warna, Lokasi, Kategori
                    </div>

                    <!-- Form Import -->
                    <form action="<?= base_url('admin/datalayanan/import') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label for="file_import">Pilih File CSV <span class="required">*</span></label>
                            <input type="file" class="form-control" id="file_import" name="file_import" 
                                   accept=".csv" required>
                            <small style="color: #666; display: block; margin-top: 0.3rem;">
                                <i class="fas fa-info-circle"></i> Maksimal ukuran file: 2MB
                            </small>
                        </div>

                        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Import
                            </button>
                            <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>

                    <hr style="margin: 2rem 0;">

                    <!-- Download Template -->
                    <div>
                        <h6><i class="fas fa-download"></i> Download Template</h6>
                        <p style="color: #666; font-size: 0.9rem;">Download template CSV untuk memudahkan import data</p>
                        <a href="<?= base_url('admin/datalayanan/download-template') ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Download Template
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>