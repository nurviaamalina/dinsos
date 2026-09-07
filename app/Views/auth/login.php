<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin - Dinas Sosial</title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/auth.css') ?>"
    >

</head>

<body>

<div class="auth-wrapper">

    <div class="auth-card">

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


        <!-- SUCCESS -->

        <?php if (session()->getFlashdata('success')) : ?>

            <div class="auth-alert auth-alert-success">

                <?= esc(session()->getFlashdata('success')) ?>

            </div>

        <?php endif; ?>


        <!-- LOGIN FORM -->

        <form
            action="<?= base_url('login') ?>"
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
                    autocomplete="current-password"
                    required
                >

            </div>


            <!-- OPTIONS -->

            <div class="login-options">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                    >

                    <span>
                        Ingat saya
                    </span>

                </label>


                <a
                    href="#"
                    class="forgot-password"
                >
                    Lupa kata sandi?
                </a>

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="auth-button"
            >
                Masuk ke Dashboard
            </button>

        </form>

<!-- REGISTER -->

<div class="auth-register">

    Belum punya akun?

    <a href="<?= base_url('register') ?>">
        Daftar sekarang
    </a>

</div>


<!-- ACCESS -->

<div class="auth-access">

    Akses khusus pegawai Dinas Sosial Kab. Banyuwangi

</div>

</div>

</body>

</html>