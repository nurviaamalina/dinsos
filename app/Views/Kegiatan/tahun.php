<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatan.css') ?>"
>


<section class="kegiatan-page">

    <div class="container">


        <!-- =================================================
             BREADCRUMB
        ================================================== -->

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('kegiatan') ?>">
                        Kegiatan
                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Tahun <?= esc($tahun) ?>

                </li>

            </ol>

        </nav>


        <!-- =================================================
             JUDUL
        ================================================== -->

        <div class="kegiatan-recap-header">

            <h1>
                Recap Kegiatan Dinas
            </h1>

            <strong>
                Tahun <?= esc($tahun) ?>
            </strong>

            <span></span>

            <p>
                Rangkuman Kegiatan Dinas Selama Tahun
                <?= esc($tahun) ?>
            </p>

        </div>


        <!-- =================================================
             DAFTAR KEGIATAN
        ================================================== -->

        <?php if (!empty($kegiatan)): ?>

            <div class="kegiatan-grid">

                <?php foreach ($kegiatan as $item): ?>

                    <a
                        href="<?= base_url(
                            'kegiatan/' . $item['slug']
                        ) ?>"
                        class="kegiatan-card"
                    >

                        <div class="kegiatan-card-image">

                            <img
                                src="<?= base_url(
                                    'uploads/kegiatan/thumbnail/' .
                                    $item['thumbnail']
                                ) ?>"
                                alt="<?= esc($item['judul']) ?>"
                            >

                        </div>


                        <div class="kegiatan-card-content">

                            <span class="kegiatan-card-date">

                                <?= date(
                                    'd F Y',
                                    strtotime($item['tanggal'])
                                ) ?>

                            </span>


                            <h2>

                                <?= esc($item['judul']) ?>

                            </h2>


                            <span class="kegiatan-card-link">

                                Lihat Detail

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </div>

                    </a>

                <?php endforeach; ?>

            </div>


            <!-- PAGINATION -->

            <?php if (isset($pager)): ?>

                <div class="kegiatan-pagination">

                    <?php
                    $currentPage = $pager->getCurrentPage();
                    $lastPage = $pager->getLastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                    ?>

                    <ul class="pagination">
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a
                                class="page-link"
                                href="<?= $currentPage > 1
                                    ? base_url('kegiatan/tahun/' . $tahun . '?page=' . ($currentPage - 1))
                                    : '#' ?>"
                            >
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        <?php for ($page = $start; $page <= $end; $page++): ?>
                            <li class="page-item <?= $page === $currentPage ? 'active' : '' ?>">
                                <a
                                    class="page-link"
                                    href="<?= base_url('kegiatan/tahun/' . $tahun . '?page=' . $page) ?>"
                                >
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage >= $lastPage ? 'disabled' : '' ?>">
                            <a
                                class="page-link"
                                href="<?= $currentPage < $lastPage
                                    ? base_url('kegiatan/tahun/' . $tahun . '?page=' . ($currentPage + 1))
                                    : '#' ?>"
                            >
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>

                </div>

            <?php endif; ?>


        <?php else: ?>

            <div class="kegiatan-kosong">

                <h4>
                    Belum ada kegiatan pada tahun
                    <?= esc($tahun) ?>.
                </h4>

                <a
                    href="<?= base_url('kegiatan') ?>"
                    class="btn-kembali-kegiatan"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>

        <?php endif; ?>


    </div>

</section>


<?= $this->include('layout/footer') ?>