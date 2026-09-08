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
                    Tahun <?= esc($tahun) ?>
                </span>

                <i class="bi bi-chevron-down"></i>

            </div><div class="statistik-year">

    <i class="bi bi-calendar3"></i>

    <form method="get" action="<?= current_url() ?>">

        <select
            name="tahun"
            onchange="this.form.submit()"
            aria-label="Pilih Tahun"
        >

            <?php foreach ($tahunTersedia as $tahunItem): ?>

                <option
                    value="<?= esc($tahunItem) ?>"
                    <?= (int) $tahunItem === (int) $tahun
                        ? 'selected'
                        : '' ?>
                >
                    Tahun <?= esc($tahunItem) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </form>

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
    Total Permohonan
</span>

                    </div>

                    <strong>
                        <?= number_format($totalLayanan, 0, ',', '.') ?>
                    </strong>

                </div>


                <div class="layanan-row">

                    <div>

                        <i class="bi bi-check-circle"></i>

                        <span>
    Jumlah Selesai
</span>

                    </div>

                    <strong>
                        <?= number_format($layananSelesai, 0, ',', '.') ?>
                    </strong>

                </div>


                <div class="layanan-row">

                    <div>

                        <i class="bi bi-clock-history"></i>

                        <span>
    Jumlah Proses
</span>

                    </div>

                    <strong>
                        <?= number_format($layananProses, 0, ',', '.') ?>
                    </strong>

                </div>


                <div class="layanan-row">

                    <div>

                        <i class="bi bi-play"></i>

                        <span>
    Belum Selesai
