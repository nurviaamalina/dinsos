<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dinas Sosial</title>

    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Login -->
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>

<body>

    <div class="login-page">

        <!-- ==================================================
             BAGIAN KIRI (FOTO GEDUNG, OVERLAY, & BRANDING)
        =================================================== -->
        <div class="login-left">
            <!-- Overlay Gradasi Maroon -->
            <div class="left-overlay"></div>

            <!-- Dekorasi Sudut Kiri Bawah -->
            <div class="left-decoration"></div>

            <!-- Konten Brand Kiri -->
            <div class="left-content">
                <div class="brand">
                    <div class="brand-logo-wrapper">
                        <img src="<?= base_url('assets/images/images.jfif') ?>" alt="Logo Dinas Sosial" class="brand-logo">
                    </div>
                    <div class="brand-text">
                        <h1>DINAS SOSIAL</h1>
                        <p>KABUPATEN BANYUWANGI</p>
                        <p>REPUBLIK INDONESIA</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================================================
             BAGIAN KANAN (KARTU LOGIN)
        =================================================== -->
        <div class="login-right">
            <div class="login-card">

                <!-- LOGO GARUDA PANCASILA -->
                <div class="card-logo-garuda">
                    <img src="<?= base_url('assets/images/garuda.png') ?>" alt="Garuda Pancasila">
                </div>

                <!-- HEADER KARTU -->
                <div class="login-card-header">
                    <h2>Login Dinas Sosial</h2>
                    <p>Masuk ke akun Anda untuk mengakses<br>sistem informasi Dinas Sosial</p>
                </div>

                <!-- FLASH MESSAGE: ERROR -->
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="login-alert alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span><?= esc(session()->getFlashdata('error')) ?></span>
                    </div>
                <?php endif; ?>

                <!-- FLASH MESSAGE: SUCCESS -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="login-alert alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span><?= esc(session()->getFlashdata('success')) ?></span>
                    </div>
                <?php endif; ?>

                <!-- VALIDATION ERRORS -->
                <?php if (isset($validation) && $validation->getErrors()) : ?>
                    <div class="login-alert alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <div>
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- FORM LOGIN -->
                <form action="<?= base_url('login') ?>" method="post" class="login-form" autocomplete="on">
                    <?= csrf_field() ?>

                    <!-- USERNAME -->
                    <div class="login-input-group">
                        <span class="login-input-icon">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            placeholder="Username"
                            value="<?= esc(old('username')) ?>"
                            autocomplete="username"
                            required
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div class="login-input-group">
                        <span class="login-input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            autocomplete="current-password"
                            required
                        >
                        <button
                            type="button"
                            class="password-toggle-btn"
                            id="passwordToggleBtn"
                            aria-label="Tampilkan password"
                            title="Tampilkan password"
                        >
                            <i class="bi bi-eye-slash" id="passwordToggleIcon"></i>
                        </button>
                    </div>

                    <!-- TOMBOL LOGIN -->
                    <button type="submit" class="btn-login-submit">
                        <span>Login</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <!-- FOOTER KARTU -->
                <div class="login-card-footer">
                    <div class="footer-divider">
                        <span class="divider-line"></span>
                        <span class="divider-icon">
                            <i class="bi bi-bank2"></i>
                        </span>
                        <span class="divider-line"></span>
                    </div>

                    <p class="footer-copyright">
                        Dinas Sosial &copy; <?= date('Y') ?>
                    </p>

                    <small class="footer-motto">
                        Melayani dengan Hati, Membangun Negeri
                    </small>
                </div>

            </div>
        </div>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const toggleBtn = document.getElementById('passwordToggleBtn');
        const toggleIcon = document.getElementById('passwordToggleIcon');

        if (password && toggleBtn && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                if (password.type === 'password') {
                    password.type = 'text';
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                    toggleBtn.setAttribute('title', 'Sembunyikan password');
                } else {
                    password.type = 'password';
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                    toggleBtn.setAttribute('title', 'Tampilkan password');
                }
            });
        }
    });
    </script>

</body>

</html>