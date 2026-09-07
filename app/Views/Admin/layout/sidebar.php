<?php

$currentUrl = uri_string();

?>


<aside class="sidebar">


    <!-- =====================================================
         LOGO
    ====================================================== -->

    <div class="sidebar-logo">

        <img
            src="<?= base_url('assets/images/logo-dinsos.png') ?>"
            alt="Logo Dinsos"
        >

        <div>

            <strong>
                DINSOS PPKB
            </strong>

            <span>
                BANYUWANGI
            </span>

        </div>

    </div>


    <!-- =====================================================
         MENU
    ====================================================== -->

    <nav class="sidebar-menu">


        <!-- =================================================
             DASHBOARD UTAMA
        ================================================== -->

        <a
            href="<?= base_url('admin/dashboard') ?>"
            class="sidebar-item <?= $currentUrl === 'admin/dashboard' ? 'active' : '' ?>"
        >

            <i class="bi bi-grid"></i>

            <span>
                Dashboard
            </span>

        </a>


        <!-- =================================================
             DATA & INPUT
        ================================================== -->

        <div class="sidebar-title">
            DATA &amp; INPUT
        </div>


        <!-- =================================================
             PROFIL
        ================================================== -->

        <a
            href="<?= base_url('admin/profil') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/profil') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-person"></i>

            <span>
                Profil
            </span>

        </a>


        <!-- =================================================
             LAYANAN
        ================================================== -->

        <a
            href="<?= base_url('admin/layanan') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/layanan') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-three-dots"></i>

            <span>
                Layanan
            </span>


        </a>


        <!-- =================================================
             BERITA
        ================================================== -->

        <a
            href="<?= base_url('admin/berita') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/berita') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-newspaper"></i>

            <span>
                Berita
            </span>

        </a>


        <!-- =================================================
             KEGIATAN
        ================================================== -->

        <a
            href="<?= base_url('admin/kegiatan') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/kegiatan') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-calendar-event"></i>

            <span>
                Kegiatan
            </span>

        </a>


        <!-- =================================================
             INSTAGRAM
        ================================================== -->

        <a
            href="<?= base_url('admin/instagram') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/instagram') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-instagram"></i>

            <span>
                Instagram
            </span>

        </a>


        <!-- =================================================
             DOKUMEN
        ================================================== -->

        <a
            href="<?= base_url('admin/dokumen') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/dokumen') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-folder"></i>

            <span>
                Dokumen
            </span>

        </a>


        <!-- =================================================
             STATISTIK
        ================================================== -->

        <div class="sidebar-title">
            Statistik
        </div>


        <!-- =================================================
             DASHBOARD STATISTIK
        ================================================== -->

        <a
            href="<?= base_url('admin/statistik') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/statistik') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-grid"></i>

            <span>
                Dashboard
            </span>

        </a>


        <!-- =================================================
     DATA UTAMA DROPDOWN
================================================== -->

<div class="sidebar-dropdown">

    <div
        class="sidebar-item sidebar-dropdown-toggle
        <?= (
            strpos($currentUrl, 'admin/bidang') === 0 ||
            strpos($currentUrl, 'admin/kecamatan') === 0
        ) ? 'active' : '' ?>"
    >

        <i class="bi bi-star"></i>

        <span>
            Data Utama
        </span>

        <i class="bi bi-chevron-down sidebar-dropdown-icon"></i>

    </div>


    <!-- SUB MENU -->

    <div class="sidebar-dropdown-menu">

        <!-- BIDANG -->

        <a
            href="<?= base_url('admin/bidang') ?>"
            class="sidebar-dropdown-item
            <?= strpos($currentUrl, 'admin/bidang') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-briefcase"></i>

            <span>
                Bidang
            </span>

        </a>


        <!-- KECAMATAN -->

        <a
            href="<?= base_url('admin/kecamatan') ?>"
            class="sidebar-dropdown-item
            <?= strpos($currentUrl, 'admin/kecamatan') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-geo-alt"></i>

            <span>
                Kecamatan
            </span>

        </a>

    </div>

</div>


        <!-- =================================================
            DATA PELAYANAN
        ================================================== -->

        <a
            href="<?= base_url('admin/datalayanan') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/datalayanan') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-bullseye"></i>

            <span>
                Data Pelayanan
            </span>

        </a>


        <!-- =================================================
             PENERIMA MANFAAT
        ================================================== -->

        <a
            href="<?= base_url('admin/penerima-manfaat') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/penerima-manfaat') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-people"></i>

            <span>
                Penerima Manfaat
            </span>

        </a>


        <!-- =================================================
             HASIL SKM
        ================================================== -->

        <a
            href="<?= base_url('admin/hasil-skm') ?>"
            class="sidebar-item <?= strpos($currentUrl, 'admin/hasil-skm') === 0 ? 'active' : '' ?>"
        >

            <i class="bi bi-bar-chart"></i>

            <span>
                Hasil SKM
            </span>

        </a>


    </nav>


    <!-- =====================================================
         LOGOUT
    ====================================================== -->

    <div class="sidebar-logout">

        <a href="<?= site_url('logout') ?>" class="sidebar-menu logout">

            <i class="bi bi-box-arrow-left"></i>

            Keluar

        </a>

    </div>


</aside>