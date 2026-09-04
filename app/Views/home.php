<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">


<!-- =====================================
     HERO
===================================== -->

<section class="hero-home">

    <div class="hero-overlay"></div>


    <!-- ==========================================
         JUDUL HERO
    =========================================== -->

    <div class="hero-content">

        <h1>
            DINAS SOSIAL DAN PEMBERDAYAAN<br>
            PEREMPUAN DAN KB
        </h1>

        <p>
            KABUPATEN BANYUWANGI
        </p>

    </div>


    <!-- ==========================================
         AKSES CEPAT
    =========================================== -->

    <div class="akses-cepat">

        <div class="akses-header">
            <span>Akses Cepat</span>
        </div>


        <div class="akses-menu">

            <!-- LAYANAN KAMI -->
            <a href="<?= base_url('layanan') ?>" class="akses-item">

                <div class="akses-icon icon-pink">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div class="akses-name">
                    Layanan Kami
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Layanan Dinas
                </div>

            </a>


            <!-- BERITA -->
            <a href="<?= base_url('berita') ?>" class="akses-item">

                <div class="akses-icon icon-purple">
                    <i class="bi bi-newspaper"></i>
                </div>

                <div class="akses-name">
                    Berita
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Berita terbaru
                </div>

            </a>


            <!-- KEGIATAN -->
            <a href="<?= base_url('kegiatan') ?>" class="akses-item">

                <div class="akses-icon icon-orange">
                    <i class="bi bi-images"></i>
                </div>

                <div class="akses-name">
                    Kegiatan
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Kegiatan Dinas
                </div>

            </a>


            <!-- PENGADUAN -->
            <a href="<?= base_url('pengaduan') ?>" class="akses-item">

                <div class="akses-icon icon-green">
                    <i class="bi bi-telephone"></i>
                </div>

                <div class="akses-name">
                    Pengaduan
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Sampaikan pengaduan
                </div>

            </a>


            <!-- DOKUMEN -->
            <a href="<?= base_url('dokumen') ?>" class="akses-item">

                <div class="akses-icon icon-yellow">
                    <i class="bi bi-folder"></i>
                </div>

                <div class="akses-name">
                    Dokumen publik
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Dokumen resmi
                </div>

            </a>


            <!-- STATISTIK -->
            <a href="<?= base_url('statistik') ?>" class="akses-item">

                <div class="akses-icon icon-blue">
                    <i class="bi bi-graph-up"></i>
                </div>

                <div class="akses-name">
                    Dashboard Statistik
                </div>

                <div class="akses-line"></div>

                <div class="akses-description">
                    Data statistik
                </div>

            </a>

        </div>

    </div>

</section>


<!-- =====================================
     PROFIL
===================================== -->
<!-- =====================================
     PROFIL + BIDANG
===================================== -->

