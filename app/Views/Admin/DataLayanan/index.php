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

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h3>Data Pelayanan</h3>
                    <p class="subtitle">Kliklah selanjutnya Data Perawatan, Pengaturan untuk Keluardhan Statistik</p>
                </div>
            </div>

            <!-- Tab Pembayaran / Statistik Cards -->
            <div class="tab-pembayaran">
                <div class="tab-header">
                    <h5><i class="fas fa-credit-card"></i> Tab Pembayaran</h5>
                </div>
                <div class="tab-stats">
                    <div class="tab-stat-item">
                        <span class="label">Jumlah</span>
                        <span class="value"><?= $statistik->total_permohonan ?? 0 ?></span>
                    </div>
                    <div class="tab-stat-item">
                        <span class="label">Status</span>
                        <span class="value"><?= $statistik->permohonan_selesai ?? 0 ?></span>
                    </div>
                    <div class="tab-stat-item">
                        <span class="label">Tanggal</span>
                        <span class="value"><?= date('d-m-Y') ?></span>
                    </div>
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

            <!-- Table -->
            <div class="table-wrapper">
                <div class="table-header">
                    <h5>Daftar Permohonan</h5>
                    <div class="table-actions">
                        <form action="<?= base_url('admin/datalayanan') ?>" method="get" class="search-box">
                            <input type="text" name="search" placeholder="Cari..." value="<?= $search ?? '' ?>">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <a href="<?= base_url('admin/datalayanan/create') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                        <a href="<?= base_url('admin/datalayanan/export') ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export
                        </a>
                        <a href="<?= base_url('admin/datalayanan/import') ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-upload"></i> Import
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pendaftar</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($layanan)): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5>Belum Ada Data</h5>
                                            <p>Silakan tambahkan data pelayanan pertama Anda</p>
                                            <a href="<?= base_url('admin/datalayanan/create') ?>" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Tambah Data
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($layanan as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $row->pendaftar ?></strong></td>
                                    <td><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                                    <td>
                                        <?php
                                            $statusClass = 'badge-warning';
                                            if ($row->status == 'Selesai') $statusClass = 'badge-success';
                                            elseif ($row->status == 'Pending') $statusClass = 'badge-warning';
                                            elseif ($row->status == 'Ditolak') $statusClass = 'badge-danger';
                                            elseif ($row->status == 'Proses') $statusClass = 'badge-info';
                                        ?>
                                        <span class="badge <?= $statusClass ?>"><?= $row->status ?></span>
                                    </td>
                                    <td><strong>Rp <?= number_format($row->jumlah, 0, ',', '.') ?></strong></td>
                                    <td>
                                        <?php
                                            $statusClass = 'badge-warning';
                                            if ($row->status == 'Selesai') $statusClass = 'badge-success';
                                            elseif ($row->status == 'Pending') $statusClass = 'badge-warning';
                                            elseif ($row->status == 'Ditolak') $statusClass = 'badge-danger';
                                            elseif ($row->status == 'Proses') $statusClass = 'badge-info';
                                        ?>
                                        <span class="badge <?= $statusClass ?>"><?= $row->status ?></span>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                                            <a href="<?= base_url('admin/datalayanan/edit/' . $row->id) ?>" class="btn btn-warning btn-xs" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('admin/datalayanan/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <small>
                        <i class="fas fa-database"></i>
                        Total Data: <?= $total_data ?? 0 ?>
                    </small>
                    <small>
                        <i class="fas fa-clock"></i>
                        Diperbarui: <?= date('d-m-Y H:i:s') ?>
                    </small>
                </div>
            </div>
        </main>
    </div>
</body>
</html>