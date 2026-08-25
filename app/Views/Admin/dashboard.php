<?php

$currentUrl = uri_string();

?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/dashboard.css') ?>"
>

<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

 <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">
        <section class="dashboard-content">


            <!-- ==========================================
                 HEADER
            =========================================== -->

            <div class="dashboard-header">

                <h1>
                    Selamat datang, Dinsos
                </h1>

                <p>
                    Kelola seluruh layanan
                </p>

            </div>


            <!-- ==========================================
                 STATISTIC CARDS
            =========================================== -->

            <div class="dashboard-cards">


                <!-- CARD 1 -->

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-pencil-square"></i>

                    </div>

                    <div class="stat-info">

                        <h3>
                            Nama Layanan
                        </h3>

                        <p>
                            Deskripsi layanan singkat
                        </p>

                        <a
                            href="#"
                            class="detail-button"
                        >
                            Detail →
                        </a>

                    </div>

                </div>


                <!-- CARD 2 -->

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-pencil-square"></i>

                    </div>

                    <div class="stat-info">

                        <h3>
                            Nama Layanan
                        </h3>

                        <p>
                            Deskripsi layanan singkat
                        </p>

                        <a
                            href="#"
                            class="detail-button"
                        >
                            Detail →
                        </a>

                    </div>

                </div>


                <!-- CARD 3 -->

                <div class="stat-card stat-number">

                    <div class="stat-info">

                        <h3>
                            Total Berita
                        </h3>

                        <strong>
                            32
                        </strong>

                        <p>
                            Keseluruhan Postingan
                        </p>

                    </div>

                </div>


                <!-- CARD 4 -->

                <div class="stat-card stat-number">

                    <div class="stat-info">

                        <h3>
                            Total Kegiatan
                        </h3>

                        <strong>
                            32
                        </strong>

                        <p>
                            Keseluruhan Kegiatan
                        </p>

                    </div>

                </div>


                <!-- CARD 5 -->

                <div class="stat-card stat-number">

                    <div class="stat-info">

                        <h3>
                            Total Postingan
                        </h3>

                        <strong>
                            32
                        </strong>

                        <p>
                            Keseluruhan Postingan
                        </p>

                    </div>

                </div>


            </div>


            <!-- ==========================================
                 MIDDLE CONTENT
            =========================================== -->

            <div class="dashboard-middle">


                <!-- ======================================
                     CAPAIAN LAYANAN
                ======================================= -->

                <div class="dashboard-panel">

                    <h2 class="panel-title">
                        Capaian Layanan Dinas
                    </h2>


                    <ul class="capaian-list">


                        <li>

                            <i class="bi bi-file-earmark"></i>

                            <span>
                                Total Layanan
                            </span>

                            <span>
                                42
                            </span>

                        </li>


                        <li>

                            <i class="bi bi-check-circle"></i>

                            <span>
                                Layanan Terealisasi
                            </span>

                            <span>
                                42
                            </span>

                        </li>


                        <li>

                            <i class="bi bi-arrow-clockwise"></i>

                            <span>
                                Layanan Berjalan
                            </span>

                            <span>
                                42
                            </span>

                        </li>


                        <li>

                            <i class="bi bi-play"></i>

                            <span>
                                Layanan Belum Terealisasi
                            </span>

                            <span>
                                42
                            </span>

                        </li>


                    </ul>


                    <div class="capaian-total">

                        <div>

                            <small>
                                Capaian Keseluruhan
                            </small>

                            <strong>
                                98%
                            </strong>

                        </div>

                        <i class="bi bi-check2-square"></i>

                    </div>

                </div>


                <!-- ======================================
                     GRAFIK
                ======================================= -->

                <div class="dashboard-panel">

                    <h2 class="panel-title">
                        Grafik Target vs Realisasi Layanan
                    </h2>


                    <div class="chart-container">


                        <!-- 2019 -->

                        <div class="chart-group">

                            <div
                                class="chart-bar"
                                style="height: 70%;"
                            ></div>

                            <div
                                class="chart-bar light"
                                style="height: 55%;"
                            ></div>

                            <span class="chart-label">
                                2019
                            </span>

                        </div>


                        <!-- 2020 -->

                        <div class="chart-group">

                            <div
                                class="chart-bar"
                                style="height: 75%;"
                            ></div>

                            <div
                                class="chart-bar light"
                                style="height: 55%;"
                            ></div>

                            <span class="chart-label">
                                2020
                            </span>

                        </div>


                        <!-- 2021 -->

                        <div class="chart-group">

                            <div
                                class="chart-bar"
                                style="height: 100%;"
                            ></div>

                            <div
                                class="chart-bar light"
                                style="height: 88%;"
                            ></div>

                            <span class="chart-label">
                                2021
                            </span>

                        </div>


                        <!-- 2022 -->

                        <div class="chart-group">

                            <div
                                class="chart-bar"
                                style="height: 45%;"
                            ></div>

                            <div
                                class="chart-bar light"
                                style="height: 18%;"
                            ></div>

                            <span class="chart-label">
                                2022
                            </span>

                        </div>


                    </div>

                </div>


            </div>


            <!-- ==========================================
                 BOTTOM CONTENT
            =========================================== -->

            <div class="dashboard-bottom">


                <!-- ======================================
                     KEGIATAN TERBARU
                ======================================= -->

                <div class="latest-panel">


                    <div class="latest-header">

                        <h3>
                            Kegiatan Terbaru
                        </h3>

                        <a
                            href="#"
                            class="detail-button"
                        >
                            Detail →
                        </a>

                    </div>


                    <!-- ITEM 1 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            1.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Kegiatan Terbaru ...
                            </strong>

                            <span>
                                Deskripsi kegiatan ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 2 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            2.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Kegiatan Terbaru ...
                            </strong>

                            <span>
                                Deskripsi kegiatan ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 3 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            3.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Kegiatan Terbaru ...
                            </strong>

                            <span>
                                Deskripsi kegiatan ...
                            </span>

                        </div>

                    </div>


                </div>


                <!-- ======================================
                     BERITA TERBARU
                ======================================= -->

                <div class="latest-panel">


                    <div class="latest-header">

                        <h3>
                            Berita Terbaru
                        </h3>

                        <a
                            href="#"
                            class="detail-button"
                        >
                            Detail →
                        </a>

                    </div>


                    <!-- ITEM 1 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            1.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Berita Terbaru ...
                            </strong>

                            <span>
                                Deskripsi berita ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 2 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            2.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Berita Terbaru ...
                            </strong>

                            <span>
                                Deskripsi berita ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 3 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            3.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Judul Berita Terbaru ...
                            </strong>

                            <span>
                                Deskripsi berita ...
                            </span>

                        </div>

                    </div>


                </div>


                <!-- ======================================
                     INSTAGRAM
                ======================================= -->

                <div class="latest-panel">


                    <div class="latest-header">

                        <h3>
                            Postingan Terbaru
                        </h3>

                        <a
                            href="#"
                            class="detail-button"
                        >
                            Detail →
                        </a>

                    </div>


                    <!-- ITEM 1 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            1.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Caption Instagram
                            </strong>

                            <span>
                                Postingan terbaru ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 2 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            2.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Caption Instagram
                            </strong>

                            <span>
                                Postingan terbaru ...
                            </span>

                        </div>

                    </div>


                    <!-- ITEM 3 -->

                    <div class="latest-item">

                        <div class="latest-number">
                            3.
                        </div>

                        <div class="latest-image"></div>

                        <div class="latest-info">

                            <strong>
                                Caption Instagram
                            </strong>

                            <span>
                                Postingan terbaru ...
                            </span>

                        </div>

                    </div>


                </div>


            </div>


        </section>

     <?= $this->include('admin/layout/footer') ?>
    </div>
</div>



