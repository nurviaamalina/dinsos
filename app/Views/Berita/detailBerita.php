<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="detail-berita-page">

    <div class="container">

        <!-- BREADCRUMB -->
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('berita') ?>">
                        Berita
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Detail Berita
                </li>

            </ol>

        </nav>


        <?php if (!empty($berita)): ?>

            <!-- =========================
                 HEADER DETAIL
            ========================== -->

            <div class="detail-header">

                <!-- GAMBAR -->

                <div class="detail-image">

                    <img
                        src="<?= base_url('uploads/berita/' . $berita['gambar']) ?>"
                        alt="<?= esc($berita['judul']) ?>">

                </div>


                <!-- INFORMASI -->

                <div class="detail-info">

                    <h1>
                        <?= esc($berita['judul']) ?>
                    </h1>


                    <div class="detail-meta">

                        <span>
                            <i class="bi bi-calendar3"></i>

                            <?= date(
                                'l, d F Y',
                                strtotime($berita['tanggal'])
                            ) ?>

                        </span>


                        <span>
                            <i class="bi bi-newspaper"></i>

                            Dinas Sosial
                        </span>


                        <span>
                            <i class="bi bi-eye"></i>

                            <?= isset($berita['views'])
                                ? esc($berita['views'])
                                : '0'
                            ?>
                            kali dibaca

                        </span>

                    </div>

                </div>

            </div>


            <!-- =========================
                 ISI BERITA
            ========================== -->

            <div class="detail-content">

                <?= $berita['isi'] ?>

            </div>


            <!-- =========================
                 SOCIAL MEDIA
            ========================== -->

            <div class="detail-social">

                <a href="#" class="social-facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#" class="social-whatsapp">
                    <i class="bi bi-whatsapp"></i>
                </a>

                <a href="#" class="social-instagram">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#" class="social-share">
                    <i class="bi bi-share-fill"></i>
                </a>

            </div>


            <!-- =========================
                 KEMBALI
            ========================== -->

            <a
                href="<?= base_url('berita') ?>"
                class="btn-kembali-detail">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>


        <?php else: ?>

            <div class="berita-kosong">

                <h4>
                    Berita tidak ditemukan.
                </h4>

                <a
                    href="<?= base_url('berita') ?>"
                    class="btn-kembali-detail">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        <?php endif; ?>

    </div>

</section>


<?= $this->include('layout/footer') ?>