</span>

                    </div>

                    <strong>
                        <?= number_format($layananBelum, 0, ',', '.') ?>
                    </strong>

                </div>


            </div>


            <div class="capaian-box">

                <div>

                    <small>
                        Capaian Keseluruhan
                    </small>

                    <strong>
                        <?= number_format($capaianLayanan, 1, ',', '.') ?>%
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
    Jumlah Permohonan vs Jumlah Selesai
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

                    <?= number_format(
                        $rataIKM,
                        2,
                        ',',
                        '.'
                    ) ?> %

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
                        <?= number_format(
                            $totalRespondenSKM,
                            0,
                            ',',
                            '.'
                        ) ?>
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
                        <?= esc($tahun) ?>
                    </strong>

                    <small>
                        <?= esc($periodeSKM) ?>
                    </small>

                </div>


                <div>

                    <span>
                        Kategori
                    </span>

                    <strong class="survey-good">

                        <?php
                        $mutuParts = explode(
                            ' - ',
                            $mutuSKM,
                            2
                        );
                        ?>

                        <?= esc($mutuParts[1] ?? $mutuSKM) ?>

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


                <?php if (!empty($bidang)): ?>

                    <?php

                    $bidangIcons = [
                        'bi-shield-check',
                        'bi-people',
                        'bi-person-heart',
                        'bi-people-fill'
                    ];

                    ?>

                    <?php foreach ($bidang as $index => $item): ?>

                        <div class="bidang-row">

                            <i class="bi <?= $bidangIcons[$index % count($bidangIcons)] ?>"></i>


                            <div class="bidang-name">

                                <?= esc($item['nama']) ?>

                            </div>


                            <div class="bidang-progress">

                                <span
                                    style="width:<?= min(
                                        100,
                                        max(
                                            0,
                                            (float) $item['capaian']
                                        )
                                    ) ?>%"
                                ></span>

                            </div>


                            <strong>

                                <?= number_format(
                                    $item['capaian'],
                                    1,
                                    ',',
                                    '.'
                                ) ?>%

                            </strong>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="bidang-row">

                        <div class="bidang-name">
                            Belum ada data bidang
                        </div>

                    </div>

                <?php endif; ?>


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


                <?php if (!empty($layananUnggulan)): ?>

                    <?php

                    $unggulanIcons = [
                        'bi-hand-heart',
                        'bi-people',
                        'bi-heart',
                        'bi-person-check'
                    ];

                    ?>

                    <?php foreach ($layananUnggulan as $index => $item): ?>

                        <div class="unggulan-card">


                            <h4>

                                <?= esc($item['nama']) ?>

                            </h4>


                            <div class="unggulan-icon">

                                <i class="bi <?= $unggulanIcons[$index % count($unggulanIcons)] ?>"></i>

                            </div>


                            <div class="unggulan-data">


                                <div>

                                    <strong>

                                        <?= number_format(
                                            $item['capaian'],
                                            1,
                                            ',',
                                            '.'
                                        ) ?>%

                                    </strong>

                                    <small>
                                        Capaian
                                    </small>

                                </div>


                                <div>

                                    <strong>

                                        <?= number_format(
                                            $item['jumlah'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?>

                                    </strong>

                                    <small>
                                        Jumlah
                                        <br>
                                        Permohonan
                                    </small>

                                </div>


                            </div>


                        </div>

                    <?php endforeach; ?>


                <?php else: ?>


                    <?php for ($i = 1; $i <= 4; $i++): ?>

                        <div class="unggulan-card">

                            <h4>
                                Belum ada data
                            </h4>

                            <div class="unggulan-icon">

                                <i class="bi bi-hand-heart"></i>

                            </div>

                            <div class="unggulan-data">

                                <div>

                                    <strong>
                                        0%
                                    </strong>

                                    <small>
                                        Capaian
                                    </small>

                                </div>

                                <div>

                                    <strong>
                                        0
                                    </strong>

                                  <small>
                                    Jumlah
                                    <br>
                                    Permohonan
                                </small>

                                </div>

                            </div>

                        </div>

                    <?php endfor; ?>


                <?php endif; ?>


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


                <!-- TOTAL -->

                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>

                        <?= number_format(
                            $totalPenerima,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </strong>

                    <small>
                        Total Penerima Manfaat
                    </small>

                </div>


                <!-- DISABILITAS -->

                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>

                        <?= number_format(
                            $kategoriPenerima['Penyandang Disabilitas'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </strong>

                    <small>
                        Penyandang Disabilitas
                    </small>

                </div>


                <!-- LANSIA -->

                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>

                        <?= number_format(
                            $kategoriPenerima['Lansia'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </strong>

                    <small>
                        Lansia
                    </small>

                </div>


                <!-- ANAK -->

                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>

                        <?= number_format(
                            $kategoriPenerima['Anak'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </strong>

                    <small>
                        Anak
                    </small>

                </div>


                <!-- KELUARGA -->

                <div class="penerima-card">

                    <i class="bi bi-people"></i>

                    <strong>

                        <?= number_format(
                            $kategoriPenerima['Keluarga Penerima Manfaat'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

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


                    <?php

                    $totalKategori =
                        array_sum($kategoriPenerima);

                    ?>


                    <!-- KELUARGA -->

                    <div>

                        <span class="legend-color legend-1"></span>

                        <strong>

                            <?= $totalKategori > 0
                                ? number_format(
                                    (
                                        ($kategoriPenerima['Keluarga Penerima Manfaat'] ?? 0)
                                        / $totalKategori
                                    ) * 100,
                                    1,
                                    ',',
                                    '.'
                                )
                                : '0'
                            ?>%

                        </strong>

                        <small>
                            Keluarga Penerima Manfaat
                        </small>

                    </div>


                    <!-- DISABILITAS -->

                    <div>

                        <span class="legend-color legend-2"></span>

                        <strong>

                            <?= $totalKategori > 0
                                ? number_format(
                                    (
                                        ($kategoriPenerima['Penyandang Disabilitas'] ?? 0)
                                        / $totalKategori
                                    ) * 100,
                                    1,
                                    ',',
                                    '.'
                                )
                                : '0'
                            ?>%

                        </strong>

                        <small>
                            Penyandang Disabilitas
                        </small>

                    </div>


                    <!-- LANSIA -->

                    <div>

                        <span class="legend-color legend-3"></span>

                        <strong>

                            <?= $totalKategori > 0
                                ? number_format(
                                    (
                                        ($kategoriPenerima['Lansia'] ?? 0)
                                        / $totalKategori
                                    ) * 100,
                                    1,
                                    ',',
                                    '.'
                                )
                                : '0'
                            ?>%

                        </strong>

                        <small>
                            Lansia
                        </small>

                    </div>


                    <!-- ANAK -->

                    <div>

                        <span class="legend-color legend-4"></span>

                        <strong>

                            <?= $totalKategori > 0
                                ? number_format(
                                    (
                                        ($kategoriPenerima['Anak'] ?? 0)
                                        / $totalKategori
                                    ) * 100,
                                    1,
                                    ',',
                                    '.'
                                )
                                : '0'
                            ?>%

                        </strong>

                        <small>
                            Anak
                        </small>

                    </div>


                    <!-- LAINNYA -->

                    <div>

                        <span class="legend-color legend-5"></span>

                        <strong>

                            <?= $totalKategori > 0
                                ? number_format(
                                    (
                                        ($kategoriPenerima['Lainnya'] ?? 0)
                                        / $totalKategori
                                    ) * 100,
                                    1,
                                    ',',
                                    '.'
                                )
                                : '0'
                            ?>%

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


                    <?php if (!empty($topKecamatan)): ?>

                        <?php foreach ($topKecamatan as $index => $item): ?>

                            <div class="top-row">

                                <span>
                                    <?= $index + 1 ?>
                                </span>

                                <p>
                                    <?= esc($item['nama']) ?>
                                </p>

                            </div>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <?php for ($i = 1; $i <= 5; $i++): ?>

                            <div class="top-row">

                                <span>
                                    <?= $i ?>
                                </span>

                                <p>
                                    Belum ada data
                                </p>

                            </div>

                        <?php endfor; ?>

                    <?php endif; ?>



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
   DATA DARI PHP
===================================================== */

const grafikTahun =
    <?= json_encode(
        $grafikTahun ?? [],
        JSON_UNESCAPED_UNICODE
    ) ?>;


const kategoriPenerima =
    <?= json_encode(
        $kategoriPenerima ?? [],
        JSON_UNESCAPED_UNICODE
    ) ?>;



/* =====================================================
   GRAFIK JUMLAH PERMOHONAN VS JUMLAH SELESAI
===================================================== */

const layananCanvas =
    document.getElementById('layananChart');

if (layananCanvas) {

    new Chart(layananCanvas, {

        type: 'bar',

        data: {

            labels: grafikTahun.map(
                item => item.tahun
            ),

            datasets: [

                {
                    label: 'Jumlah Permohonan',

                    data: grafikTahun.map(
                        item => item.permohonan
                    ),

                    backgroundColor: '#650719',

                    borderRadius: 5,

                    barThickness: 16
                },

                {
                    label: 'Jumlah Selesai',

                    data: grafikTahun.map(
                        item => item.selesai
                    ),

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
                    display: true
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

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

}



/* =====================================================
   PIE CHART
===================================================== */

const kategoriCanvas =
    document.getElementById('kategoriChart');


if (kategoriCanvas) {


    const kategoriLabels = [

        'Keluarga Penerima Manfaat',

        'Penyandang Disabilitas',

        'Lansia',

        'Anak',

        'Lainnya'

    ];


    const kategoriValues = [

        Number(
            kategoriPenerima[
                'Keluarga Penerima Manfaat'
            ] ?? 0
        ),

        Number(
            kategoriPenerima[
                'Penyandang Disabilitas'
            ] ?? 0
        ),

        Number(
            kategoriPenerima[
                'Lansia'
            ] ?? 0
        ),

        Number(
            kategoriPenerima[
                'Anak'
            ] ?? 0
        ),

        Number(
            kategoriPenerima[
                'Lainnya'
            ] ?? 0
        )

    ];


    new Chart(kategoriCanvas, {

        type: 'pie',


        data: {

            labels: kategoriLabels,


            datasets: [

                {

                    data: kategoriValues,

                    backgroundColor: [

                        '#650719',

                        '#a50e28',

                        '#e83152',

                        '#f08da0',

                        '#f7cbd2'

                    ],

                    borderWidth: 0

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

            }

        }

    });

}

</script>