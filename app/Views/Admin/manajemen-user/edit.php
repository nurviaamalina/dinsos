<?= $this->include('Admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/manajemen.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/editusertambah.css') ?>">

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
                    <h2>Edit Akun User</h2>
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
             FORM CARD
        ====================================================== -->
        <div class="user-container">

            <!-- HEADER -->
            <div class="user-header">
                <div class="user-title-wrapper">
                    <div class="user-title-icon">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <div>
                        <h1>Edit User</h1>
                        <p>Perbarui informasi akun admin Dinas Sosial</p>
                    </div>
                </div>

                <a href="<?= base_url('admin/manajemen-user') ?>" class="form-header-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <!-- ERROR ALERT -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="user-alert user-alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
            <?php endif; ?>

            <!-- FORM EDIT USER -->
            <div class="user-form-card">
                <form action="<?= base_url('admin/manajemen-user/update/' . $user['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-grid-2">
                        <!-- USERNAME -->
                        <div class="form-group">
                            <label for="username">
                                Username <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="<?= esc(old('username', $user['username'] ?? '')) ?>"
                                placeholder="Masukkan username"
                                autocomplete="off"
                                required
                            >
                            <small>Username digunakan untuk login ke sistem.</small>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            <label for="email">
                                Email <span class="required">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= esc(old('email', $user['email'] ?? '')) ?>"
                                placeholder="Masukkan alamat email"
                                autocomplete="email"
                                required
                            >
                            <small>Email harus berbeda dari akun lainnya.</small>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <!-- PASSWORD BARU -->
                        <div class="form-group">
                            <label for="password">
                                Password Baru
                            </label>
                            <div class="password-wrapper">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah password"
                                    autocomplete="new-password"
                                >
                                <button
                                    type="button"
                                    class="password-toggle-btn"
                                    onclick="togglePasswordVisibility('password', this)"
                                    title="Tampilkan / Sembunyikan password"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small>Kosongkan bila Anda tidak bermaksud mengganti password.</small>
                        </div>

                        <!-- ROLE (ADMIN) -->
                        <div class="form-group">
                            <label for="role">
                                Role
                            </label>
                            <select id="role" name="role" disabled>
                                <option value="admin" selected>Admin</option>
                            </select>
                            <input type="hidden" name="role" value="admin">
                            <small>Role akun ini adalah Admin dan tidak dapat diubah.</small>
                        </div>
                    </div>

                    <!-- STATUS -->
                    <div class="form-group">
                        <label>Status Akun</label>
                        <div class="status-options-wrapper">
                            <!-- AKTIF -->
                            <label class="status-option-item">
                                <input
                                    type="radio"
                                    name="active"
                                    value="1"
                                    <?= (string) old('active', $user['active'] ?? 1) === '1' ? 'checked' : '' ?>
                                >
                                <span class="status-option-pill">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Aktif
                                </span>
                            </label>

                            <!-- TIDAK AKTIF -->
                            <label class="status-option-item">
                                <input
                                    type="radio"
                                    name="active"
                                    value="0"
                                    <?= (string) old('active', $user['active'] ?? 1) === '0' ? 'checked' : '' ?>
                                >
                                <span class="status-option-pill">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Tidak Aktif
                                </span>
                            </label>
                        </div>
                        <small>Akun yang nonaktif tidak dapat melakukan login ke dalam sistem.</small>
                    </div>

                    <!-- FORM ACTIONS -->
                    <div class="form-actions-bar">
                        <a href="<?= base_url('admin/manajemen-user') ?>" class="btn-form-cancel">
                            <i class="bi bi-x-lg"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-form-save">
                            <i class="bi bi-save-fill"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </main>

</div>

<script>
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

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
</script>

<?= $this->include('Admin/layout/footer') ?>