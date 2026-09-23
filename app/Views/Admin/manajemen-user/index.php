<?= $this->include('Admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/manajemen.css') ?>">

<div class="user-admin-layout">

    <!-- SIDEBAR -->
    <?= $this->include('Admin/layout/sidebar') ?>

    <!-- OVERLAY MOBILE UNTUK SIDEBAR -->
    <div class="sidebar-mobile-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="user-main-content">

        <!-- =====================================================
             TOPBAR NAVIGATION
        ====================================================== -->
        <header class="topbar-nav">
            <div class="topbar-left">
                <button type="button" class="btn-sidebar-toggle" id="btnSidebarToggle" aria-label="Buka Menu Navigasi">
                    <i class="bi bi-list"></i>
                </button>
                <div class="welcome-text">
                    <h2>Selamat Datang, <?= esc(session()->get('username') ?? 'Admin Dinsos') ?></h2>
                    <p>Dinas Sosial Kabupaten / Kota</p>
                </div>
            </div>

            <div class="topbar-right">
                <!-- Notifikasi Lonceng -->
                <div class="notification-bell" title="Notifikasi">
                    <i class="bi bi-bell-fill"></i>
                    <span class="bell-badge">3</span>
                </div>

                <!-- Profil Dropdown -->
                <div class="topbar-profile dropdown">
                    <div class="profile-trigger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        <div class="profile-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="profile-name"><?= esc(session()->get('username') ?? 'Admin Dinsos') ?></span>
                        <i class="bi bi-chevron-down profile-chevron"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li>
                            <a class="dropdown-item py-2" href="<?= base_url('admin/profil') ?>">
                                <i class="bi bi-person me-2 text-secondary"></i> Profil Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <a class="dropdown-item py-2 text-danger" href="<?= site_url('logout') ?>">
                                <i class="bi bi-box-arrow-left me-2"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- =====================================================
             KARTU UTAMA MANAJEMEN USER
        ====================================================== -->
        <div class="user-container">

            <!-- HEADER HALAMAN & TOMBOL TAMBAH USER -->
            <div class="user-header">
                <div class="user-title-wrapper">
                    <div class="user-title-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h1>Manajemen User</h1>
                        <p>Kelola data pengguna sistem Dinas Sosial</p>
                    </div>
                </div>

                <?php if (session()->get('role') === 'superadmin') : ?>
                    <a href="<?= base_url('admin/manajemen-user/create') ?>" class="btn-add-user">
                        <i class="bi bi-plus-lg"></i>
                        Tambah User
                    </a>
                <?php endif; ?>
            </div>

            <!-- FLASH MESSAGES -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="user-alert user-alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="user-alert user-alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
            <?php endif; ?>

            <!-- STATISTIK CARDS (4 KOLOM) -->
            <div class="user-statistics">
                <div class="stat-card stat-total">
                    <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-content">
                        <span>Total User</span>
                        <strong><?= (int) ($totalUser ?? 0) ?></strong>
                    </div>
                </div>

                <div class="stat-card stat-admin">
                    <div class="stat-icon"><i class="bi bi-person-fill"></i></div>
                    <div class="stat-content">
                        <span>Admin</span>
                        <strong><?= (int) ($totalAdmin ?? 0) ?></strong>
                    </div>
                </div>

                <div class="stat-card stat-operator">
                    <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
                    <div class="stat-content">
                        <span>User Aktif</span>
                        <strong><?= (int) ($totalAktif ?? 0) ?></strong>
                    </div>
                </div>

                <div class="stat-card stat-viewer">
                    <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
                    <div class="stat-content">
                        <span>User Nonaktif</span>
                        <strong><?= (int) ($totalNonaktif ?? 0) ?></strong>
                    </div>
                </div>
            </div>

            <!-- SEARCH & FILTER TOOLBAR -->
            <div class="user-toolbar">
                <form action="<?= base_url('admin/manajemen-user') ?>" method="get" class="user-search-form">
                    <div class="search-input-wrapper">
                        <i class="bi bi-search search-icon"></i>
                        <input
                            type="text"
                            name="search"
                            value="<?= esc($search ?? '') ?>"
                            placeholder="Cari nama, username, atau email..."
                            autocomplete="off"
                        >
                        <?php if (!empty($search)) : ?>
                            <a href="<?= base_url('admin/manajemen-user') ?>" class="btn-clear-search" title="Reset pencarian">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="filter-dropdown-wrapper">
                        <select name="status" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="1" <?= ($status === '1') ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= ($status === '0') ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                        <i class="bi bi-chevron-down select-chevron"></i>
                    </div>

                    <button type="submit" class="btn-search">Cari</button>
                </form>
            </div>

            <!-- TABEL USER -->
            <div class="user-table-wrapper">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terakhir Diperbarui</th>
                            <th class="text-center" width="130">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php
                            $no = $startNumber;
                            $currentUserId = (int) (session()->get('user_id') ?? 0);
                        ?>
                        <?php foreach ($users as $user) : ?>
                            <?php
                                $roleUser = strtolower($user['role'] ?? 'admin');
                                $active   = isset($user['active']) ? (int) $user['active'] : 1;
                                $isSelf   = ((int) $user['id'] === $currentUserId);
                                $isSuper  = ($roleUser === 'superadmin');
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td>
                                    <div class="user-profile">
                                        <div class="user-table-avatar">
                                            <i class="bi <?= $isSuper ? 'bi-shield-shaded' : 'bi-person-fill' ?>"></i>
                                        </div>
                                        <span><?= esc($user['username']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?= !empty($user['email']) ? esc($user['email']) : '<span class="text-muted">-</span>' ?>
                                </td>
                                <td>
                                    <span class="role-badge role-admin">Admin</span>
                                </td>
                                <td>
                                    <?php if ($active === 1) : ?>
                                        <span class="status-badge status-active">
                                            <span class="status-dot"></span> Aktif
                                        </span>
                                    <?php else : ?>
                                        <span class="status-badge status-inactive">
                                            <span class="status-dot"></span> Tidak Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        if (!empty($user['updated_at'])) {
                                            echo date('d M Y H:i', strtotime($user['updated_at']));
                                        } elseif (!empty($user['created_at'])) {
                                            echo date('d M Y H:i', strtotime($user['created_at']));
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <?php if ($isSuper) : ?>
                                            <span class="btn-action btn-disabled" title="Akun Superadmin Terkunci">
                                                <i class="bi bi-lock-fill"></i>
                                            </span>
                                        <?php else : ?>
                                            <!-- Tombol Edit Maroon -->
                                            <a href="<?= base_url('admin/manajemen-user/edit/' . $user['id']) ?>" class="btn-action btn-edit" title="Edit User">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            <!-- Tombol Menu Titik Tiga (Aksi Toggle Dropdown) -->
                                            <div class="dropdown d-inline-block">
                                                <button
                                                    type="button"
                                                    class="btn-action btn-more dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown"
                                                    data-bs-display="static"
                                                    aria-expanded="false"
                                                    title="Pilihan Aksi"
                                                >
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end action-dropdown-menu shadow-sm">
                                                    <!-- Menu Edit -->
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('admin/manajemen-user/edit/' . $user['id']) ?>">
                                                            <i class="bi bi-pencil-square text-primary"></i> Edit
                                                        </a>
                                                    </li>

                                                    <!-- Menu Toggle Status Aktif/Nonaktif -->
                                                    <?php if (!$isSelf) : ?>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('admin/manajemen-user/toggle/' . $user['id']) ?>">
                                                                <?php if ($active === 1) : ?>
                                                                    <i class="bi bi-toggle-on text-warning"></i> Nonaktifkan
                                                                <?php else : ?>
                                                                    <i class="bi bi-toggle-off text-success"></i> Aktifkan
                                                                <?php endif; ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <!-- Menu Hapus -->
                                                    <?php if (!$isSelf) : ?>
                                                        <li><hr class="dropdown-divider my-1"></li>
                                                        <li>
                                                            <a
                                                                class="dropdown-item text-danger"
                                                                href="<?= base_url('admin/manajemen-user/delete/' . $user['id']) ?>"
                                                                onclick="return confirmDelete('<?= esc($user['username'], 'js') ?>', this.href, event);"
                                                            >
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                Tidak ada data user yang ditemukan
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- FOOTER & PAGINASI -->
            <div class="table-footer">
                <div class="table-info">
                    <?php if ($totalRows > 0) : ?>
                        Menampilkan <?= $startNumber ?> - <?= $endNumber ?> dari <?= $totalRows ?> data
                    <?php else : ?>
                        Menampilkan 0 data
                    <?php endif; ?>
                </div>

                <?php if (!empty($pager)) : ?>
                    <?php
                        $currentPage = (int) ($pager->getCurrentPage() ?? 1);
                        $pageCount   = (int) ($pager->getPageCount() ?? 1);
                        $queryString = [];
                        if (!empty($search)) {
                            $queryString['search'] = $search;
                        }
                        if ($status !== null && $status !== '') {
                            $queryString['status'] = $status;
                        }
                        $makeUrl = function ($page) use ($queryString) {
                            $params = array_merge($queryString, ['page' => $page]);
                            return base_url('admin/manajemen-user') . '?' . http_build_query($params);
                        };
                    ?>
                    <?php if ($pageCount > 1) : ?>
                        <div class="pagination-wrapper">
                            <!-- Prev -->
                            <?php if ($currentPage > 1) : ?>
                                <a href="<?= $makeUrl($currentPage - 1) ?>" class="page-btn" title="Sebelumnya">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            <?php else : ?>
                                <span class="page-btn disabled"><i class="bi bi-chevron-left"></i></span>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <?php for ($p = 1; $p <= $pageCount; $p++) : ?>
                                <?php if ($p === $currentPage) : ?>
                                    <span class="page-btn active"><?= $p ?></span>
                                <?php else : ?>
                                    <a href="<?= $makeUrl($p) ?>" class="page-btn"><?= $p ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <!-- Next -->
                            <?php if ($currentPage < $pageCount) : ?>
                                <a href="<?= $makeUrl($currentPage + 1) ?>" class="page-btn" title="Berikutnya">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            <?php else : ?>
                                <span class="page-btn disabled"><i class="bi bi-chevron-right"></i></span>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="pagination-wrapper">
                            <span class="page-btn disabled"><i class="bi bi-chevron-left"></i></span>
                            <span class="page-btn active">1</span>
                            <span class="page-btn disabled"><i class="bi bi-chevron-right"></i></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>

    </main>

</div>

<!-- SCRIPT RESPONSIVE SIDEBAR & KONFIRMASI HAPUS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnSidebarToggle = document.getElementById('btnSidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (btnSidebarToggle && sidebar && sidebarOverlay) {
        btnSidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }
});

function confirmDelete(username, deleteUrl, event) {
    if (event) {
        event.preventDefault();
    }

    const confirmed = confirm('Apakah Anda yakin ingin menghapus user "' + username + '"?\nTindakan ini tidak dapat dibatalkan.');
    if (confirmed) {
        window.location.href = deleteUrl;
    }
    return false;
}
</script>

<?= $this->include('Admin/layout/footer') ?>