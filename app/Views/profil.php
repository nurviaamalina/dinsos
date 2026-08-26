<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>">


<!-- =====================================================
     HERO
===================================================== -->

<section class="profil-hero">

    <div class="profil-hero-overlay"></div>

    <div class="profil-hero-content">

        <h1>
            DINAS SOSIAL DAN PEMBERDAYAAN<br>
            PEREMPUAN DAN KB
        </h1>

        <p>
            KABUPATEN BANYUWANGI
        </p>

    </div>

</section>


<!-- =====================================================
     TENTANG KAMI
===================================================== -->

<section class="tentang-kami">

    <div class="tentang-container">

        <div class="tentang-title">

            <h2>
                Tentang Kami
            </h2>

            <span></span>

        </div>

<?php if (!empty($profil['sejarah'])): ?>

<section class="profil-sejarah">

    <div class="profil-sejarah-card">

        <div class="profil-section-title">
            <h2 id="sejarah">Sejarah</h2>
        </div>

        <div class="sejarah-content">
            <?= nl2br(esc($profil['sejarah'])) ?>
        </div>

    </div>

</section>

<?php endif; ?>

<?php if (!empty($profil)): ?>

    <!-- =========================================
         VISI & MISI
    ========================================== -->

    <div id="visi-misi" class="visi-misi">

        <!-- =====================================
             VISI
        ====================================== -->

        <div class="visi-card">

            <h3>
                Visi
            </h3>

            <div class="visi-content">

                <?php
                $visi = $profil['visi'] ?? '';
                ?>

                <?= nl2br(esc($visi)) ?>

            </div>

        </div>


        <!-- =====================================
             MISI
        ====================================== -->

        <div class="misi-card">

            <h3>
                Misi
            </h3>

            <div class="misi-content">

                <?php
                $misi = $profil['misi'] ?? '';
                ?>

                <?= nl2br(esc($misi)) ?>

            </div>

        </div>

    </div>

<?php else: ?>

    <div class="profil-empty">

        <p>
            Data profil belum tersedia.
        </p>

    </div>

<?php endif; ?>

<!-- =====================================================
     STRUKTUR ORGANISASI
===================================================== -->

<section class="struktur-organisasi">

    <div class="struktur-container">

        <h2 id="struktur-organisasi">Struktur Organisasi</h2>

        <div class="struktur-image-wrapper">

           <?php if (!empty($profil['struktur'])): ?>

    <img
        src="<?= base_url('uploads/struktur/' . $profil['struktur']) ?>"
        alt="Struktur Organisasi"
        class="struktur-image"
    >

<?php endif; ?>

        </div>

    </div>

</section>

<!-- =====================================================
     SASARAN STRATEGIS
====================================================== -->

<?php if (!empty($profil['sasaran_strategis'])): ?>

<section class="profil-sasaran">

    <div class="profil-sasaran-container">

        <h2 id="sasaran-strategis">
            Sasaran Strategis
        </h2>


        <div class="sasaran-content">

            <?= nl2br(
                esc($profil['sasaran_strategis'])
            ) ?>

        </div>

    </div>

</section>

<?php endif; ?>

<!-- =====================================================
     MAKLUMAT PELAYANAN
===================================================== -->

<?php if (!empty($profil['maklumat_pelayanan'])): ?>

<section class="profil-maklumat-pelayanan">

    <div class="profil-maklumat-pelayanan-container">

        <h2 id="maklumat-pelayanan">
            Maklumat Pelayanan
        </h2>


        <div class="maklumat-pelayanan-content">

            <?= nl2br(
                esc($profil['maklumat_pelayanan'])
            ) ?>

        </div>

    </div>

</section>

<?php endif; ?>


<?= $this->include('layout/footer') ?>