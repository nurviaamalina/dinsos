<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet"
      href="<?= base_url('assets/css/admin/dashboard_statistik.css') ?>">

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4 bg-light">


        <!-- =========================================
             HEADER
        ========================================== -->

        <div class="statistik-header">

            <div>

                <h2>
                    Dashboard Statistik
                </h2>

                <p>
                    Kelola seluruh Data
                </p>

            </div>

        </div>


        <!-- =========================================
             ROW 1
        ========================================== -->

        <div class="statistik-grid statistik-grid-top">


            <!-- =====================================
                 CAPAIAN LAYANAN DINAS
            ====================================== -->

            <div class="statistik-card">

                <div class="statistik-card-title">

                    <h5>
                        Capaian Layanan Dinas
                    </h5>

                </div>


                <div class="layanan-stat-list">


                    <div class="layanan-stat-item">

                        <div>

                            <i class="bi bi-file-earmark"></i>

                            <span>
                                Total Layanan
                            </span>

                        </div>

                        <strong>
                            42
                        </strong>

                    </div>


                    <div class="layanan-stat-item">

                        <div>

                            <i class="bi bi-check-circle"></i>

                            <span>
                                Layanan Terealisasi
                            </span>

                        </div>

                        <strong>
                            42
                        </strong>

                    </div>


                    <div class="layanan-stat-item">

                        <div>

                            <i class="bi bi-clock-history"></i>

                            <span>
                                Layanan Berjalan
                            </span>

                        </div>

                        <strong>
                            42
                        </strong>

                    </div>


                    <div class="layanan-stat-item">

                        <div>

                            <i class="bi bi-play"></i>

                            <span>
                                Layanan Belum Terealisasi
                            </span>

                        </div>

                        <strong>
                            42
                        </strong>

                    </div>


                </div>


                <div class="capaian-overall">

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



            <!-- =====================================
                 GRAFIK
            ====================================== -->

            <div class="statistik-card">

                <div class="statistik-card-title">

                    <h5>
                        Grafik Target vs Realiasi Layanan
                    </h5>

                </div>


                <div class="statistik-chart">

                    <canvas id="layananChart"></canvas>

                </div>

            </div>



            <!-- =====================================
                 SURVEI
            ====================================== -->

            <div class="statistik-card survey-card">

                <div class="statistik-card-title">

                    <h5>
                        Hasil Survei Kepuasan Masyarakat
                    </h5>

                </div>


                <div class="survey-score">

                    <i class="bi bi-star"></i>

                    <strong>
                        88,42 %
                    </strong>

                </div>


                <p class="survey-label">
                    Indeks Kepuasan Masyarakat
                </p>


                <div class="survey-info">


                    <div>

                        <span>
                            Responden
                        </span>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Orang
                        </small>

                    </div>


                    <div>

                        <span>
                            Periode
                        </span>

                        <strong>
                            2026
                        </strong>

                        <small>
                            Tahun 2026
                        </small>

                    </div>


                    <div>

                        <span>
                            Kategori
                        </span>

                        <strong class="survey-good">
                            Sangat<br>
                            Baik
                        </strong>

                    </div>


                </div>

            </div>

        </div>



        <!-- =========================================
             ROW 2
        ========================================== -->

        <div class="statistik-grid statistik-grid-middle">


            <!-- =====================================
                 CAPAIAN PER BIDANG
            ====================================== -->

            <div class="statistik-card bidang-stat-card">

                <div class="statistik-card-title">

                    <h5>
                        Capaian Per Bidang
                    </h5>

                </div>


                <div class="bidang-stat-list">


                    <div class="bidang-stat-item">

                        <i class="bi bi-shield-check"></i>

                        <div class="bidang-name">
                            Perlindungan dan
                            <br>
                            Jaminan Sosial
                        </div>

                        <div class="bidang-progress">

                            <span style="width: 90%;"></span>

                        </div>

                        <strong>
                            90%
                        </strong>

                    </div>



                    <div class="bidang-stat-item">

                        <i class="bi bi-people"></i>

                        <div class="bidang-name">
                            Pemberdayaan dan
                            <br>
                            Rehabilitasi Sosial
                        </div>

                        <div class="bidang-progress">

                            <span style="width: 90%;"></span>

                        </div>

                        <strong>
                            90%
                        </strong>

                    </div>



                    <div class="bidang-stat-item">

                        <i class="bi bi-person-heart"></i>

                        <div class="bidang-name">
                            Pemberdayaan
                            <br>
                            Perempuan dan
                            <br>
                            Perlindungan Anak
                        </div>

                        <div class="bidang-progress">

                            <span style="width: 90%;"></span>

                        </div>

                        <strong>
                            90%
                        </strong>

                    </div>



                    <div class="bidang-stat-item">

                        <i class="bi bi-people-fill"></i>

                        <div class="bidang-name">
                            Penanganan Penduduk dan
                            <br>
                            Keluarga Berencana
                        </div>

                        <div class="bidang-progress">

                            <span style="width: 90%;"></span>

                        </div>

                        <strong>
                            90%
                        </strong>

                    </div>


                </div>

            </div>



            <!-- =====================================
                 LAYANAN UNGGULAN
            ====================================== -->

            <div class="statistik-card">

                <div class="statistik-card-title">

                    <h5>
                        Layanan Unggulan
                    </h5>

                </div>


                <div class="layanan-unggulan-grid">


                    <?php for ($i = 1; $i <= 4; $i++): ?>

                        <div class="layanan-unggulan-item">


                            <h6>
                                Nama Program /
                                <br>
                                Layanan
                            </h6>


                            <div class="unggulan-icon">

                                <i class="bi bi-hand-heart"></i>

                            </div>


                            <div class="unggulan-bottom">


                                <div>

                                    <strong>
                                        92%
                                    </strong>

                                    <small>
                                        Capaian
                                    </small>

                                </div>


                                <div>

                                    <strong>
                                        1222
                                    </strong>

                                    <small>
                                        Penerima
                                        <br>
                                        Program
                                    </small>

                                </div>


                            </div>


                        </div>

                    <?php endfor; ?>


                </div>

            </div>

        </div>



        <!-- =========================================
             ROW 3
        ========================================== -->

        <div class="statistik-grid statistik-grid-bottom">


            <!-- =====================================
                 PENERIMA MANFAAT
            ====================================== -->

            <div class="statistik-card penerima-card">

                <div class="statistik-card-title">

                    <h5>
                        Penerima Manfaat / Masyarakat Terlayani
                    </h5>

                </div>


                <div class="penerima-grid">


                    <div class="penerima-item">

                        <i class="bi bi-people"></i>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Total Penerima Manfaat
                        </small>

                    </div>


                    <div class="penerima-item">

                        <i class="bi bi-people"></i>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Penyandang Disabilitas
                        </small>

                    </div>


                    <div class="penerima-item">

                        <i class="bi bi-people"></i>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Lansia
                        </small>

                    </div>


                    <div class="penerima-item">

                        <i class="bi bi-people"></i>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Anak
                        </small>

                    </div>


                    <div class="penerima-item">

                        <i class="bi bi-people"></i>

                        <strong>
                            1.342
                        </strong>

                        <small>
                            Keluarga Penerima Manfaat
                        </small>

                    </div>


                </div>



                <div class="kategori-title">

                    Persentase Penerima Manfaat Berdasarkan Kategori

                </div>



                <div class="kategori-wrapper">


                    <div class="kategori-chart">

                        <canvas id="kategoriChart"></canvas>

                    </div>


                    <div class="kategori-legend">


                        <div>

                            <span class="legend legend-1"></span>

                            <strong>
                                65%
                            </strong>

                            <small>
                                Keluarga Penerima Manfaat
                            </small>

                        </div>


                        <div>

                            <span class="legend legend-2"></span>

                            <strong>
                                35%
                            </strong>

                            <small>
                                Penyandang Disabilitas
                            </small>

                        </div>


                        <div>

                            <span class="legend legend-3"></span>

                            <strong>
                                15%
                            </strong>

                            <small>
                                Lansia
                            </small>

                        </div>


                        <div>

                            <span class="legend legend-4"></span>

                            <strong>
                                10%
                            </strong>

                            <small>
                                Anak
                            </small>

                        </div>


                        <div>

                            <span class="legend legend-5"></span>

                            <strong>
                                5%
                            </strong>

                            <small>
                                Lainnya
                            </small>

                        </div>


                    </div>


                </div>

            </div>



            <!-- =====================================
                 SEBARAN KECAMATAN
            ====================================== -->

            <div class="statistik-card kecamatan-card">

                <div class="statistik-card-title">

                    <h5>
                        Sebaran Capaian Per Kecamatan
                    </h5>

                </div>


                <div class="kecamatan-wrapper">


                    <!-- MAP -->
                    <div class="kecamatan-map">

                        <div class="fake-map">

                            <div class="map-area map-1"></div>
                            <div class="map-area map-2"></div>
                            <div class="map-area map-3"></div>
                            <div class="map-area map-4"></div>
                            <div class="map-area map-5"></div>
                            <div class="map-area map-6"></div>
                            <div class="map-area map-7"></div>
                            <div class="map-area map-8"></div>

                        </div>

                    </div>



                    <!-- TOP 5 -->
                    <div class="top-kecamatan">

                        <h6>
                            Top 5 Kecamatan
                        </h6>


                        <div class="top-item">

                            <span>1</span>

                            <p>
                                Banyuwangi
                            </p>

                        </div>


                        <div class="top-item">

                            <span>2</span>

                            <p>
                                Rogojampi
                            </p>

                        </div>


                        <div class="top-item">

                            <span>3</span>

                            <p>
                                Kalipuro
                            </p>

                        </div>


                        <div class="top-item">

                            <span>4</span>

                            <p>
                                Giri
                            </p>

                        </div>


                        <div class="top-item">

                            <span>5</span>

                            <p>
                                Glagah
                            </p>

                        </div>


                        <div class="map-legend">


                            <div>

                                <span class="legend-high"></span>

                                81–100%

                            </div>


                            <div>

                                <span class="legend-medium"></span>

                                61–80%

                            </div>


                            <div>

                                <span class="legend-low"></span>

                                0–60%

                            </div>


                        </div>


                    </div>


                </div>

            </div>


        </div>


    </div>

