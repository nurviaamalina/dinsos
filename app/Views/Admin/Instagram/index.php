<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/instagram.css') ?>"
>


<div class="d-flex">


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <?= $this->include('admin/layout/sidebar') ?>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="content flex-grow-1 p-4 bg-light">


        <div class="instagram-page">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="instagram-header">


                <!-- JUDUL + SUBJUDUL -->

                <div class="instagram-header-text">

                    <h1>

                        <i class="bi bi-instagram"></i>

                        Instagram

                    </h1>


                    <p>
                        Daftar posting Instagram yang telah disinkronisasi.
                    </p>

                </div>


                <!-- =================================================
                     TOMBOL SINKRONISASI
                ================================================== -->

                <div class="instagram-header-buttons">

                    <a
                        href="<?= base_url('admin/instagram/sync') ?>"
                        class="btn-sync-instagram"
                    >

                        <i class="bi bi-arrow-repeat"></i>

                        Sinkronkan Instagram

                    </a>

                </div>


            </div>


            <!-- =====================================================
                 FLASH SUCCESS
            ====================================================== -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success instagram-alert">

                    <?= esc(session()->getFlashdata('success')) ?>

                </div>

            <?php endif; ?>


            <!-- =====================================================
                 FLASH ERROR
            ====================================================== -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger instagram-alert">

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            <?php endif; ?>


            <!-- =====================================================
                 TABLE
            ====================================================== -->

            <div class="instagram-table-card">


                <table class="instagram-table">


                    <!-- =================================================
                         HEADER TABLE
                    ================================================== -->

                    <thead>

                        <tr>

                            <th class="thumbnail-column">
                                Thumbnail
                            </th>

                            <th class="caption-column">
                                Caption
                            </th>

                            <th class="jenis-column">
                                Jenis
                            </th>

                            <th class="tanggal-column">
                                Tanggal
                            </th>

                            <th class="instagram-column">
                                Instagram
                            </th>

                        </tr>

                    </thead>


                    <!-- =================================================
                         BODY TABLE
                    ================================================== -->

                    <tbody>


                        <?php if (!empty($instagram)) : ?>


                            <?php foreach ($instagram as $post) : ?>


                                <?php

                                /*
                                |--------------------------------------------------------------------------
                                | THUMBNAIL
                                |--------------------------------------------------------------------------
                                */

                                $thumbnailUrl = null;


                                if (!empty($post['thumbnail'])) {

                                    $thumbnailUrl = base_url(
                                        'uploads/instagram/' .
                                        $post['thumbnail']
                                    );

                                } elseif (!empty($post['thumbnail_url'])) {

                                    $thumbnailUrl = $post['thumbnail_url'];

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | MEDIA TYPE
                                |--------------------------------------------------------------------------
                                */

                                $mediaType = strtoupper(
                                    $post['media_type'] ?? 'IMAGE'
                                );


                                switch ($mediaType) {

                                    case 'VIDEO':

                                        $mediaLabel = 'Reels / Video';

                                        break;


                                    case 'CAROUSEL_ALBUM':

                                        $mediaLabel = 'Carousel';

                                        break;


                                    case 'IMAGE':

                                    default:

                                        $mediaLabel = 'Foto';

                                        break;

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | TANGGAL
                                |--------------------------------------------------------------------------
                                */

                                $tanggal = $post['posted_at']
                                    ?? $post['tanggal_post']
                                    ?? null;

                                ?>


                                <tr>


                                    <!-- =====================================
                                         THUMBNAIL
                                    ====================================== -->

                                    <td>

                                        <?php if (!empty($thumbnailUrl)) : ?>

                                            <img
                                                src="<?= esc($thumbnailUrl) ?>"
                                                alt="Instagram"
                                                class="instagram-thumbnail"
                                                loading="lazy"
                                            >

                                        <?php else : ?>

                                            <div class="instagram-thumbnail-empty">

                                                <i class="bi bi-image"></i>

                                            </div>

                                        <?php endif; ?>

                                    </td>


                                    <!-- =====================================
                                         CAPTION
                                    ====================================== -->

                                    <td>

                                        <span
                                            class="instagram-caption"
                                            title="<?= esc($post['caption'] ?? '') ?>"
                                        >

                                            <?= esc(
                                                !empty($post['caption'])
                                                    ? $post['caption']
                                                    : '-'
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- =====================================
                                         JENIS
                                    ====================================== -->

                                    <td>

                                        <span class="instagram-type">

                                            <?= esc($mediaLabel) ?>

                                        </span>

                                    </td>


                                    <!-- =====================================
                                         TANGGAL
                                    ====================================== -->

                                    <td>

                                        <?php if (!empty($tanggal)) : ?>

                                            <div class="instagram-date">

                                                <?= date(
                                                    'd M Y',
                                                    strtotime($tanggal)
                                                ) ?>

                                                <br>

                                                <?= date(
                                                    'H:i',
                                                    strtotime($tanggal)
                                                ) ?>

                                            </div>

                                        <?php else : ?>

                                            -

                                        <?php endif; ?>

                                    </td>


                                    <!-- =====================================
                                         LINK INSTAGRAM
                                    ====================================== -->

                                    <td>

                                        <?php if (!empty($post['permalink'])) : ?>

                                            <a
                                                href="<?= esc($post['permalink']) ?>"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn-lihat-instagram"
                                            >

                                                <i class="bi bi-instagram"></i>

                                                Lihat

                                            </a>

                                        <?php else : ?>

                                            -

                                        <?php endif; ?>

                                    </td>


                                </tr>


                            <?php endforeach; ?>


                        <?php else : ?>


                            <!-- =========================================
                                 DATA KOSONG
                            ========================================== -->

                            <tr>

                                <td
                                    colspan="5"
                                    class="instagram-empty"
                                >

                                    Belum ada posting Instagram.

                                </td>

                            </tr>


                        <?php endif; ?>


                    </tbody>


                </table>


            </div>


            <!-- =====================================================
                 PAGINATION
            ====================================================== -->

            <?php if (isset($pager) && $pager->getPageCount() > 1) : ?>

                <div class="instagram-pagination">

                    <?php
                    $currentPage = $pager->getCurrentPage();
                    $lastPage = $pager->getLastPage();
                    $keywordQuery = !empty($keyword)
                        ? '&' . http_build_query(['keyword' => $keyword])
                        : '';
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                    ?>

                    <ul class="pagination">
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a
                                class="pagination-item"
                                href="<?= $currentPage > 1
                                    ? base_url('admin/instagram?page=' . ($currentPage - 1) . $keywordQuery)
                                    : '#' ?>"
                            >
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        <?php for ($page = $start; $page <= $end; $page++) : ?>
                            <li class="page-item <?= $page === $currentPage ? 'active' : '' ?>">
                                <a
                                    class="pagination-item <?= $page === $currentPage ? 'active' : '' ?>"
                                    href="<?= base_url('admin/instagram?page=' . $page . $keywordQuery) ?>"
                                >
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage >= $lastPage ? 'disabled' : '' ?>">
                            <a
                                class="pagination-item"
                                href="<?= $currentPage < $lastPage
                                    ? base_url('admin/instagram?page=' . ($currentPage + 1) . $keywordQuery)
                                    : '#' ?>"
                            >
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>

                </div>

            <?php endif; ?>


        </div>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <?= $this->include('admin/layout/footer') ?>


    </div>

</div>