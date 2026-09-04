<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatan.css') ?>"
>


<section class="detail-kegiatan-page">

    <div class="container">


        <!-- =================================================
             BREADCRUMB
        ================================================== -->

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('kegiatan') ?>">
                        Kegiatan
                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Detail Kegiatan

                </li>

            </ol>

        </nav>


        <?php if (!empty($kegiatan)): ?>


            <!-- =================================================
                 HEADER DETAIL
            ================================================== -->

            <div class="detail-kegiatan-header">


                <!-- THUMBNAIL -->

                <div class="detail-kegiatan-image">

                    <img
                        src="<?= base_url(
                            'uploads/kegiatan/thumbnail/' .
                            $kegiatan['thumbnail']
                        ) ?>"
                        alt="<?= esc($kegiatan['judul']) ?>"
                    >

                </div>


                <!-- INFO -->

                <div class="detail-kegiatan-info">

                    <h1>

                        <?= esc(
                            $kegiatan['judul']
                        ) ?>

                    </h1>


                    <div class="detail-kegiatan-meta">

                        <span>

                            <i class="bi bi-calendar3"></i>

                            <?= date(
                                'l, d F Y',
                                strtotime(
                                    $kegiatan['tanggal']
                                )
                            ) ?>

                        </span>


                        <span>

                            <i class="bi bi-calendar-event"></i>

                            Tahun
                            <?= esc(
                                $kegiatan['tahun']
                            ) ?>

                        </span>


                        <span>

                            <i class="bi bi-images"></i>

                            <?= count($foto) ?>
                            Dokumentasi

                        </span>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 KONTEN
            ================================================== -->

            <?php if (!empty($kegiatan['deskripsi'])): ?>

                <div class="detail-kegiatan-content">

                    <?= nl2br(
                        esc(
                            $kegiatan['deskripsi']
                        )
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 DOKUMENTASI
            ================================================== -->

            <?php if (!empty($foto)): ?>

                <div class="kegiatan-dokumentasi">

                    <div class="kegiatan-section-title">

                        <h2>
                            Dokumentasi Kegiatan
                        </h2>

                        <span></span>

                    </div>


                    <div class="kegiatan-dokumentasi-grid">

                        <?php foreach ($foto as $item): ?>

                            <div class="dokumentasi-item">

                                <img
                                    src="<?= base_url(
                                        'uploads/kegiatan/dokumentasi/' .
                                        $item['foto']
                                    ) ?>"
                                    alt="Dokumentasi Kegiatan"
                                >

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 KEMBALI
            ================================================== -->

            <a
                href="<?= base_url('kegiatan') ?>"
                class="btn-kembali-kegiatan"
            >

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>


        <?php else: ?>


            <div class="kegiatan-kosong">

                <h4>
                    Kegiatan tidak ditemukan.
                </h4>

                <a
                    href="<?= base_url('kegiatan') ?>"
                    class="btn-kembali-kegiatan"
                >

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>


        <?php endif; ?>


    </div>

</section>


<?= $this->include('layout/footer') ?>  