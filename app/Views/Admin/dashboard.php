<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css') ?>">

<div class="d-flex min-vh-100 dashboard-page">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

        <section class="dashboard-content">

            <!-- =====================================================
                 HEADER
            ====================================================== -->
            <div class="dashboard-header">
                <h1>Selamat datang, Dinsos</h1>
                <p>Kelola seluruh layanan</p>
            </div>

            <!-- =====================================================
                 TOP CARDS
            ====================================================== -->
            <div class="dashboard-cards">

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Layanan</h3>
                        <p>Kelola Data Layanan</p>
                        <a href="<?= base_url('admin/layanan') ?>" class="detail-button">Detail →</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Bidang</h3>
                        <p>Kelola Data Bidang</p>
                        <a href="<?= base_url('admin/bidang') ?>" class="detail-button">Detail →</a>
                    </div>
                </div>

                <div class="stat-card stat-number">
                    <div class="stat-info">
                        <h3>Total Berita</h3>
                        <strong><?= number_format((int) ($totalBerita ?? 0), 0, ',', '.') ?></strong>
                        <p>Keseluruhan Postingan</p>
                    </div>
                </div>

                <div class="stat-card stat-number">
                    <div class="stat-info">
                        <h3>Total Kegiatan</h3>
                        <strong><?= number_format((int) ($totalKegiatan ?? 0), 0, ',', '.') ?></strong>
                        <p>Keseluruhan Kegiatan</p>
                    </div>
                </div>

                <div class="stat-card stat-number">
                    <div class="stat-info">
                        <h3>Total Postingan</h3>
                        <strong><?= number_format((int) ($totalInstagram ?? 32), 0, ',', '.') ?></strong>
                        <p>Keseluruhan Postingan</p>
                    </div>
                </div>

            </div>

            <!-- =====================================================
                 STATISTIK UTAMA
            ====================================================== -->
            <div class="dashboard-middle">

                <!-- CAPAIAN -->
                <div class="dashboard-panel capaian-panel">

                    <div class="panel-heading-row">
                        <div>
                            <h2 class="panel-title">Capaian Layanan Dinas</h2>
                            <span class="panel-year"><?= esc($tahunStatistik ?? date('Y')) ?></span>
                        </div>
                    </div>

                    <div class="layanan-stat-list">

                        <div class="layanan-stat-item">
                            <div class="layanan-stat-label">
                                <i class="bi bi-file-earmark"></i>
                                <span>Jumlah Permohonan</span>
                            </div>
                            <strong><?= number_format((int) ($totalPermohonan ?? 0), 0, ',', '.') ?></strong>
                        </div>

                        <div class="layanan-stat-item">
                            <div class="layanan-stat-label">
                                <i class="bi bi-check-circle"></i>
                                <span>Jumlah Selesai</span>
                            </div>
                            <strong><?= number_format((int) ($totalSelesai ?? 0), 0, ',', '.') ?></strong>
                        </div>

                        <div class="layanan-stat-item">
                            <div class="layanan-stat-label">
                                <i class="bi bi-clock-history"></i>
                                <span>Jumlah Proses</span>
                            </div>
                            <strong><?= number_format((int) ($totalProses ?? 0), 0, ',', '.') ?></strong>
                        </div>

                        <div class="layanan-stat-item">
                            <div class="layanan-stat-label">
                                <i class="bi bi-hourglass-split"></i>
                                <span>Belum Selesai</span>
                            </div>
                            <strong><?= number_format((int) ($belumSelesai ?? 0), 0, ',', '.') ?></strong>
                        </div>

                    </div>

                    <div class="capaian-total">
                        <div>
                            <small>Capaian Keseluruhan</small>
                            <strong><?= number_format((float) ($capaianKeseluruhan ?? 0), 2, ',', '.') ?>%</strong>
                        </div>
                        <i class="bi bi-check2-square"></i>
                    </div>

                </div>

                <!-- GRAFIK -->
                <div class="dashboard-panel chart-panel">

                    <h2 class="panel-title">Jumlah Permohonan vs Jumlah Selesai</h2>

                    <div class="chart-area">
                        <?php
                        $grafik = $grafikBulan ?? [];
                        $chartMaxValue = max(1, (int) ($chartMax ?? 0));
                        ?>

                        <?php foreach ($grafik as $item): ?>
                            <?php
                            $permohonan = (int) ($item['permohonan'] ?? 0);
                            $selesai    = (int) ($item['selesai'] ?? 0);

                            $tinggiPermohonan = max(
                                2,
                                round(($permohonan / $chartMaxValue) * 100, 2)
                            );

                            $tinggiSelesai = max(
                                2,
                                round(($selesai / $chartMaxValue) * 100, 2)
                            );
                            ?>

                            <div class="chart-group">
                                <div class="chart-bars">
                                    <div
                                        class="chart-bar chart-bar-dark"
                                        style="height: <?= $tinggiPermohonan ?>%;"
                                        title="Jumlah Permohonan: <?= number_format($permohonan, 0, ',', '.') ?>"
                                    ></div>

                                    <div
                                        class="chart-bar chart-bar-light"
                                        style="height: <?= $tinggiSelesai ?>%;"
                                        title="Jumlah Selesai: <?= number_format($selesai, 0, ',', '.') ?>"
                                    ></div>
                                </div>

                                <span class="chart-label">
                                    <?= esc($item['bulan'] ?? '-') ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="chart-legend">
                        <span>
                            <i class="legend-box legend-dark"></i>
                            Jumlah Permohonan
                        </span>
                        <span>
                            <i class="legend-box legend-light"></i>
                            Jumlah Selesai
                        </span>
                    </div>

                </div>

            </div>

            <!-- =====================================================
                 BOTTOM
            ====================================================== -->
            <div class="dashboard-bottom">

                <!-- KEGIATAN -->
                <div class="latest-panel">
                    <div class="latest-header">
                        <h3>Kegiatan Terbaru</h3>
                        <a href="<?= base_url('admin/kegiatan') ?>" class="detail-button">Detail →</a>
                    </div>

                    <?php if (!empty($kegiatanTerbaru)): ?>
                        <?php foreach ($kegiatanTerbaru as $index => $item): ?>
                            <?php
                            $thumbnail = trim((string) ($item['thumbnail'] ?? ''));
                            $thumbnailUrl = $thumbnail !== ''
                                ? base_url('uploads/kegiatan/thumbnail/' . $thumbnail)
                                : '';
                            ?>

                            <div class="latest-item">
                                <div class="latest-number"><?= $index + 1 ?>.</div>

                                <?php if ($thumbnailUrl !== ''): ?>
                                    <div
                                        class="latest-image has-image"
                                        style="background-image:url('<?= esc($thumbnailUrl, 'attr') ?>');"
                                    ></div>
                                <?php else: ?>
                                    <div class="latest-image"></div>
                                <?php endif; ?>

                                <div class="latest-info">
                                    <strong><?= esc($item['judul'] ?? 'Judul Kegiatan') ?></strong>
                                    <span>
                                        <?= esc(
                                            mb_strimwidth(
                                                trim(strip_tags((string) ($item['deskripsi'] ?? ''))),
                                                0,
                                                55,
                                                '...'
                                            )
                                        ) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="latest-empty">Belum ada data kegiatan.</div>
                    <?php endif; ?>
                </div>

                <!-- BERITA -->
                <div class="latest-panel">
                    <div class="latest-header">
                        <h3>Berita Terbaru</h3>
                        <a href="<?= base_url('admin/berita') ?>" class="detail-button">Detail →</a>
                    </div>

                    <?php if (!empty($beritaTerbaru)): ?>
                        <?php foreach ($beritaTerbaru as $index => $item): ?>
                            <?php
                            $gambar = trim((string) ($item['gambar'] ?? ''));
                            $gambarUrl = $gambar !== ''
                                ? base_url('uploads/berita/' . $gambar)
                                : '';
                            ?>

                            <div class="latest-item">
                                <div class="latest-number"><?= $index + 1 ?>.</div>

                                <?php if ($gambarUrl !== ''): ?>
                                    <div
                                        class="latest-image has-image"
                                        style="background-image:url('<?= esc($gambarUrl, 'attr') ?>');"
                                    ></div>
                                <?php else: ?>
                                    <div class="latest-image"></div>
                                <?php endif; ?>

                                <div class="latest-info">
                                    <strong><?= esc($item['judul'] ?? 'Judul Berita') ?></strong>
                                    <span>
                                        <?= esc(
                                            mb_strimwidth(
                                                trim(strip_tags((string) ($item['isi'] ?? ''))),
                                                0,
                                                55,
                                                '...'
                                            )
                                        ) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="latest-empty">Belum ada data berita.</div>
                    <?php endif; ?>
                </div>

                <!-- INSTAGRAM -->
                <div class="latest-panel">
                    <div class="latest-header">
                        <h3>Postingan Terbaru</h3>
                        <a href="<?= base_url('admin/instagram') ?>" class="detail-button">Detail →</a>
                    </div>

                    <?php foreach (($instagramTerbaru ?? []) as $index => $item): ?>
                        <div class="latest-item">
                            <div class="latest-number"><?= $index + 1 ?>.</div>
                            <div class="latest-image"></div>

                            <div class="latest-info">
                                <strong><?= esc($item['judul'] ?? 'Caption Instagram') ?></strong>
                                <span><?= esc($item['deskripsi'] ?? 'Postingan terbaru ...') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

        </section>

    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
