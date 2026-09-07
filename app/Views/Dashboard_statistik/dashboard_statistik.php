<?= $this->include('layout/header') ?>

<link rel="stylesheet"
      href="<?= base_url('assets/css/statistik.css') ?>">


<!-- =====================================================
     HERO STATISTIK
====================================================== -->

<section class="statistik-hero">

    <div class="statistik-hero-overlay"></div>

    <div class="statistik-hero-container">

        <h1>
            Dashboard Statistik
        </h1>

        <div class="statistik-hero-line"></div>


        <div class="statistik-hero-bottom">

            <h2>
                Grafik Persentase Pencapaian Dinas Sosial
                <br>
                Dan Pemberdayaan Perempuan dan KB
            </h2>


            <!-- FILTER TAHUN -->

            <div class="statistik-year">

                <i class="bi bi-calendar3"></i>

                <span>
                    Tahun 2026
                </span>

                <i class="bi bi-chevron-down"></i>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     MAIN STATISTIK
====================================================== -->

<main class="statistik-main">


    <!-- =================================================
         BARIS 1
    ================================================== -->

    <section class="statistik-grid statistik-grid-top">


        <!-- =============================================
             CAPAIAN LAYANAN
        ============================================== -->

        <div class="statistik-box">

            <div class="statistik-box-title">

                <h3>
                    Capaian Layanan Dinas
                </h3>

                <span></span>

            </div>


            <div class="layanan-list">


                <div class="layanan-row">

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


                <div class="layanan-row">

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


                <div class="layanan-row">

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


                <div class="layanan-row">

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


            <div class="capaian-box">

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



        <!-- =============================================
             GRAFIK
        ============================================== -->

        <div class="statistik-box">

            <div class="statistik-box-title">

                <h3>
                    Grafik Target vs Realiasi Layanan
                </h3>

                <span></span>

            </div>


            <div class="statistik-chart">

                <canvas id="layananChart"></canvas>

            </div>

        </div>



        <!-- =============================================
             SURVEI
        ============================================== -->

        <div class="statistik-box statistik-survey">

            <div class="statistik-box-title">

                <h3>
                    Hasil Survei Kepuasan Masyarakat
                </h3>

                <span></span>

            </div>


            <div class="survey-score">

                <i class="bi bi-star"></i>

                <strong>
                    88,42 %
                </strong>

            </div>


            <p>
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
                        Sangat
                        <br>
                        Baik
                    </strong>

                </div>


            </div>

        </div>

    </section>



    <!-- =================================================
         BARIS 2
    ================================================== -->

    <section class="statistik-grid statistik-grid-middle">


        <!-- =============================================
             CAPAIAN PER BIDANG
        ============================================== -->

        <div class="statistik-box bidang-box">

            <div class="statistik-box-title">

                <h3>
                    Capaian Per Bidang
                </h3>

                <span></span>

            </div>


            <div class="bidang-list">


                <div class="bidang-row">

                    <i class="bi bi-shield-check"></i>

                    <div class="bidang-name">
                        Perlindungan dan
                        <br>
                        Jaminan Sosial
                    </div>

                    <div class="bidang-progress">

                        <span style="width:90%"></span>

                    </div>

                    <strong>
                        90%
                    </strong>

                </div>



                <div class="bidang-row">

                    <i class="bi bi-people"></i>

                    <div class="bidang-name">
                        Pemberdayaan dan
                        <br>
                        Rehabilitasi Sosial
                    </div>

                    <div class="bidang-progress">

                        <span style="width:90%"></span>

                    </div>

                    <strong>
                        90%
                    </strong>

                </div>



                <div class="bidang-row">

                    <i class="bi bi-person-heart"></i>

                    <div class="bidang-name">
                        Pemberdayaan
                        <br>
                        Perempuan dan
                        <br>
                        Perlindungan Anak
                    </div>

                    <div class="bidang-progress">

                        <span style="width:90%"></span>

                    </div>

                    <strong>
                        90%
                    </strong>

                </div>



                <div class="bidang-row">

                    <i class="bi bi-people-fill"></i>

                    <div class="bidang-name">
                        Penanganan Penduduk dan
                        <br>
                        Keluarga Berencana
                    </div>

                    <div class="bidang-progress">

                        <span style="width:90%"></span>

                    </div>

                    <strong>
                        90%
                    </strong>

                </div>


            </div>

        </div>



        <!-- =============================================
             LAYANAN UNGGULAN
        ============================================== -->

        <div class="statistik-box unggulan-box">

            <div class="statistik-box-title">

                <h3>
                    Layanan Unggulan
                </h3>

                <span></span>

            </div>


            <div class="unggulan-grid">


                <?php for ($i = 1; $i <= 4; $i++): ?>

                    <div class="unggulan-card">


                        <h4>
                            Nama Program /
                            <br>
                            Layanan
                        </h4>


                        <div class="unggulan-icon">

                            <i class="bi bi-hand-heart"></i>

                        </div>


                        <div class="unggulan-data">


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

    </section>



    <!-- =================================================
         BARIS 3
    ================================================== -->

    <section class="statistik-grid statistik-grid-bottom">


        <!-- =============================================
             PENERIMA MANFAAT
        ============================================== -->

        <div class="statistik-box penerima-box">

            <div class="statistik-box-title">

                <h3>
                    Penerima Manfaat / Masyarakat Terlayani
                </h3>

                <span></span>

            </div>


            <div class="penerima-grid">


                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>
                        1.342
                    </strong>

                    <small>
                        Total Penerima Manfaat
                    </small>

                </div>


                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>
                        1.342
                    </strong>

                    <small>
                        Penyandang Disabilitas
                    </small>

                </div>


                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>
                        1.342
                    </strong>

                    <small>
                        Lansia
                    </small>

                </div>


                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>
                        1.342
                    </strong>

                    <small>
                        Anak
                    </small>

                </div>


                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>
                        1.342
                    </strong>

                    <small>
                        Keluarga Penerima Manfaat
                    </small>

                </div>


            </div>


            <!-- KATEGORI -->

            <div class="kategori-heading">

                Persentase Penerima Manfaat Berdasarkan Kategori

            </div>


            <div class="kategori-content">


                <div class="kategori-chart">

                    <canvas id="kategoriChart"></canvas>

                </div>


                <div class="kategori-legend">


                    <div>

                        <span class="legend-color legend-1"></span>

                        <strong>
                            65%
                        </strong>

                        <small>
                            Keluarga Penerima Manfaat
                        </small>

                    </div>


                    <div>

                        <span class="legend-color legend-2"></span>

                        <strong>
                            35%
                        </strong>

                        <small>
                            Penyandang Disabilitas
                        </small>

                    </div>


                    <div>

                        <span class="legend-color legend-3"></span>

                        <strong>
                            15%
                        </strong>

                        <small>
                            Lansia
                        </small>

                    </div>


                    <div>

                        <span class="legend-color legend-4"></span>

                        <strong>
                            10%
                        </strong>

                        <small>
                            Anak
                        </small>

                    </div>


                    <div>

                        <span class="legend-color legend-5"></span>

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



        <!-- =============================================
             SEBARAN KECAMATAN
        ============================================== -->

        <div class="statistik-box kecamatan-box">

            <div class="statistik-box-title">

                <h3>
                    Sebaran Capaian Per Kecamatan
                </h3>

                <span></span>

            </div>


            <div class="kecamatan-content">


                <!-- MAP -->

                <div class="kecamatan-map">

                    <img
                        src="<?= base_url('assets/img/peta-banyuwangi.png') ?>"
                        alt="Peta Kabupaten Banyuwangi"
                    >

                </div>


                <!-- TOP 5 -->

                <div class="top-kecamatan">

                    <h4>
                        Top 5 Kecamatan
                    </h4>


                    <div class="top-row">

                        <span>1</span>

                        <p>
                            Banyuwangi
                        </p>

                    </div>


                    <div class="top-row">

                        <span>2</span>

                        <p>
                            Rogojampi
                        </p>

                    </div>


                    <div class="top-row">

                        <span>3</span>

                        <p>
                            Kalipuro
                        </p>

                    </div>


                    <div class="top-row">

                        <span>4</span>

                        <p>
                            Giri
                        </p>

                    </div>


                    <div class="top-row">

                        <span>5</span>

                        <p>
                            Glagah
                        </p>

                    </div>


                    <div class="kecamatan-legend">


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

    </section>


</main>



<!-- =====================================================
     FOOTER
====================================================== -->

<?= $this->include('layout/footer') ?>



<!-- =====================================================
     CHART JS
====================================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

/* =====================================================
   GRAFIK TARGET VS REALISASI
===================================================== */

const layananCanvas =
    document.getElementById('layananChart');

new Chart(layananCanvas, {

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



/* =====================================================
   PIE CHART
===================================================== */

const kategoriCanvas =
    document.getElementById('kategoriChart');

new Chart(kategoriCanvas, {

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