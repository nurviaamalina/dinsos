<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="berita-page">

    <div class="container">

        <!-- =========================
             BREADCRUMB
        ========================== -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Berita
                </li>
            </ol>
        </nav>


        <!-- =========================
             JUDUL
        ========================== -->

        <h1 class="judul-berita-page">
            Kabar terbaru dari Dinas sosial
        </h1>


        <?php if (!empty($berita)): ?>

            <?php
                /*
                 * Berita pertama menjadi berita utama
                 */
                $utama = $berita[0];

                /*
                 * Berita berikutnya menjadi berita kecil
                 */
                $beritaKecil = array_slice($berita, 1, 4);
            ?>


            <!-- =========================
                 BERITA UTAMA + BERITA KECIL
            ========================== -->

            <div class="berita-layout">

                <!-- BERITA UTAMA -->

                <div class="berita-utama">

                    <a
                        href="<?= base_url('berita/' . $utama['slug']) ?>"
                        class="berita-card utama-card">

                        <img
                            src="<?= base_url('uploads/berita/' . $utama['gambar']) ?>"
                            alt="<?= esc($utama['judul']) ?>">

                        <div class="berita-overlay">

                            <h2>
                                <?= esc($utama['judul']) ?>
                            </h2>

                            <span>
                                <?= date( 'd F Y',strtotime($utama['tanggal'])) ?>
                            </span>

                        </div>

                    </a>

                </div>


                <!-- BERITA KECIL -->

                <div class="berita-kecil">

                    <?php foreach ($beritaKecil as $item): ?>

                        <a
                            href="<?= base_url('berita/' . $item['slug']) ?>"
                            class="berita-card kecil-card">

                            <img
                                src="<?= base_url('uploads/berita/' . $item['gambar']) ?>"
                                alt="<?= esc($item['judul']) ?>">

                            <div class="berita-overlay">

                                <h3>
                                    <?= esc($item['judul']) ?>
                                </h3>

                                <span>
                                    <?= date( 'd F Y', strtotime($item['tanggal'])) ?>
                                </span>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            </div>


            <!-- =========================
                 PAGINATION
            ========================== -->

            <?php if (isset($pager)): ?>

    <div class="berita-pagination">

        <?= $pager->links() ?>

    </div>

<?php endif; ?>


        <?php else: ?>

            <!-- JIKA BELUM ADA BERITA -->

            <div class="berita-kosong">

                <h4>
                    Belum ada berita.
                </h4>

                <p>
                    Belum terdapat berita yang dipublikasikan.
                </p>

            </div>

        <?php endif; ?>

    </div>

</section>


<?= $this->include('layout/footer') ?>