<section class="profil-home">

    <div class="profil-home-container">


        <!-- =========================================
             KEPALA DINAS
        ========================================== -->

        <div class="profil-kepala">

            <?php if (!empty($anggota[0])): ?>

                <?php $utama = $anggota[0]; ?>

                <!-- FOTO -->

                <div class="profil-logo">

                    <?php if (!empty($utama['foto'])): ?>

                        <img
                            src="<?= base_url(
                                'uploads/profil/' . $utama['foto']
                            ) ?>"
                            alt="<?= esc($utama['nama']) ?>"
                        >

                    <?php endif; ?>

                </div>


                <!-- NAMA -->

                <h2>
                    <?= esc($utama['nama']) ?>
                </h2>


                <!-- JABATAN -->

                <p class="profil-jabatan">

                    <span>
                        KEPALA DINAS SOSIAL DAN PEMBERDAYAAN PEREMPUAN
                    </span>

                    <span>
                        KABUPATEN BANYUWANGI
                    </span>

                </p>

            <?php endif; ?>

        </div>


        <!-- =========================================
             BIDANG
             DI SEBELAH KANAN KEPALA DINAS
        ========================================== -->

        <div class="bidang-section">

            <div class="bidang-wrapper">

                <?php if (!empty($bidang)): ?>

                    <?php foreach ($bidang as $item): ?>

                        <?php

                        $namaBidang = strtolower(
                            trim($item['nama_bidang'])
                        );


                        if ($namaBidang === 'sekretariat') {

                            $slug = 'sekretariat';

                        } elseif (
                            strpos($namaBidang, 'linjamsos') !== false
                        ) {

                            $slug = 'linjamsos';

                        } elseif (
                            strpos($namaBidang, 'rehabsos') !== false
                        ) {

                            $slug = 'rehabsos';

                        } elseif (
                            strpos($namaBidang, 'dayasos') !== false
                        ) {

                            $slug = 'dayasos';

                        } elseif (
                            strpos($namaBidang, 'ppdkb') !== false
                        ) {

                            $slug = 'ppdkb';

                        } else {

                            $slug = url_title(
                                $item['nama_bidang'],
                                '-',
                                true
                            );

                        }

                        ?>


                        <!-- CARD BIDANG -->

                        <div class="bidang-card">


                            <!-- ICON -->

                            <div class="bidang-icon">

                                <i class="bi bi-people-fill"></i>

                            </div>


                            <!-- NAMA -->

                            <h3>
                                <?= esc(
                                    $item['nama_bidang']
                                ) ?>
                            </h3>


                            <!-- DESKRIPSI -->

                            <p>
                                Informasi
                                <?= esc(
                                    $item['nama_bidang']
                                ) ?>
                            </p>


                            <!-- DETAIL -->

                            <a
                                href="<?= base_url(
                                    'bidang/' . $slug
                                ) ?>"
                                class="btn-detail"
                            >
                                Detail →
                            </a>

                        </div>


                    <?php endforeach; ?>


                <?php else: ?>

                    <p>
                        Belum ada data bidang.
                    </p>

                <?php endif; ?>

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
                <strong>
                    Senin - Jumat, 07.30 - 16.00
                </strong>
            </p>

        </div>


        <!-- CARD LAYANAN -->

        <div class="layanan-wrapper">

    <?php if (!empty($layanan)): ?>

        <?php foreach ($layanan as $item): ?>

            <div class="layanan-card">

                <div class="layanan-icon">

                    <?php if (!empty($item['gambar'])): ?>

                        <img
                            src="<?= base_url('uploads/layanan/' . $item['gambar']) ?>"
                            alt="<?= esc($item['nama_layanan']) ?>"
                        >

                    <?php else: ?>

                        <i class="bi bi-pencil-square"></i>

                    <?php endif; ?>

                </div>


                <h3>
                    <?= esc($item['nama_layanan']) ?>
                </h3>


                <p>
                    <?php
                    $deskripsi = strip_tags($item['deskripsi_layanan'] ?? '');

                    echo esc(
                        strlen($deskripsi) > 80
                            ? substr($deskripsi, 0, 80) . '...'
                            : $deskripsi
                    );
                    ?>
                </p>


                <a
                    href="<?= base_url('layanan/detail/' . $item['id']) ?>"
                    class="btn-layanan-detail"
                >
                    Detail →
                </a>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>


        <!-- SEMUA LAYANAN -->

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


            <!-- JUDUL -->

            <div class="informasi-title">

                <h2>
                    BERITA TERBARU
                </h2>

                <span></span>

            </div>


            <!-- LIST BERITA -->

            <div class="berita-list">

                <?php if (!empty($berita)): ?>


                    <?php foreach (
                        array_slice(
                            $berita,
                            0,
                            3
                        ) as $item
                    ): ?>


                        <div class="berita-item">


                            <!-- GAMBAR -->

                            <div class="berita-image">

                                <img
                                    src="<?= base_url(
                                        'uploads/berita/' .
                                        $item['gambar']
                                    ) ?>"
                                    alt="<?= esc(
                                        $item['judul']
                                    ) ?>"
                                >

                            </div>


                            <!-- KONTEN -->

                            <div class="berita-content">


                                <div class="berita-date">

                                    <?= date(
                                        'd F Y',
                                        strtotime(
                                            $item['tanggal']
                                        )
                                    ) ?>

                                </div>


                                <h3>

                                    <?= esc(
                                        $item['judul']
                                    ) ?>

                                </h3>


                                <p>

                                    <?= esc(
                                        substr(
                                            strip_tags(
                                                $item['isi']
                                            ),
                                            0,
                                            100
                                        )
                                    ) ?>.....

                                </p>


                                <a
                                    href="<?= base_url(
                                        'berita/' .
                                        $item['slug']
                                    ) ?>"
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


            <!-- TOMBOL -->

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


                <!-- JUDUL -->

                <div class="informasi-title">

                    <h2>
                        KEGIATAN
                    </h2>

                    <span></span>

                </div>


                <!-- GRID -->

                <div class="kegiatan-grid">

                    <?php if (!empty($tahunKegiatan)): ?>

                        <div class="kegiatan-tahun-home">

                            <?php foreach (array_slice($tahunKegiatan, 0, 4) as $item): ?>

                                <a
                                    href="<?= base_url(
                                        'kegiatan/tahun/' .
                                        $item['tahun']
                                    ) ?>"
                                    class="kegiatan-tahun-card-home"
                                >

                                    <?php if (!empty($item['thumbnail'])): ?>

                                        <img
                                            src="<?= base_url(
                                                'uploads/kegiatan/thumbnail/' .
                                                $item['thumbnail']
                                            ) ?>"
                                            alt="Kegiatan Tahun <?= esc(
                                                $item['tahun']
                                            ) ?>"
                                        >

                                    <?php else: ?>

                                        <div class="kegiatan-tahun-no-image">
                                            <i class="bi bi-calendar-event"></i>
                                        </div>

                                    <?php endif; ?>

                                    <div class="kegiatan-tahun-overlay"></div>

                                    <div class="kegiatan-tahun-text">

                                        <?= esc($item['tahun']) ?>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="informasi-empty">

                            Belum ada kegiatan.

                        </div>

                    <?php endif; ?>

                </div>


                <!-- =================================================
                    LIHAT SEMUA
                ================================================== -->


                <!-- TOMBOL -->

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


                <!-- JUDUL -->

                <div class="informasi-title">

                    <h2>
                        Postingan Terbaru
                    </h2>

                    <span></span>

                </div>


                <!-- GRID -->

                <div class="postingan-grid">


                    <?php if (!empty($instagram)): ?>


                        <?php foreach (
                            array_slice(
                                $instagram,
                                0,
                                2
                            ) as $post
                        ): ?>


                            <a
                                href="<?= esc(
                                    $post['permalink']
                                ) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="postingan-item"
                            >


                                <img
                                    src="<?= esc(
                                        !empty(
                                            $post[
                                                'thumbnail_url'
                                            ]
                                        )
                                            ? $post[
                                                'thumbnail_url'
                                            ]
                                            : $post[
                                                'media_url'
                                            ]
                                    ) ?>"
                                    alt="Postingan Instagram"
                                >


                            </a>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- DEFAULT POST 1 -->

                        <div class="postingan-item">

                            <img
                                src="<?= base_url(
                                    'assets/images/postingan.jpg'
                                ) ?>"
                                alt="Postingan Instagram"
                            >

                        </div>


                        <!-- DEFAULT POST 2 -->

                        <div class="postingan-item">

                            <img
                                src="<?= base_url(
                                    'assets/images/postingan.jpg'
                                ) ?>"
                                alt="Postingan Instagram"
                            >

                        </div>


                    <?php endif; ?>


                </div>


                <!-- TOMBOL -->

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