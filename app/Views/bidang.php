<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/bidang.css') ?>">

<div class="bidang-page">

    <div class="bidang-container">

        <!-- =====================================================
             BREADCRUMB
        ====================================================== -->

        <div class="breadcrumb-bidang">

            <a href="<?= base_url('/') ?>">
                <i class="bi bi-house-fill"></i>
                Beranda
            </a>

            <span>
                <i class="bi bi-chevron-right"></i>
            </span>

            <a href="<?= base_url('profil') ?>">
                Profil
            </a>

            <span>
                <i class="bi bi-chevron-right"></i>
            </span>

            <strong>
                <?= esc($bidang['nama_bidang']) ?>
            </strong>

        </div>


        <!-- =====================================================
             HERO
        ====================================================== -->

        <section class="bidang-hero">

            <div class="bidang-hero-overlay"></div>

            <div class="bidang-hero-content">

                <div class="bidang-hero-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>

                    <h1>
                        <?= esc($bidang['nama_bidang']) ?>
                    </h1>

                    <?php if (!empty($bidang['subjudul'])): ?>

                        <p>
                            <?= esc($bidang['subjudul']) ?>
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </section>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div class="bidang-layout">


            <!-- =================================================
                 KOLOM KIRI
            ================================================== -->

            <main class="bidang-main">


                <!-- =================================================
                     TENTANG
                ================================================== -->

                <section class="bidang-card">

                    <div class="section-heading">

                        <h2>
                            Tentang <?= esc($bidang['nama_bidang']) ?>
                        </h2>

                        <span></span>

                    </div>


                    <div class="tentang-wrapper">


                        <div class="tentang-text">

                            <?php if (!empty($detail['tentang'])): ?>

                                <?php
                                $tentang = preg_split(
                                    '/\r\n|\r|\n/',
                                    $detail['tentang']
                                );
                                ?>

                                <?php foreach ($tentang as $paragraph): ?>

                                    <?php if (trim($paragraph) !== ''): ?>

                                        <p>
                                            <?= esc(trim($paragraph)) ?>
                                        </p>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p>
                                    Informasi tentang bidang belum tersedia.
                                </p>

                            <?php endif; ?>

                        </div>


                        <?php if (!empty($detail['gambar'])): ?>

                            <div class="tentang-image">

                                <img
                                    src="<?= base_url('uploads/bidang/' . $detail['gambar']) ?>"
                                    alt="<?= esc($bidang['nama_bidang']) ?>"
                                >

                            </div>

                        <?php endif; ?>


                    </div>

                </section>


                <!-- =================================================
                     RUANG LINGKUP
                ================================================== -->

                <section class="bidang-card">

                    <div class="section-heading">

                        <h2>
                            Ruang Lingkup
                        </h2>

                        <span></span>

                    </div>


                    <?php if (!empty($detail['ruang_lingkup'])): ?>

                        <?php
                        $ruangLingkup = preg_split(
                            '/\r\n|\r|\n/',
                            $detail['ruang_lingkup']
                        );
                        ?>


                        <div class="ruang-grid">

                            <?php foreach ($ruangLingkup as $item): ?>

                                <?php if (trim($item) !== ''): ?>

                                    <div class="ruang-item">

                                        <div class="ruang-icon">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </div>

                                        <h3>
                                            <?= esc(trim($item)) ?>
                                        </h3>

                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>


                    <?php else: ?>

                        <p>
                            Informasi ruang lingkup belum tersedia.
                        </p>

                    <?php endif; ?>

                </section>


                <!-- =================================================
                     KONTAK
                ================================================== -->

                <section class="bidang-card">

                    <div class="section-heading">

                        <h2>
                            Informasi Kontak
                        </h2>

                        <span></span>

                    </div>


                    <div class="kontak-grid">


                        <!-- TELEPON -->

                        <?php if (!empty($detail['telepon'])): ?>

                            <div class="kontak-item">

                                <i class="bi bi-telephone-fill"></i>

                                <span>
                                    <?= esc($detail['telepon']) ?>
                                </span>

                            </div>

                        <?php endif; ?>


                        <!-- EMAIL -->

                        <?php if (!empty($detail['email'])): ?>

                            <div class="kontak-item">

                                <i class="bi bi-envelope"></i>

                                <span>
                                    <?= esc($detail['email']) ?>
                                </span>

                            </div>

                        <?php endif; ?>


                        <!-- ALAMAT -->

                        <?php if (!empty($detail['alamat'])): ?>

                            <div class="kontak-item">

                                <i class="bi bi-geo-alt-fill"></i>

                                <span>
                                    <?= nl2br(esc($detail['alamat'])) ?>
                                </span>

                            </div>

                        <?php endif; ?>


                        <?php if (
                            empty($detail['telepon']) &&
                            empty($detail['email']) &&
                            empty($detail['alamat'])
                        ): ?>

                            <p>
                                Informasi kontak belum tersedia.
                            </p>

                        <?php endif; ?>


                    </div>

                </section>


            </main>


            <!-- =================================================
                 KOLOM KANAN
            ================================================== -->

            <aside class="bidang-sidebar">


                <!-- =================================================
                     TUGAS POKOK
                ================================================== -->

                <section class="bidang-card">

                    <div class="section-heading">

                        <h2>
                            Tugas Pokok
                        </h2>

                        <span></span>

                    </div>


                    <?php if (!empty($detail['tugas_pokok'])): ?>

                        <?php
                        $tugasPokok = preg_split(
                            '/\r\n|\r|\n/',
                            $detail['tugas_pokok']
                        );
                        ?>


                        <ul class="tugas-list">

                            <?php foreach ($tugasPokok as $tugas): ?>

                                <?php if (trim($tugas) !== ''): ?>

                                    <li>

                                        <i class="bi bi-check-circle-fill"></i>

                                        <span>
                                            <?= esc(trim($tugas)) ?>
                                        </span>

                                    </li>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </ul>


                    <?php else: ?>

                        <p>
                            Tugas pokok belum tersedia.
                        </p>

                    <?php endif; ?>


                </section>


                <!-- =================================================
                     PROGRAM & KEGIATAN
                ================================================== -->

                <section class="bidang-card">

                    <div class="section-heading">

                        <h2>
                            Program & Kegiatan
                        </h2>

                        <span></span>

                    </div>


                    <?php if (!empty($detail['program_kegiatan'])): ?>

                        <?php
                        $programKegiatan = preg_split(
                            '/\r\n|\r|\n/',
                            $detail['program_kegiatan']
                        );
                        ?>


                        <div class="program-list">

                            <?php foreach ($programKegiatan as $program): ?>

                                <?php if (trim($program) !== ''): ?>

                                    <div class="program-item">

                                        <div class="program-icon">

                                            <i class="bi bi-newspaper"></i>

                                        </div>


                                        <div class="program-info">

                                            <h3>
                                                <?= esc(trim($program)) ?>
                                            </h3>

                                        </div>


                                        <i class="bi bi-chevron-right program-arrow"></i>

                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>


                    <?php else: ?>

                        <p>
                            Program dan kegiatan belum tersedia.
                        </p>

                    <?php endif; ?>


                </section>


            </aside>


        </div>

    </div>

</div>


<?= $this->include('layout/footer') ?>