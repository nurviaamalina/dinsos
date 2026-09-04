<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/layanan.css') ?>">

<div class="d-flex">
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <!-- HEADER HALAMAN -->
        <div class="layanan-page-header">
            <div>
                <h2>Capaian Keseluruhan Program / Layanan Dinas PPKB</h2>
                <p>Kelola seluruh Data</p>
            </div>
            <a href="<?= base_url('admin/layanan/create') ?>" class="btn-layanan-tambah">
                <i class="bi bi-plus-lg"></i> Tambah Layanan
            </a>
        </div>

        <!-- FLASH MESSAGE -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="layanan-alert-success">
                <i class="bi bi-check-circle"></i> <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <!-- CARD TABLE -->
        <div class="layanan-card">

            <div class="layanan-card-header">
                <form action="<?= base_url('admin/layanan') ?>" method="get">
                    <div class="layanan-search">
                        <i class="bi bi-search"></i>
                        <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari Layanan...">
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="layanan-table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Program / Layanan</th>
                            <th>Bidang</th>
                            <th>Deskripsi Singkat</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($layanan)): ?>
                            <?php $no = 1 + (($pager->getCurrentPage() - 1) * 10); ?>
                            <?php foreach ($layanan as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= esc($item['nama_layanan']) ?></strong></td>
                                    <td><?= esc($item['bidang']) ?></td>
                                    <td class="text-muted"><?= esc(substr(strip_tags($item['deskripsi_layanan']), 0, 80)) ?>...</td>
                                    <td>
                                        <!-- Sesuaikan dengan nama file di database jika ada -->
                                        <span class="badge-dokumen"><i class="bi bi-file-earmark-pdf"></i> PDF</span>
                                    </td>
                                    <!-- Form Toggle Status -->
                                    <td>
                                    <form action="<?= base_url('admin/layanan/toggle-status/' . $item['id']) ?>" method="POST" style="display: inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="status-badge <?= $item['status_layanan'] === 'Aktif' ? 'aktif' : 'nonaktif' ?>" title="Klik untuk ubah status">
                                            <?php if ($item['status_layanan'] === 'Aktif'): ?>
                                                PUBLIK
                                            <?php else: ?>
                                                Publikasikan
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                </td>
                                    <td>
                                        <div class="layanan-aksi">
                                            <a href="<?= base_url('admin/layanan/edit/' . $item['id']) ?>" class="aksi-edit" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= base_url('admin/layanan/delete/' . $item['id']) ?>" class="aksi-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="layanan-empty">
                                    <i class="bi bi-folder2-open"></i> <p>Belum ada data layanan.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if (!empty($layanan)): ?>
                <div class="layanan-pagination">
                    <?php
                    // Ambil data pager
                    $pager = \Config\Services::pager();
                    $currentPage = $pager->getCurrentPage();
                    $lastPage = $pager->getLastPage();
                    $perPage = $pager->getPerPage();
                    $total = $pager->getTotal();

                    // Tentukan rentang halaman yang ditampilkan (misal: 1 2 3 4 5)
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                    ?>
                    
                    <ul class="pagination-custom">
                        <!-- Panah Kiri -->
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a href="<?= $currentPage > 1 ? base_url('admin/layanan?page=' . ($currentPage - 1)) : '#' ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Nomor Halaman -->
                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a href="<?= base_url('admin/layanan?page=' . $i) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Panah Kanan -->
                        <li class="page-item <?= $currentPage >= $lastPage ? 'disabled' : '' ?>">
                            <a href="<?= $currentPage < $lastPage ? base_url('admin/layanan?page=' . ($currentPage + 1)) : '#' ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

<?= $this->include('admin/layout/footer') ?>