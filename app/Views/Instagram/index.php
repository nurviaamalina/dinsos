<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/instagram.css') ?>"
>


<section class="instagram-section">

    <div class="instagram-container">


        <!-- =====================================================
             TITLE
        ====================================================== -->

        <div class="instagram-title">

            <h1>
                Feed <span>Instagram</span>
            </h1>

            <div class="instagram-title-line"></div>

        </div>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div class="instagram-content">


            <!-- =================================================
                 KIRI - PHONE INSTAGRAM
            ================================================== -->

            <div class="instagram-preview">

                <div class="instagram-circle"></div>

                <img
                    src="<?= base_url('assets/images/instagram-phone.png') ?>"
                    alt="Instagram Dinsos PPKB Banyuwangi"
                    class="instagram-phone"
                >

            </div>


            <!-- =================================================
                 KANAN - 6 POSTING TERBARU
            ================================================== -->

            <div class="instagram-post-wrapper">


                <?php if (!empty($instagram)): ?>


                    <div class="instagram-grid">


                        <?php foreach ($instagram as $post): ?>


                            <?php

                            /*
                            |--------------------------------------------------------------------------
                            | THUMBNAIL
                            |--------------------------------------------------------------------------
                            */

                            $thumbnailUrl = null;


                            if (!empty($post['thumbnail'])) {

                                $thumbnailUrl = base_url(
                                    'uploads/instagram/' .
                                    $post['thumbnail']
                                );

                            } elseif (!empty($post['thumbnail_url'])) {

                                $thumbnailUrl = $post['thumbnail_url'];

                            } elseif (!empty($post['media_url'])) {

                                $thumbnailUrl = $post['media_url'];

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | CAPTION
                            |--------------------------------------------------------------------------
                            */

                            $caption = trim(
                                strip_tags(
                                    (string) ($post['caption'] ?? '')
                                )
                            );


                            if ($caption === '') {

                                $caption = 'Postingan Instagram';

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | TANGGAL
                            |--------------------------------------------------------------------------
                            */

                            $tanggal = null;


                            if (!empty($post['posted_at'])) {

                                $tanggal = $post['posted_at'];

                            } elseif (!empty($post['tanggal_post'])) {

                                $tanggal = $post['tanggal_post'];

                            }

                            ?>


                            <!-- =============================================
                                 CARD INSTAGRAM
                            ============================================== -->

                            <a
                                href="<?= !empty($post['permalink'])
                                    ? esc($post['permalink'])
                                    : '#' ?>"
                                class="instagram-card"
                                target="_blank"
                                rel="noopener noreferrer"
                            >


                                <!-- =========================================
                                     IMAGE
                                ========================================== -->

                                <div class="instagram-card-image">


                                    <?php if (!empty($thumbnailUrl)): ?>

                                        <img
                                            src="<?= esc($thumbnailUrl) ?>"
                                            alt="Postingan Instagram"
                                            loading="lazy"
                                        >

                                    <?php else: ?>

                                        <div class="instagram-placeholder">

                                            <i class="bi bi-instagram"></i>

                                        </div>

                                    <?php endif; ?>


                                </div>


                                <!-- =========================================
                                     CONTENT
                                ========================================== -->

                                <div class="instagram-card-content">


                                    <h3>
                                        <?= esc($caption) ?>
                                    </h3>


                                    <?php if (!empty($tanggal)): ?>

                                        <span class="instagram-date">

                                            <?= date(
                                                'd M Y H:i',
                                                strtotime($tanggal)
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="instagram-date">
                                            -
                                        </span>

                                    <?php endif; ?>


                                </div>


                            </a>


                        <?php endforeach; ?>


                    </div>


                <?php else: ?>


                    <div class="instagram-empty">

                        <i class="bi bi-instagram"></i>

                        <p>
                            Belum ada postingan Instagram.
                        </p>

                    </div>


                <?php endif; ?>


            </div>

        </div>


        <!-- =====================================================
             BUTTON
        ====================================================== -->

        <div class="instagram-button-wrapper">

            <a
                href="https://www.instagram.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="instagram-button"
            >

                <i class="bi bi-instagram"></i>

                Lihat Selengkapnya di Instagram

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

        <!-- =====================================================
     BACK TO HOME
====================================================== -->

<div class="instagram-back-wrapper">

    <a
        href="<?= base_url('/') ?>"
        class="instagram-back-button"
    >
        <i class="bi bi-arrow-left"></i>
        Kembali ke Beranda
    </a>

</div>

    </div>

</section>


<?= $this->include('layout/footer') ?>