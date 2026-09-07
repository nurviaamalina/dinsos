<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/datalayanan.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin.css') ?>">
</head>
<body>
<?= $this->include('admin/layout/sidebar') ?>
    <div class="datalayanan-container">
        <main class="main-content">
            <div class="page-header import-page-header">
                <div>
                    <h3>Import Data Pelayanan</h3>
                    <p class="subtitle">Kelola seluruh Data</p>
                </div>
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
                <div class="card-body import-content">
                    <section class="import-format-card">
                        <h5>Keterangan Format CSV</h5>
                        <p>Pastikan file CSV yang diunggah memiliki format kolom seperti berikut.</p>
                        <div class="import-table-wrap">
                            <table class="import-format-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kolom</th>
                                        <th>Tipe Data</th>
                                        <th>Isi Kolom</th>
                                        <th>Contoh Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1.</td><td>Periode</td><td>Teks dan Angka</td><td>Bulan dan Tahun</td><td>Juli 2026</td></tr>
                                    <tr><td>2.</td><td>Nama Layanan</td><td>Teks</td><td>Nama Layanan</td><td>Layanan Permohonan SPM</td></tr>
                                    <tr><td>3.</td><td>Kecamatan</td><td>Teks</td><td>Nama Kecamatan</td><td>Banyuwangi</td></tr>
                                    <tr><td>4.</td><td>Jumlah</td><td>Angka 1 - 100</td><td>Jumlah keseluruhan permohonan</td><td>80</td></tr>
                                    <tr><td>5.</td><td>Selesai</td><td>Angka 1 - 100</td><td>Jumlah permohonan yang telah selesai</td><td>70</td></tr>
                                    <tr><td>6.</td><td>Proses</td><td>Angka 1 - 100</td><td>Jumlah permohonan yang dalam proses</td><td>10</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <div class="import-lower-grid">
                        <section class="import-upload-card">
                            <h5>Import Data Pelayanan</h5>
                            <form action="<?= base_url('admin/datalayanan/import') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <label for="file_import">Upload Dokumen</label>
                                <input type="file" id="file_import" name="file_import" accept=".csv" required>
                                <div class="import-dropzone">
                                    <i class="bi bi-cloud-upload"></i>
                                    <span>Choose a file or drag &amp; drop it here</span>
                                    <small>JPEG, PNG, PDF and MP4 files, up to 50MB</small>
                                    <label for="file_import" class="import-browse-button">Browse File</label>
                                </div>
                                <div class="import-actions">
                                    <a href="<?= base_url('admin/datalayanan') ?>" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import Data</button>
                                </div>
                            </form>
                        </section>

                        <aside class="import-guide-card">
                            <h5>Petunjuk Import</h5>
                            <ul>
                                <li>Pastikan <strong>nama kolom</strong> dan <strong>format data</strong> pada Excel sesuai dengan format yang telah ditentukan.</li>
                                <li>Pastikan data yang diinput sudah lengkap dan benar sebelum melakukan import.</li>
                                <li>Kolom <strong>Jumlah, Selesai,</strong> dan <strong>Proses</strong> diisi dengan angka sesuai jumlah permohonan.</li>
                                <li>Jika kolom Selesai atau Proses tidak diisi, sistem tidak akan bisa menghitung persentase.</li>
                                <li>Pastikan file yang diunggah menggunakan format <strong>CSV (.csv)</strong>.</li>
                            </ul>
                            <a href="<?= base_url('admin/datalayanan/download-template') ?>" class="import-template-link">
                                <i class="bi bi-download"></i> Download Template
                            </a>
                        </aside>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>