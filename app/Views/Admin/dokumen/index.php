<?= $this->include('Admin/layout/header'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dokumen.css'); ?>">

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('Admin/layout/sidebar'); ?>


       <div class="content flex-grow-1 p-4 bg-light">

        <!-- HEADER -->
        <div class="page-header">

            <div class="header-title">
                <h1>Dokumen</h1>
                <p>Kelola seluruh dokumen</p>
            </div>

           <div class="header-buttons">

    <!-- TAMBAH DOKUMEN -->
    <a href="<?= base_url('admin/dokumen/create'); ?>"
       class="btn-add">

        <i class="fas fa-plus-circle"></i>

        Tambah Dokumen

    </a>


    <!-- TAMBAH KATEGORI -->
    <a href="<?= base_url('admin/kategori-dokumen/create'); ?>"
       class="btn-add btn-category">

        <i class="fas fa-folder-plus"></i>

        Tambah Kategori

    </a>

    </div>

</div>


        <!-- SEARCH -->
        <div class="search-container">

            <form action="<?= base_url('admin/dokumen'); ?>"
                  method="get">

                <div class="search-box">

                    <input
                        type="text"
                        name="search"
                        value="<?= esc($search ?? ''); ?>"
                        placeholder=""
                    >

                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>

                </div>

            </form>

        </div>


        <!-- TAB -->
        <div class="document-tabs">

            <a
                href="<?= base_url('admin/dokumen'); ?>"
                class="<?= empty($status) ? 'active' : ''; ?>"
            >
                Semua(<?= $totalSemua ?? 0; ?>)
            </a>

            <a
                href="<?= base_url('admin/dokumen?status=dipublikasikan'); ?>"
                class="<?= ($status ?? '') === 'dipublikasikan' ? 'active' : ''; ?>"
            >
                Dipublikasikan(<?= $totalPublikasi ?? 0; ?>)
            </a>

            <a
                href="<?= base_url('admin/dokumen?status=draft'); ?>"
                class="<?= ($status ?? '') === 'draft' ? 'active' : ''; ?>"
            >
                Draf(<?= $totalDraft ?? 0; ?>)
            </a>

        </div>


        <!-- TABLE -->
        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Dokumen</th>

                        <th>Kategori</th>

                        <th>Tanggal</th>

                        <th>Dilihat</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($dokumen)): ?>

                    <?php
                    $no = 1;

                    if (isset($pager)) {
                        $no =
                            1 +
                            (($pager->getCurrentPage() - 1) * 5);
                    }
                    ?>

                    <?php foreach ($dokumen as $item): ?>

                        <?php

                        $file = $item['file'] ?? '';

                        $extension = strtolower(
                            pathinfo($file, PATHINFO_EXTENSION)
                        );

                        if ($extension === 'pdf') {

                            $fileIcon = 'fa-file-pdf';
                            $fileType = 'pdf';

                        } elseif (
                            $extension === 'doc' ||
                            $extension === 'docx'
                        ) {

                            $fileIcon = 'fa-file-word';
                            $fileType = 'doc';

                        } else {

                            $fileIcon = 'fa-file';
                            $fileType = 'file';

                        }


                        // KATEGORI

                        $namaKategori =
                            $item['nama_kategori']
                            ?? $item['kategori']
                            ?? '-';

                        $kategoriSlug =
                            strtolower($namaKategori);

                        $kategoriClass =
                            'kategori-default';


                        if (
                            str_contains(
                                $kategoriSlug,
                                'laporan'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-laporan';

                        } elseif (
                            str_contains(
                                $kategoriSlug,
                                'perencanaan'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-perencanaan';

                        } elseif (
                            str_contains(
                                $kategoriSlug,
                                'keputusan'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-keputusan';

                        } elseif (
                            str_contains(
                                $kategoriSlug,
                                'regulasi'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-regulasi';

                        } elseif (
                            str_contains(
                                $kategoriSlug,
                                'standar'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-standar';

                        } elseif (
                            str_contains(
                                $kategoriSlug,
                                'pedoman'
                            )
                        ) {

                            $kategoriClass =
                                'kategori-pedoman';

                        }


                        // STATUS

                        $statusDokumen =
                            strtoupper(
                                $item['status']
                                ?? 'DRAFT'
                            );

                        $statusClass =
                            $statusDokumen ===
                            'DIPUBLIKASIKAN'
                            ? 'status-published'
                            : 'status-draft';

                        ?>

                        <tr>

                            <!-- NO -->

                            <td>
                                <?= $no++; ?>
                            </td>


                            <!-- NAMA DOKUMEN -->

                            <td>

                                <div class="document-name">

                                    <div class="
                                        file-icon
                                        <?= $fileType; ?>
                                    ">

                                        <i class="
                                            fas
                                            <?= $fileIcon; ?>
                                        "></i>

                                    </div>

                                    <span>
                                        <?= esc(
                                            $item['judul']
                                            ?? 'Tanpa Judul'
                                        ); ?>
                                    </span>

                                </div>

                            </td>


                            <!-- KATEGORI -->

                            <td>

                                <span class="
                                    category-badge
                                    <?= $kategoriClass; ?>
                                ">

                                    <?= esc(
                                        $namaKategori
                                    ); ?>

                                </span>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <?php if (
                                    !empty(
                                        $item['created_at']
                                    )
                                ): ?>

                                    <?= date(
                                        'd - m - Y',
                                        strtotime(
                                            $item['created_at']
                                        )
                                    ); ?>

                                <?php elseif (
                                    !empty(
                                        $item['tanggal']
                                    )
                                ): ?>

                                    <?= date(
                                        'd - m - Y',
                                        strtotime(
                                            $item['tanggal']
                                        )
                                    ); ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>


                            <!-- DILIHAT -->

                            <td>

                                <?= number_format(
                                    $item['dilihat']
                                    ?? 0
                                ); ?>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <span class="
                                    status-badge
                                    <?= $statusClass; ?>
                                ">

                                    <?= esc(
                                        $statusDokumen
                                    ); ?>

                                </span>

                            </td>


                           <!-- AKSI -->

<td>

    <div class="action-buttons">


        <!-- LIHAT -->

        <?php if (!empty($file)): ?>

            <a
                href="<?= base_url(
                    'uploads/dokumen/' . $file
                ); ?>"
                target="_blank"
                class="action-btn view"
                title="Lihat Dokumen"
            >

                <i class="fas fa-eye"></i>

            </a>

        <?php endif; ?>


        <!-- DOWNLOAD -->

        <?php if (!empty($file)): ?>

            <a
                href="<?= base_url(
                    'admin/dokumen/download/' .
                    $item['id']
                ); ?>"
                class="action-btn download"
                title="Download"
            >

                <i class="fas fa-download"></i>

            </a>

        <?php endif; ?>


        <!-- EDIT -->

        <a
            href="<?= base_url(
                'admin/dokumen/edit/' .
                $item['id']
            ); ?>"
            class="action-btn edit"
            title="Edit Dokumen"
        >

            <i class="fas fa-pen"></i>

        </a>


        <!-- DELETE -->

        <a
            href="<?= base_url(
                'admin/dokumen/delete/' .
                $item['id']
            ); ?>"
            class="action-btn delete"
            title="Hapus Dokumen"
            onclick="
                return confirm(
                    'Yakin ingin menghapus dokumen ini?'
                )
            "
        >

            <i class="fas fa-trash"></i>

        </a>


    </div>

</td>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="7"
                            class="empty-data"
                        >

                            <i class="
                                fas
                                fa-folder-open
                            "></i>

                            <p>
                                Belum ada dokumen
                            </p>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        <?php if (
            isset($pager) &&
            !empty($dokumen)
        ): ?>

            <div class="pagination">

                <?= $pager->links(); ?>

            </div>

        <?php endif; ?>


        <!-- KATEGORI DOKUMEN -->

        <div class="category-section">

            <h3>
                Kategori Dokumen
            </h3>


            <div class="category-grid">

                <?php if (!empty($kategori)): ?>

                    <?php foreach (
                        $kategori as $kat
                    ): ?>

                        <?php

                        $nama =
                            strtolower(
                                $kat['nama_kategori']
                                ?? ''
                            );

                        $class =
                            'kategori-default';


                        if (
                            str_contains(
                                $nama,
                                'laporan'
                            )
                        ) {

                            $class =
                                'kategori-laporan';

                        } elseif (
                            str_contains(
                                $nama,
                                'perencanaan'
                            )
                        ) {

                            $class =
                                'kategori-perencanaan';

                        } elseif (
                            str_contains(
                                $nama,
                                'keputusan'
                            )
                        ) {

                            $class =
                                'kategori-keputusan';

                        } elseif (
                            str_contains(
                                $nama,
                                'regulasi'
                            )
                        ) {

                            $class =
                                'kategori-regulasi';

                        } elseif (
                            str_contains(
                                $nama,
                                'standar'
                            )
                        ) {

                            $class =
                                'kategori-standar';

                        } elseif (
                            str_contains(
                                $nama,
                                'pedoman'
                            )
                        ) {

                            $class =
                                'kategori-pedoman';

                        }

                        ?>


                        <div class="category-item">

                            <span class="
                                category-badge
                                <?= $class; ?>
                            ">

                                <?= esc(
                                    $kat['nama_kategori']
                                    ?? ''
                                ); ?>

                            </span>


                            <p>

                                <?= esc(
                                    $kat['deskripsi']
                                    ??
                                    'Dokumen ' .
                                    ($kat['nama_kategori']
                                    ?? '')
                                ); ?>

                            </p>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <!-- DATA DEFAULT SESUAI GAMBAR -->

                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-laporan
                        ">
                            Laporan
                        </span>

                        <p>
                            Laporan Kinerja dan hasil
                            pelaksanaan program
                        </p>

                    </div>


                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-perencanaan
                        ">
                            Perencanaan
                        </span>

                        <p>
                            Dokumen Perencanaan dan
                            Program Kegiatan
                        </p>

                    </div>


                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-keputusan
                        ">
                            Surat Keputusan
                        </span>

                        <p>
                            Surat Keputusan dan
                            Penetapan Resmi
                        </p>

                    </div>


                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-regulasi
                        ">
                            Regulasi
                        </span>

                        <p>
                            Peraturan, perundangan
                            dan regulasi lainnya
                        </p>

                    </div>


                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-standar
                        ">
                            Standar Operasional
                        </span>

                        <p>
                            Standar Pelayanan dan
                            Prosedur Operasional
                        </p>

                    </div>


                    <div class="category-item">

                        <span class="
                            category-badge
                            kategori-pedoman
                        ">
                            Pedoman Teknis
                        </span>

                        <p>
                            Pedoman dan Petunjuk Teknis
                            Pelaksanaan
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>


<!-- FOOTER -->




<?= $this->include('Admin/layout/footer'); ?>