</div>



<?= $this->include('admin/layout/footer') ?>



<!-- =========================================
     CHART JS
========================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

/* =========================================
   GRAFIK TARGET VS REALISASI
========================================= */

const layananChart =
    document.getElementById('layananChart');

new Chart(layananChart, {

    type: 'bar',

    data: {

        labels: [
            '2019',
            '2020',
            '2021',
            '2022'
        ],

        datasets: [

            {
                label: 'Target',

                data: [
                    70,
                    75,
                    100,
                    45
                ],

                backgroundColor: '#650719',

                borderRadius: 5,

                barThickness: 16
            },

            {
                label: 'Realisasi',

                data: [
                    56,
                    56,
                    87,
                    18
                ],

                backgroundColor: '#f3a0ae',

                borderRadius: 5,

                barThickness: 16
            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {

                beginAtZero: true,

                max: 100,

                ticks: {
                    stepSize: 25
                },

                grid: {
                    display: false
                }

            },

            x: {

                grid: {
                    display: false
                }

            }

        }

    }

});



/* =========================================
   KATEGORI PENERIMA
========================================= */

const kategoriChart =
    document.getElementById('kategoriChart');

new Chart(kategoriChart, {

    type: 'pie',

    data: {

        labels: [
            'Keluarga Penerima Manfaat',
            'Penyandang Disabilitas',
            'Lansia',
            'Anak',
            'Lainnya'
        ],

        datasets: [{

            data: [
                65,
                35,
                15,
                10,
                5
            ],

            backgroundColor: [
                '#650719',
                '#a50e28',
                '#e83152',
                '#f08da0',
                '#f7cbd2'
            ],

            borderWidth: 0

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }

        }

    }

});

</script>