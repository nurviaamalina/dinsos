<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register Admin - Dinas Sosial</title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/auth.css') ?>"
    >

</head>

<body>

<div class="auth-wrapper">

    <div class="auth-card register-card">

        <!-- LOGO -->

        <img
            src="<?= base_url('assets/img/logo.png') ?>"
            alt="Logo Dinas Sosial"
            class="auth-logo"
        >


        <!-- TITLE -->

        <h1 class="auth-title">
            Portal Admin Dinsos
        </h1>

        <div class="auth-subtitle">
            Kabupaten Banyuwangi
        </div>


        <!-- ERROR -->

        <?php if (session()->getFlashdata('error')) : ?>

            <div class="auth-alert auth-alert-error">

                <?= esc(session()->getFlashdata('error')) ?>

            </div>

        <?php endif; ?>


        <!-- REGISTER FORM -->

        <form
            action="<?= base_url('register') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <!-- USERNAME -->

            <div class="auth-form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="admin.dinsos"
                    value="<?= old('username') ?>"
                    autocomplete="username"
                    required
                >

            </div>


            <!-- EMAIL -->

            <div class="auth-form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Dinsos@gmail.com"
                    value="<?= old('email') ?>"
                    autocomplete="email"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="auth-form-group">

                <label for="password">
                    Kata Sandi
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Kata sandi"
                    autocomplete="new-password"
                    required
                >

            </div>


            <!-- CONFIRM PASSWORD -->

            <div class="auth-form-group">

                <label for="confirm_password">
                    Confirm Kata Sandi
                </label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Konfirmasi kata sandi"
                    autocomplete="new-password"
                    required
                >

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="auth-button"
            >
                Daftar
            </button>

        </form>


        <!-- ACCESS INFO -->

        <div class="auth-access">

            Akses khusus pegawai Dinas Sosial Kab. Banyuwangi

            <br>

            Sudah punya akun?

            <a href="<?= base_url('login') ?>">
                Login
            </a>

        </div>

    </div>

</div>

</body>

</html>