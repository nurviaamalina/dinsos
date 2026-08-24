<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Dinas Sosial dan Pemberdayaan Perempuan dan KB
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Header CSS -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/header.css') ?>"
    >
</head>

<body>

<header class="main-header">

    <div class="header-inner">

        <!-- LOGO -->
        <a href="<?= base_url('/') ?>" class="brand">

            <img
                src="<?= base_url('assets/images/logo-dinsos.png') ?>"
                alt="Dinas Sosial Banyuwangi"
            >

        </a>


        <!-- NAVBAR -->
        <nav class="main-nav">

            <a
                href="<?= base_url('/') ?>"
                class="nav-link"
            >
                Beranda
            </a>


            <!-- PROFIL -->
            <div class="nav-dropdown">

                <a href="#" class="nav-link dropdown-toggle-custom">
                    Profil
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="dropdown-menu-custom">

                    <a href="<?= base_url('profil') ?>">
                        Profil Dinas
                    </a>

                    <a href="<?= base_url('struktur') ?>">
                        Struktur Organisasi
                    </a>

                    <a href="<?= base_url('visi-misi') ?>">
                        Visi & Misi
                    </a>

                </div>

            </div>


            <!-- LAYANAN -->
            <div class="nav-dropdown">

                <a href="#" class="nav-link dropdown-toggle-custom">
                    Layanan
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="dropdown-menu-custom">

                    <a href="<?= base_url('layanan') ?>">
                        Semua Layanan
                    </a>

                    <a href="<?= base_url('pengaduan') ?>">
                        Pengaduan
                    </a>

                </div>

            </div>


            <a
                href="<?= base_url('berita') ?>"
                class="nav-link"
            >
                Berita
            </a>


            <a
                href="<?= base_url('kegiatan') ?>"
                class="nav-link"
            >
                Kegiatan
            </a>


            <a
                href="<?= base_url('dokumen') ?>"
                class="nav-link"
            >
                Dokumen
            </a>

        </nav>


        <!-- BUTTON PENGADUAN -->
        <a
            href="<?= base_url('pengaduan') ?>"
            class="btn-pengaduan"
        >
            Lapor Pengaduan
        </a>


        <!-- MOBILE BUTTON -->
        <button
            class="mobile-toggle"
            type="button"
            onclick="toggleMenu()"
        >
            <i class="bi bi-list"></i>
        </button>

    </div>

</header>