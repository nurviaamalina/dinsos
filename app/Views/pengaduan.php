<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/pengaduan.css') ?>">

<main class="pengaduan-page">

    <!-- =========================================
         HERO / INTRO
    ========================================== -->
    <section class="pengaduan-hero">

        <div class="pengaduan-card">

            <h1>
                Suara anda, perhatian kami
            </h1>

            <p class="pengaduan-description">
                Sampaikan pengaduan, keluhan, atau aspirasi anda terkait pelayanan
                Dinas Sosial Kabupaten Banyuwangi. Setiap laporan yang masuk akan
                kami tindaklanjuti secara cepat, transparan, dan sesuai prosedur
                yang berlaku.
            </p>

            <a href="<?= base_url('pengaduan/lapor') ?>" class="btn-lapor">
                LAPOR
            </a>

            <p class="pengaduan-note">
                Anda akan diarahkan ke halaman pelaporan resmi untuk melanjutkan proses.
            </p>

        </div>

    </section>


    <!-- =========================================
         KEMBALI
    ========================================== -->
    <div class="pengaduan-back-wrapper">

        <a href="<?= base_url('/') ?>" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>

    </div>

</main>


<!-- =========================================
     FOOTER
========================================== -->

<footer class="site-footer">

    <div class="footer-container">

        <!-- KOLOM 1 -->
        <div class="footer-brand">

            <div class="footer-brand-title">

                <div class="footer-icon">
                    S
                </div>

                <div>
                    <div class="footer-small-title">
                        DINAS SOSIAL
                    </div>

                    <div class="footer-main-title">
                        Kabupaten Banyuwangi
                    </div>
                </div>

            </div>

            <p>
                Melayani warga Banyuwangi menuju kesejahteraan sosial yang merata,
                dari kota hingga pelosok kecamatan.
            </p>

        </div>


        <!-- KOLOM 2 -->
        <div class="footer-menu">

            <h4>Layanan</h4>

            <a href="#">PKH</a>
            <a href="#">BPNT</a>
            <a href="#">Disabilitas</a>
            <a href="#">Lanjut Usia</a>

        </div>


        <!-- KOLOM 3 -->
        <div class="footer-menu">

            <h4>Informasi</h4>

            <a href="#">Profil Dinas</a>
            <a href="#">Struktur Organisasi</a>
            <a href="#">Regulasi &amp; PPID</a>
            <a href="#">Berita</a>

        </div>


        <!-- KOLOM 4 -->
        <div class="footer-menu">

            <h4>Kontak</h4>

            <a href="<?= base_url('pengaduan') ?>">
                Pengaduan Online
            </a>

            <a href="#">
                Cek Status Bantuan
            </a>

            <a href="#">
                Lokasi Kantor
            </a>

        </div>


        <!-- MAP -->
        <div class="footer-map">

            <iframe
                src="https://www.google.com/maps?q=Banyuwangi%2C%20Jawa%20Timur&output=embed"
                loading="lazy"
                allowfullscreen>
            </iframe>

        </div>

    </div>


    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <p>
            © 2026 Dinas Sosial Kabupaten Banyuwangi.
            Seluruh hak dilindungi.
        </p>

        <p>
            Mockup desain — bukan situs resmi
        </p>

    </div>

</footer>