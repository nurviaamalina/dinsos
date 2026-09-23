<?= $this->include('admin/layout/header') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/datalayanan.css') ?>">
<?= $this->include('admin/layout/sidebar') ?>

<div class="datalayanan-container">
    <main class="main-content">
        <div class="page-header">
            <div>
                <h3>Data Pelayanan</h3>
                <p class="subtitle">Kelola seluruh Data Permohonan, Pengajuan untuk Kebutuhan Statistik</p>
            </div>
        </div>

        <!-- STATISTIK CARDS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Permohonan</span>
                    <span class="stat-value"><?= isset($statistik->total_permohonan) ? $statistik->total_permohonan : 0 ?></span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Permohonan Selesai</span>
                    <span class="stat-value"><?= isset($statistik->permohonan_selesai) ? $statistik->permohonan_selesai : 0 ?></span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Permohonan Proses</span>
                    <span class="stat-value"><?= isset($statistik->permohonan_proses) ? $statistik->permohonan_proses : 0 ?></span>
                </div>
            </div>
        </div>

        <!-- FLASH MESSAGES -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <span><?= session()->getFlashdata('success') ?></span>
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        <?php endif; ?>

        <!-- TABLE -->
        <div class="table-wrapper">
            <div class="table-header">
                <h5>Daftar Permohonan</h5>
                <div class="table-actions">
                    <form action="<?= base_url('admin/datalayanan') ?>" method="get" class="search-box">
                        <input type="text" name="search" placeholder="Cari..." value="<?= isset($search) ? $search : '' ?>">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="<?= base_url('admin/datalayanan/create') ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Layanan
                    </a>
                    <a href="<?= base_url('admin/datalayanan/import') ?>" class="btn btn-info btn-sm">
                        <i class="bi bi-upload"></i> Import
                    </a>
                    <a href="<?= base_url('admin/datalayanan/export') ?>" class="btn btn-success btn-sm">
                        <i class="bi bi-download"></i> Export
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Layanan</th>
                            <th>Bidang</th>
                            <th>Kecamatan</th>
                            <th>Jumlah</th>
                            <th>Selesai</th>
                            <th>Proses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($layanan)): ?>
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h5>Belum Ada Data</h5>
                                        <p>Silakan tambahkan data pelayanan pertama Anda</p>
                                        <a href="<?= base_url('admin/datalayanan/create') ?>" class="btn btn-primary">
                                            <i class="bi bi-plus-lg"></i> Tambah Data
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1 + (($pager->getCurrentPage() - 1) * 10); foreach($layanan as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= esc($row->periode) ?></strong></td>
                                <td><?= esc($row->layanan) ?></td>
                                <td><?= esc($row->bidang) ?></td>
                                <td><?= esc($row->kecamatan) ?></td>
                                <td><strong><?= number_format($row->jumlah) ?></strong></td>
                                <td><span class="badge badge-success"><?= number_format($row->selesai ?? 0) ?></span></td>
                                <td><span class="badge badge-warning"><?= number_format($row->proses ?? 0) ?></span></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= base_url('admin/datalayanan/edit/' . $row->id) ?>" class="btn btn-warning btn-xs" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= base_url('admin/datalayanan/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if (!empty($layanan)): ?>
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <small>
                            <i class="bi bi-database"></i>
                            Total Data: <?= isset($total_data) ? $total_data : 0 ?>
                        </small>
                        <small>
                            <i class="bi bi-clock"></i>
                            Diperbarui: <?= date('d-m-Y H:i:s') ?>
                        </small>
                    </div>

                    <div class="datalayanan-pagination">
                        <?php
                        $currentPage = $pager->getCurrentPage();
                        $lastPage = $pager->getLastPage();
                        $searchQuery = $search ? '&' . http_build_query(['search' => $search]) : '';

                        // Tentukan rentang halaman yang ditampilkan (misal: 1 2 3 4 5)
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                        ?>

                        <ul class="pagination">
                            <!-- Panah Kiri -->
                            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $currentPage > 1 ? base_url('admin/datalayanan?page=' . ($currentPage - 1) . $searchQuery) : '#' ?>">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            <!-- Nomor Halaman -->
                            <?php for ($i = $start; $i <= $end; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= base_url('admin/datalayanan?page=' . $i . $searchQuery) ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <!-- Panah Kanan -->
                            <li class="page-item <?= $currentPage >= $lastPage ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $currentPage < $lastPage ? base_url('admin/datalayanan?page=' . ($currentPage + 1) . $searchQuery) : '#' ?>">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <div class="table-footer">
                    <small>
                        <i class="bi bi-database"></i>
                        Total Data: <?= isset($total_data) ? $total_data : 0 ?>
                    </small>
                    <small>
                        <i class="bi bi-clock"></i>
                        Diperbarui: <?= date('d-m-Y H:i:s') ?>
                    </small>
                </div>
            <?php endif; ?>

        </div>

    </main>
</div>

<?= $this->include('admin/layout/footer') ?>