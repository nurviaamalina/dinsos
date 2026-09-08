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

            <form
    method="get"
    action="<?= current_url() ?>"
    class="statistik-year"
>
    <i class="bi bi-calendar3"></i>

    <select
        name="tahun"
        onchange="this.form.submit()"
        aria-label="Pilih tahun statistik"
    >
        <?php foreach (($tahunTersedia ?? []) as $tahunItem): ?>

            <option
                value="<?= esc($tahunItem) ?>"
                <?= (int) $tahunItem === (int) ($tahun ?? date('Y'))
                    ? 'selected'
                    : '' ?>
            >
                Tahun <?= esc($tahunItem) ?>
            </option>

        <?php endforeach; ?>
    </select>

    <i class="bi bi-chevron-down"></i>
</form>

        </div>

    </div>

</section>



<!-- =====================================================
     MAIN STATISTIK
====================================================== -->

<main class="statistik-main">
<!-- =====================================================
             ROW 1
        ====================================================== -->
        <div class="statistik-grid statistik-grid-top">

            <!-- CAPAIAN LAYANAN -->
            <div class="statistik-card">

                <div class="statistik-card-title">
                    <h5>Capaian Layanan Dinas</h5>
                </div>

                <div class="layanan-stat-list">

                    <div class="layanan-stat-item">
                        <div>
                            <i class="bi bi-file-earmark"></i>
                            <span>Jumlah Permohonan</span>
                        </div>

                        <strong>
                            <?= number_format(
                                $totalLayanan ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>
                    </div>

                    <div class="layanan-stat-item">
                        <div>
                            <i class="bi bi-check-circle"></i>
                            <span>Jumlah Selesai</span>
                        </div>

                        <strong>
                            <?= number_format(
                                $layananSelesai ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>
                    </div>

                    <div class="layanan-stat-item">
                        <div>
                            <i class="bi bi-clock-history"></i>
                            <span>Jumlah Proses</span>
                        </div>

                        <strong>
                            <?= number_format(
                                $layananProses ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>
                    </div>

                    <div class="layanan-stat-item">
                        <div>
                            <i class="bi bi-hourglass-split"></i>
                            <span>Belum Selesai</span>
                        </div>

                        <strong>
                            <?= number_format(
                                $layananBelum ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>
                    </div>

                </div>

                <div class="capaian-overall">

                    <div>
                        <small>Capaian Keseluruhan</small>

                        <strong>
                            <?= number_format(
                                $capaianLayanan ?? 0,
                                2,
                                ',',
                                '.'
                            ) ?>%
                        </strong>
                    </div>

                    <i class="bi bi-check2-square"></i>

                </div>

            </div>


            <!-- GRAFIK BULANAN -->
            <div class="statistik-card">

                <div class="statistik-card-title">
                    <h5>
                        Jumlah Permohonan vs Jumlah Selesai
                    </h5>
                </div>

                <div class="statistik-chart">
                    <canvas id="layananChart"></canvas>
                </div>

            </div>


            <!-- SKM -->
            <div class="statistik-card survey-card">

                <div class="statistik-card-title">
                    <h5>Hasil Survei Kepuasan Masyarakat</h5>
                </div>

                <div class="survey-score">

                    <i class="bi bi-star"></i>

                    <strong>
                        <?= number_format(
                            $rataIKM ?? 0,
                            2,
                            ',',
                            '.'
                        ) ?> %
                    </strong>

                </div>

                <p class="survey-label">
                    Indeks Kepuasan Masyarakat
                </p>

                <div class="survey-info">

                    <div>
                        <span>Responden</span>

                        <strong>
                            <?= number_format(
                                $totalRespondenSKM ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Orang</small>
                    </div>

                    <div>
                        <span>Periode</span>

                        <strong>
                            <?= esc($tahun ?? '-') ?>
                        </strong>

                        <small>
                            <?= esc($periodeSKM ?? '-') ?>
                        </small>
                    </div>

                    <div>
                        <span>Kategori</span>

                        <?php
                        $mutuParts = explode(
                            ' - ',
                            $mutuSKM ?? '-',
                            2
                        );
                        ?>

                        <strong class="survey-good">
                            <?= esc(
                                $mutuParts[1]
                                ?? ($mutuSKM ?? '-')
                            ) ?>
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             ROW 2
        ====================================================== -->
        <div class="statistik-grid statistik-grid-middle">

            <!-- BIDANG -->
            <div class="statistik-card bidang-stat-card">

                <div class="statistik-card-title">
                    <h5>Capaian Per Bidang</h5>
                </div>

                <div class="bidang-stat-list">

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

                            <div class="bidang-stat-item">

                                <i class="bi <?= $bidangIcons[
                                    $index % count($bidangIcons)
                                ] ?>"></i>

                                <div class="bidang-name">
                                    <?= esc(
                                        $item['nama'] ?? '-'
                                    ) ?>
                                </div>

                                <div class="bidang-progress">
                                    <span
                                        style="width:<?= min(
                                            100,
                                            max(
                                                0,
                                                (float) (
                                                    $item['capaian'] ?? 0
                                                )
                                            )
                                        ) ?>%;"
                                    ></span>
                                </div>

                                <strong>
                                    <?= number_format(
                                        $item['capaian'] ?? 0,
                                        2,
                                        ',',
                                        '.'
                                    ) ?>%
                                </strong>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="kecamatan-empty">
                            Belum ada data bidang
                            untuk tahun <?= esc($tahun ?? '-') ?>.
                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- LAYANAN UNGGULAN -->
            <div class="statistik-card">

                <div class="statistik-card-title">
                    <h5>Layanan Unggulan</h5>
                </div>

                <div class="layanan-unggulan-grid">

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

                            <div class="layanan-unggulan-item">

                                <h6>
                                    <?= esc(
                                        $item['nama'] ?? '-'
                                    ) ?>
                                </h6>

                                <div class="unggulan-icon">
                                    <i class="bi <?= $unggulanIcons[
                                        $index % count($unggulanIcons)
                                    ] ?>"></i>
                                </div>

                                <div class="unggulan-bottom">

                                    <div>
                                        <strong>
                                            <?= number_format(
                                                $item['capaian'] ?? 0,
                                                2,
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
                                                $item['jumlah'] ?? 0,
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

                            <div class="layanan-unggulan-item">

                                <h6>
                                    Belum ada data
                                </h6>

                                <div class="unggulan-icon">
                                    <i class="bi bi-hand-heart"></i>
                                </div>

                                <div class="unggulan-bottom">

                                    <div>
                                        <strong>0%</strong>
                                        <small>Capaian</small>
                                    </div>

                                    <div>
                                        <strong>0</strong>
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

        </div>


        <!-- =====================================================
             ROW 3
        ====================================================== -->
        <div class="statistik-grid statistik-grid-bottom">

            <!-- PENERIMA MANFAAT -->
            <div class="statistik-card penerima-card">

                <div class="statistik-card-title">
                    <h5>
                        Penerima Manfaat /
                        Masyarakat Terlayani
                    </h5>
                </div>

                <div class="penerima-grid">

                    <div class="penerima-item">
                        <i class="bi bi-people"></i>

                        <strong>
                            <?= number_format(
                                $totalPenerima ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Total Penerima Manfaat</small>
                    </div>

                    <div class="penerima-item">
                        <i class="bi bi-people"></i>

                        <strong>
                            <?= number_format(
                                $kategoriPenerima[
                                    'Penyandang Disabilitas'
                                ] ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Penyandang Disabilitas</small>
                    </div>

                    <div class="penerima-item">
                        <i class="bi bi-people"></i>

                        <strong>
                            <?= number_format(
                                $kategoriPenerima['Lansia'] ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Lansia</small>
                    </div>

                    <div class="penerima-item">
                        <i class="bi bi-people"></i>

                        <strong>
                            <?= number_format(
                                $kategoriPenerima['Anak'] ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Anak</small>
                    </div>

                    <div class="penerima-item">
                        <i class="bi bi-people"></i>

                        <strong>
                            <?= number_format(
                                $kategoriPenerima[
                                    'Keluarga Penerima Manfaat'
                                ] ?? 0,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </strong>

                        <small>Keluarga Penerima Manfaat</small>
                    </div>

                </div>

                <div class="kategori-title">
                    Persentase Penerima Manfaat
                    Berdasarkan Kategori
                </div>

                <div class="kategori-wrapper">

                    <div class="kategori-chart">
                        <canvas id="kategoriChart"></canvas>
                    </div>

                    <div class="kategori-legend">

                        <?php
                        $totalKategori = array_sum(
                            $kategoriPenerima ?? []
                        );

                        $kategoriLegend = [
                            [
                                'key'   => 'Keluarga Penerima Manfaat',
                                'class' => 'legend-1',
                                'label' => 'Keluarga Penerima Manfaat',
                            ],
                            [
                                'key'   => 'Penyandang Disabilitas',
                                'class' => 'legend-2',
                                'label' => 'Penyandang Disabilitas',
                            ],
                            [
                                'key'   => 'Lansia',
                                'class' => 'legend-3',
                                'label' => 'Lansia',
                            ],
                            [
                                'key'   => 'Anak',
                                'class' => 'legend-4',
                                'label' => 'Anak',
                            ],
                            [
                                'key'   => 'Lainnya',
                                'class' => 'legend-5',
                                'label' => 'Lainnya',
                            ],
                        ];
                        ?>

                        <?php foreach ($kategoriLegend as $legend): ?>

                            <?php
                            $nilaiKategori =
                                (int) (
                                    $kategoriPenerima[
                                        $legend['key']
                                    ] ?? 0
                                );

                            $persentaseKategori =
                                $totalKategori > 0
                                    ? (
                                        $nilaiKategori
                                        / $totalKategori
                                    ) * 100
                                    : 0;
                            ?>

                            <div>
                                <span
                                    class="legend <?= esc(
                                        $legend['class']
                                    ) ?>"
                                ></span>

                                <strong>
                                    <?= number_format(
                                        $persentaseKategori,
                                        1,
                                        ',',
                                        '.'
                                    ) ?>%
                                </strong>

                                <small>
                                    <?= esc(
                                        $legend['label']
                                    ) ?>
                                </small>
                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>


            <!-- TOP 5 KECAMATAN - TANPA MAP -->
            <div class="statistik-card kecamatan-card">

                <div class="statistik-card-title">
                    <h5>Top 5 Kecamatan</h5>
                </div>

                <div class="kecamatan-wrapper kecamatan-list-only">

                    <div class="top-kecamatan">

                        <?php if (!empty($topKecamatan)): ?>

                            <?php foreach (
                                $topKecamatan
                                as $index => $item
                            ): ?>

                                <div class="top-item">

                                    <span>
                                        <?= $index + 1 ?>
                                    </span>

                                    <div>
                                        <p>
                                            <?= esc(
                                                $item['nama'] ?? '-'
                                            ) ?>
                                        </p>

                                        <small>
                                            <?= number_format(
                                                $item['jumlah'] ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            ) ?>
                                            permohonan
                                            •
                                            <?= number_format(
                                                $item['selesai'] ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            ) ?>
                                            selesai
                                        </small>
                                    </div>

                                    <strong>
                                        <?= number_format(
                                            $item['capaian'] ?? 0,
                                            2,
                                            ',',
                                            '.'
                                        ) ?>%
                                    </strong>

                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="kecamatan-empty">
                                Belum ada data kecamatan
                                untuk tahun <?= esc($tahun ?? '-') ?>.
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>
</main>



<!-- =====================================================
     FOOTER
====================================================== -->

<?= $this->include('layout/footer') ?>



<!-- =========================================================
     CHART JS
========================================================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const grafikBulan = <?= json_encode(
        $grafikBulan ?? [],
        JSON_UNESCAPED_UNICODE
    ) ?>;

    const kategoriPenerima = <?= json_encode(
        $kategoriPenerima ?? [],
        JSON_UNESCAPED_UNICODE
    ) ?>;


    /* =========================================================
       GRAFIK BULANAN
    ========================================================= */
    const layananChart =
        document.getElementById('layananChart');

    if (layananChart) {

        const bulanLabels = grafikBulan.map(
            item => item.bulan
        );

        const dataPermohonan = grafikBulan.map(
            item => Number(item.permohonan || 0)
        );

        const dataSelesai = grafikBulan.map(
            item => Number(item.selesai || 0)
        );

        new Chart(
            layananChart,
            {
                type: 'bar',

                data: {
                    labels: bulanLabels,

                    datasets: [
                        {
                            label: 'Jumlah Permohonan',

                            data: dataPermohonan,

                            backgroundColor: '#650719',

                            borderRadius: 5,

                            barThickness: 12
                        },

                        {
                            label: 'Jumlah Selesai',

                            data: dataSelesai,

                            backgroundColor: '#f3a0ae',

                            borderRadius: 5,

                            barThickness: 12
                        }
                    ]
                },

                options: {
                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },

                        tooltip: {
                            callbacks: {
                                label: function(context) {

                                    return context.dataset.label
                                        + ': '
                                        + new Intl.NumberFormat(
                                            'id-ID'
                                        ).format(
                                            context.raw
                                        );
                                }
                            }
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,

                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat(
                                        'id-ID'
                                    ).format(value);
                                }
                            },

                            grid: {
                                display: false
                            }
                        },

                        x: {
                            grid: {
                                display: false
                            },

                            ticks: {
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    }
                }
            }
        );
    }


    /* =========================================================
       PIE CHART PENERIMA MANFAAT
    ========================================================= */
    const kategoriChart =
        document.getElementById('kategoriChart');

    if (kategoriChart) {

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
                ] || 0
            ),

            Number(
                kategoriPenerima[
                    'Penyandang Disabilitas'
                ] || 0
            ),

            Number(
                kategoriPenerima['Lansia'] || 0
            ),

            Number(
                kategoriPenerima['Anak'] || 0
            ),

            Number(
                kategoriPenerima['Lainnya'] || 0
            )
        ];

        new Chart(
            kategoriChart,
            {
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
            }
        );
    }
</script>