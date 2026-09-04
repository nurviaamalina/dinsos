<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/layanan_detail.css') ?>">

<main class="layanan-detail-page">

    <div class="breadcrumb-detail">

        <a href="<?= base_url('/') ?>">
            Beranda
        </a>

        <i class="bi bi-chevron-right"></i>

        <a href="<?= base_url('layanan') ?>">
            Layanan
        </a>

        <i class="bi bi-chevron-right"></i>

        <span>
            <?= esc($layanan['nama_layanan']) ?>
        </span>

    </div>


    <!-- =====================================================
         JUDUL LAYANAN
    ====================================================== -->

    <section class="detail-heading">

        <h1>
            <?= esc($layanan['nama_layanan']) ?>
        </h1>

        <p>
            <?= esc($layanan['nama_layanan']) ?>
            merupakan layanan yang disediakan untuk membantu masyarakat
            memperoleh pelayanan dengan lebih mudah, cepat, dan transparan.
        </p>

    </section>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="detail-layout">


        <!-- =================================================
             KOLOM KIRI
        ================================================== -->

        <div class="detail-left">


            <!-- =================================================
                 DESKRIPSI LAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h2>
                        Deskripsi Layanan
                    </h2>

                </div>


                <div class="card-content">

                    <?php if (!empty($layanan['deskripsi_layanan'])): ?>

                        <?= $layanan['deskripsi_layanan'] ?>

                    <?php else: ?>

                        <p>
                            Deskripsi layanan belum tersedia.
                        </p>

                    <?php endif ?>

                </div>

            </div>



            <!-- =================================================
                 STANDAR LAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-clipboard-text"></i>
                    </div>

                    <h2>
                        Standar Layanan
                    </h2>

                </div>


                <div class="card-content">

                    <?php if (!empty($layanan['standar_layanan'])): ?>

                        <?= $layanan['standar_layanan'] ?>

                    <?php else: ?>

                        <p>
                            Standar layanan belum tersedia.
                        </p>

                    <?php endif ?>

                </div>

            </div>



            <!-- =================================================
                 PROSEDUR PELAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <h2>
                        Prosedur Pelayanan
                    </h2>

                </div>


                <div class="card-content">

                    <?php if (!empty($layanan['prosedur_layanan'])): ?>

                        <?= $layanan['prosedur_layanan'] ?>

                    <?php else: ?>

                        <p>
                            Prosedur pelayanan belum tersedia.
                        </p>

                    <?php endif ?>

                </div>

            </div>



            <!-- =================================================
                 WAKTU PELAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <h2>
                        Waktu Pelayanan
                    </h2>

                </div>


                <div class="card-content">

                    <p>
                        Pelayanan diselesaikan dalam jangka waktu maksimal
                        <strong>1–3 hari kerja</strong>
                        sejak persyaratan dinyatakan lengkap dan sesuai,
                        dengan memperhatikan hasil verifikasi dan ketentuan
                        yang berlaku.
                    </p>

                </div>

            </div>



            <!-- =================================================
                 TOMBOL KEMBALI
            ================================================== -->

            <a
                href="<?= base_url('layanan') ?>"
                class="btn-kembali"
            >

                <i class="bi bi-arrow-left"></i>

                <span>
                    Kembali
                </span>

            </a>


        </div>



        <!-- =================================================
             KOLOM KANAN
        ================================================== -->

        <aside class="detail-right">

            <div class="side-card">


                <!-- =================================================
                     BIDANG
                ================================================== -->

                <div class="side-section">

                    <h3>
                        Bidang
                    </h3>


                    <div class="bidang-badge">

                        <i class="bi bi-shield-check"></i>

                        <span>
                            <?= esc($layanan['bidang']) ?>
                        </span>

                    </div>

                </div>



                <!-- =================================================
                     SOP
                ================================================== -->

                <div class="side-section">

                    <h3>
                        Dokumen Standar Operasional (SOP)
                    </h3>


                    <?php if (!empty($layanan['dokumen'])): ?>

                        <a
                            href="<?= base_url('uploads/dokumen/' . $layanan['dokumen']) ?>"
                            target="_blank"
                            class="sop-item"
                        >

                            <div class="sop-name">

                                <i class="bi bi-file-earmark-pdf-fill"></i>

                                <span>
                                    <?= esc($layanan['dokumen']) ?>
                                </span>

                            </div>


                            <i class="bi bi-download"></i>

                        </a>

                    <?php else: ?>

                        <div class="sop-item sop-empty">

                            <div class="sop-name">

                                <i class="bi bi-file-earmark-pdf-fill"></i>

                                <span>
                                    Dokumen SOP belum tersedia
                                </span>

                            </div>

                        </div>

                    <?php endif ?>

                </div>



                <!-- =================================================
                     BANTUAN
                ================================================== -->

                <div class="side-section bantuan-section">

                    <h3>
                        Butuh Bantuan?
                    </h3>


                    <p>
                        Jika Anda mengalami kendala atau membutuhkan
                        informasi lebih lanjut terkait layanan ini,
                        silakan menghubungi petugas pelayanan kami.
                    </p>


                    <a
                        href="<?= base_url('kontak') ?>"
                        class="btn-hubungi"
                    >

                        <i class="bi bi-telephone"></i>

                        <span>
                            Hubungi Kami
                        </span>

                    </a>

                </div>

            </div>

        </aside>

    </div>

</main>


<?= $this->include('layout/footer') ?>