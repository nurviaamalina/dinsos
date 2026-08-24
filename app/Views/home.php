<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">


<!-- =====================================
     HERO
===================================== -->

<section class="hero-home">

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <h1>
            DINAS SOSIAL DAN PEMBERDAYAAN<br>
            PEREMPUAN DAN KB
        </h1>

        <p>
            KABUPATEN BANYUWANGI
        </p>

    </div>

</section>


<!-- =====================================
     PROFIL
===================================== -->

<section class="profil-section">

    <div class="profil-wrapper">


        <!-- KEPALA DINAS -->

        <div class="kepala-dinas">

            <div class="logo-dinas">

                <img
                    src="<?= base_url('assets/images/logo-banyuwangi.png') ?>"
                    alt="Logo Kabupaten Banyuwangi"
                >

            </div>

            <h3>
                Dea Cipta Ningrum, S.Tr.Kom
            </h3>

            <p>
                Kepala Dinas Sosial Kabupaten Banyuwangi
            </p>

        </div>


        <!-- CARD BIDANG -->

        <div class="bidang-wrapper">


            <!-- SEKRETARIAT -->

            <div class="bidang-card">

                <div class="bidang-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Sekretariat
                </h3>

                <p>
                    Tata Usaha<br>
                    Untuk Mendukung<br>
                    Dinas Sosial
                </p>

                <a href="#" class="btn-detail">
                    Detail →
                </a>

            </div>


            <!-- LINJAMSOS -->

            <div class="bidang-card">

                <div class="bidang-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Bidang<br>
                    Linjamsos
                </h3>

                <p>
                    Perlindungan<br>
                    dan Jaminan<br>
                    Sosial
                </p>

                <a href="#" class="btn-detail">
                    Detail →
                </a>

            </div>


            <!-- REHABSOS -->

            <div class="bidang-card">

                <div class="bidang-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Bidang<br>
                    Rehabsos
                </h3>

                <p>
                    Rehabilitasi<br>
                    Sosial
                </p>

                <a href="#" class="btn-detail">
                    Detail →
                </a>

            </div>


            <!-- DAYASOS -->

            <div class="bidang-card">

                <div class="bidang-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Bidang<br>
                    Dayasos
                </h3>

                <p>
                    Pemberdayaan<br>
                    Sosial
                </p>

                <a href="#" class="btn-detail">
                    Detail →
                </a>

            </div>

        </div>

    </div>

</section>

<!-- =====================================
     JENIS LAYANAN
===================================== -->

<section class="layanan-section">

    <div class="layanan-container">

        <!-- JUDUL -->

        <div class="layanan-header">

            <h2>
                Jenis Layanan Kami
            </h2>

            <div class="layanan-line"></div>

            <p>
                Jam pelayanan :
                <strong>Senin - Jumat, 07.30 - 16.00</strong>
            </p>

        </div>


        <!-- CARD LAYANAN -->

        <div class="layanan-wrapper">


            <!-- CARD 1 -->

            <div class="layanan-card">

                <div class="layanan-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Nama<br>
                    Layanan
                </h3>

                <p>
                    Deskripsi<br>
                    layanan<br>
                    singkat
                </p>

                <a href="#" class="btn-layanan-detail">
                    Detail →
                </a>

            </div>


            <!-- CARD 2 -->

            <div class="layanan-card">

                <div class="layanan-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Nama<br>
                    Layanan
                </h3>

                <p>
                    Deskripsi<br>
                    layanan<br>
                    singkat
                </p>

                <a href="#" class="btn-layanan-detail">
                    Detail →
                </a>

            </div>


            <!-- CARD 3 -->

            <div class="layanan-card">

                <div class="layanan-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Nama<br>
                    Layanan
                </h3>

                <p>
                    Deskripsi<br>
                    layanan<br>
                    singkat
                </p>

                <a href="#" class="btn-layanan-detail">
                    Detail →
                </a>

            </div>


            <!-- CARD 4 -->

            <div class="layanan-card">

                <div class="layanan-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h3>
                    Nama<br>
                    Layanan
                </h3>

                <p>
                    Deskripsi<br>
                    layanan<br>
                    singkat
                </p>

                <a href="#" class="btn-layanan-detail">
                    Detail →
                </a>

            </div>

        </div>


        <!-- TOMBOL SEMUA LAYANAN -->

        <div class="semua-layanan">

            <a
                href="<?= base_url('layanan') ?>"
                class="btn-semua-layanan"
            >
                Lihat Semua Layanan
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>

</section>


<?= $this->include('layout/footer') ?>