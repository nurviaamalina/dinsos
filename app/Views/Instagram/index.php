<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/instagram.css') ?>"
>


<!-- =====================================================
     FEED INSTAGRAM
====================================================== -->

<section class="instagram-section">

    <div class="instagram-container">


        <!-- =================================================
             TITLE
        ================================================== -->

        <div class="instagram-title">

            <h1>
                Feed <span>Instagram</span>
            </h1>

            <div class="instagram-title-line"></div>

        </div>


        <!-- =================================================
             CONTENT
        ================================================== -->

        <div class="instagram-content">


            <!-- =============================================
                 KIRI - MOCKUP INSTAGRAM
            ============================================== -->

            <div class="instagram-preview">

                <div class="instagram-circle"></div>

                <img
                    src="<?= base_url('assets/images/instagram-phone.png') ?>"
                    alt="Instagram"
                    class="instagram-phone"
                >

            </div>


            <!-- =============================================
                 KANAN - POSTINGAN
            ============================================== -->

            <div class="instagram-post-wrapper">

                <?php if (!empty($instagram)): ?>

                    <div class="instagram-grid">


                        <?php foreach ($instagram as $post): ?>

                            <a
                                href="<?= esc($post['permalink']) ?>"
                                class="instagram-card"
                            >


                                <!-- GAMBAR -->

                                <div class="instagram-card-image">

                                    <?php if (!empty($post['gambar'])): ?>

                                        <img
                                            src="<?= esc($post['gambar']) ?>"
                                            alt="Postingan Instagram"
                                        >

                                    <?php else: ?>

                                        <div class="instagram-placeholder">

                                            <i class="bi bi-instagram"></i>

                                        </div>

                                    <?php endif; ?>

                                </div>


                                <!-- CONTENT -->

                                <div class="instagram-card-content">

                                    <h3>

                                        <?= esc($post['caption']) ?>

                                    </h3>


                                    <span class="instagram-date">

                                        <?= esc($post['tanggal']) ?>

                                    </span>

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


        <!-- =================================================
             BUTTON
        ================================================== -->

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


    </div>

</section>


<?= $this->include('layout/footer') ?>