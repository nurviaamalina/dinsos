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

<!-- =====================================
     BERITA, KEGIATAN & POSTINGAN
===================================== -->

<section class="informasi-section">

    <div class="informasi-container">

        <!-- =================================
             BERITA TERBARU
        ================================== -->

        <div class="informasi-box berita-box">

            <div class="informasi-title">
                <h2>BERITA TERBARU</h2>
                <span></span>
            </div>

            <div class="berita-list">

                <?php if (!empty($berita)): ?>

                    <?php foreach (array_slice($berita, 0, 3) as $item): ?>

                        <div class="berita-item">

                            <div class="berita-image">

                                <img
                                    src="<?= base_url('uploads/berita/' . $item['gambar']) ?>"
                                    alt="<?= esc($item['judul']) ?>"
                                >

                            </div>

                            <div class="berita-content">

                                <div class="berita-date">
                                    <?= date('d F Y', strtotime($item['tanggal'])) ?>
                                </div>

                                <h3>
                                    <?= esc($item['judul']) ?>
                                </h3>

                                <p>
                                    <?= esc(substr(strip_tags($item['isi']), 0, 100)) ?>.....
                                </p>

                               <a
                                    href="<?= base_url('berita/' . $item['slug']) ?>"
                                    class="btn-berita"
                                >
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="informasi-empty">
                        Belum ada berita.
                    </div>

                <?php endif; ?>

            </div>

            <div class="informasi-button">

                <a
                    href="<?= base_url('berita') ?>"
                    class="btn-informasi"
                >
                    Lihat Semua
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        <!-- =================================
             KOLOM KANAN
        ================================== -->

        <div class="informasi-kanan">


            <!-- =================================
                 KEGIATAN
            ================================== -->

            <div class="informasi-box kegiatan-box">

                <div class="informasi-title">
                    <h2>KEGIATAN</h2>
                    <span></span>
                </div>

                <div class="kegiatan-grid">

                    <?php if (!empty($kegiatan)): ?>

                        <?php foreach (array_slice($kegiatan, 0, 4) as $item): ?>

                            <a
                                href="<?= base_url('kegiatan/' . $item['id']) ?>"
                                class="kegiatan-item"
                            >

                                <img
                                    src="<?= base_url('uploads/kegiatan/' . $item['gambar']) ?>"
                                    alt="<?= esc($item['tahun']) ?>"
                                >

                                <div class="kegiatan-tahun">
                                    <?= esc($item['tahun']) ?>
                                </div>

                            </a>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="kegiatan-item">
                            <img
                                src="<?= base_url('assets/images/kegiatan.jpg') ?>"
                                alt="2026"
                            >

                            <div class="kegiatan-tahun">
                                2026
                            </div>
                        </div>

                        <div class="kegiatan-item">
                            <img
                                src="<?= base_url('assets/images/kegiatan.jpg') ?>"
                                alt="2025"
                            >

                            <div class="kegiatan-tahun">
                                2025
                            </div>
                        </div>

                        <div class="kegiatan-item">
                            <img
                                src="<?= base_url('assets/images/kegiatan.jpg') ?>"
                                alt="2024"
                            >

                            <div class="kegiatan-tahun">
                                2024
                            </div>
                        </div>

                        <div class="kegiatan-item">
                            <img
                                src="<?= base_url('assets/images/kegiatan.jpg') ?>"
                                alt="2023"
                            >

                            <div class="kegiatan-tahun">
                                2023
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="informasi-button">

                    <a
                        href="<?= base_url('kegiatan') ?>"
                        class="btn-informasi"
                    >
                        Lihat Semua
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>


            <!-- =================================
                 POSTINGAN TERBARU
            ================================== -->

            <div class="informasi-box postingan-box">

                <div class="informasi-title">
                    <h2>Postingan Terbaru</h2>
                    <span></span>
                </div>

                <div class="postingan-grid">

                    <?php if (!empty($instagram)): ?>

                        <?php foreach (array_slice($instagram, 0, 2) as $post): ?>

                            <a
                                href="<?= esc($post['permalink']) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="postingan-item"
                            >

                                <img
                                    src="<?= esc(
                                        !empty($post['thumbnail_url'])
                                            ? $post['thumbnail_url']
                                            : $post['media_url']
                                    ) ?>"
                                    alt="Postingan Instagram"
                                >

                            </a>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="postingan-item">
                            <img
                                src="<?= base_url('assets/images/postingan.jpg') ?>"
                                alt="Postingan Instagram"
                            >
                        </div>

                        <div class="postingan-item">
                            <img
                                src="<?= base_url('assets/images/postingan.jpg') ?>"
                                alt="Postingan Instagram"
                            >
                        </div>

                    <?php endif; ?>

                </div>

                <div class="informasi-button">

                    <a
                        href="<?= base_url('instagram') ?>"
                        class="btn-informasi"
                    >
                        Lihat Semua
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>