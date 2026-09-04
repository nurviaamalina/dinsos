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

            <a href="https://www.lapor.go.id/" class="btn-lapor">
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
<?= $this->include('layout/footer') ?>
