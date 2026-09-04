<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dokumen-detail.css') ?>"
>

<main class="detail-page">


    <!-- =========================
         BREADCRUMB
    ========================== -->

    <section class="breadcrumb-section">

        <div class="detail-container">

            <div class="breadcrumb-custom">

                <a href="<?= base_url('/') ?>">
                    Beranda
                </a>

                <span>
                    <i class="bi bi-chevron-right"></i>
                </span>

                <a href="<?= base_url('dokumen') ?>">
                    Dokumen
                </a>

                <span>
                    <i class="bi bi-chevron-right"></i>
                </span>

            </div>

        </div>

    </section>



    <!-- =========================
         DETAIL CARD
    ========================== -->

    <section class="detail-content">

        <div class="detail-container">


            <div class="detail-card">


                <!-- JUDUL -->

                <h1>
                    <?= strtoupper(
                    str_replace(
                    '-',
                     ' ',
                $dokumen['slug']
                 )
             ) ?>
        </h1>

                <!-- LIST DOKUMEN -->

                <div class="dokumen-list">


                    <!-- Jika ingin 1 dokumen saja -->
                    <div class="detail-item">

                        <div class="detail-title">

                            <?= esc($dokumen['judul']) ?>

                        </div>


                        <div class="detail-actions">


                            <!-- LIHAT -->

                            <?php if (!empty($dokumen['file'])): ?>

                                <a
                                    href="<?= base_url(
                                        'uploads/dokumen/' . $dokumen['file']
                                    ) ?>"
                                    target="_blank"
                                    class="btn-detail btn-outline"
                                >

                                    Lihat

                                </a>


                                <!-- UNDUH -->

                                <a
                                    href="<?= base_url(
                                        'uploads/dokumen/' . $dokumen['file']
                                    ) ?>"
                                    download
                                    class="btn-detail btn-download"
                                >

                                    Unduh

                                </a>

                            <?php endif; ?>


                        </div>

                    </div>


                </div>


                <!-- KEMBALI -->

                <div class="back-wrapper">

                    <a
                        href="<?= base_url('dokumen') ?>"
                        class="btn-kembali"
                    >

                        Kembali

                    </a>

                </div>


            </div>


        </div>

    </section>

</main>


<?= $this->include('layout/footer') ?>