<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/kegiatan.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- HEADER -->

            <div class="kegiatan-header">

                <div>

                    <h1>
                        Kegiatan
                    </h1>

                    <p>
                        Kelola seluruh kegiatan
                    </p>

                </div>


                <div class="kegiatan-header-buttons">

                    <a
                        href="<?= base_url('admin/kegiatan/create') ?>"
                        class="btn-tambah-kegiatan"
                    >

                        <i class="bi bi-plus-circle"></i>

                        Tambah Kegiatan

                    </a>

                     <a
                    href="<?= base_url('admin/kegiatan/import') ?>"
                    class="btn-import-berita"
                >

                    <i class="bi bi-plus-circle"></i>

                    Import Data

                </a>

                </div>

            </div>


            <!-- FLASH MESSAGE -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success">

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- TABLE -->

            <div class="kegiatan-table-card">

                <div class="table-responsive">

                    <table class="kegiatan-table">

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Thumbnail
                                </th>

                                <th>
                                    Judul Kegiatan
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Tahun
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (empty($kegiatan)) : ?>

                                <tr>

                                    <td
                                        colspan="6"
                                        class="kegiatan-empty"
                                    >

                                        Belum ada data kegiatan.

                                    </td>

                                </tr>

                            <?php else : ?>

                                <?php $no = 1; ?>

                                <?php foreach (
                                    $kegiatan as $item
                                ) : ?>

                                    <tr>

                                        <td>
                                            <?= $no++ ?>
                                        </td>


                                        <!-- THUMBNAIL -->

                                        <td>

                                            <?php if (
                                                !empty(
                                                    $item['thumbnail']
                                                )
                                            ) : ?>

                                                <img
                                                    src="<?= base_url(
                                                        'uploads/kegiatan/thumbnail/' .
                                                        $item['thumbnail']
                                                    ) ?>"
                                                    class="kegiatan-thumbnail"
                                                    alt="<?= esc(
                                                        $item['judul']
                                                    ) ?>"
                                                >

                                            <?php else : ?>

                                                <div
                                                    class="kegiatan-thumbnail-empty"
                                                >

                                                    <i class="bi bi-image"></i>

                                                </div>

                                            <?php endif; ?>

                                        </td>


                                        <!-- JUDUL -->

                                        <td>

                                            <?= esc(
                                                $item['judul']
                                            ) ?>

                                        </td>


                                        <!-- TANGGAL -->

                                        <td>

                                            <?php if (
                                                !empty(
                                                    $item['tanggal']
                                                )
                                            ) : ?>

                                                <?= date(
                                                    'd - m - Y',
                                                    strtotime(
                                                        $item['tanggal']
                                                    )
                                                ) ?>

                                            <?php else : ?>

                                                -

                                            <?php endif; ?>

                                        </td>


                                        <!-- TAHUN -->

                                        <td>

                                            <?= esc(
                                                $item['tahun'] ?? '-'
                                            ) ?>

                                        </td>


                                        <!-- AKSI -->

                                        <td>

                                            <div
                                                class="kegiatan-actions"
                                            >

                                                <a
                                                    href="<?= base_url(
                                                        'admin/kegiatan/edit/' .
                                                        $item['id']
                                                    ) ?>"
                                                    class="btn-edit-kegiatan"
                                                >

                                                    <i
                                                        class="bi bi-pencil-square"
                                                    ></i>

                                                </a>


                                                <a
                                                    href="<?= base_url(
                                                        'admin/kegiatan/delete/' .
                                                        $item['id']
                                                    ) ?>"
                                                    class="btn-delete-kegiatan"
                                                    onclick="return confirm('Yakin ingin menghapus kegiatan ini beserta seluruh dokumentasinya?')"
                                                >

                                                    <i
                                                        class="bi bi-trash"
                                                    ></i>

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <?php if (isset($pager) && $pager->getPageCount() > 1): ?>

    <div class="kegiatan-pagination">
        <?= $pager->links() ?>
    </div>

<?php endif; ?>

            </div>
                                                


        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>