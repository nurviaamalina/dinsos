<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/berita.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Judul.header -->

            <div class="berita-header">

                <div class="berita-header-text">

                    <h1>
                        Berita dan Pengumuman
                    </h1>

                    <p>
                        Kelola seluruh berita
                    </p>

                </div>

            </div>


            <!-- Tombol Tambah dan import berita-->

            <div class="berita-header-buttons">

                <a
                    href="<?= base_url('admin/berita/create') ?>"
                    class="btn-tambah-berita"
                >

                    <i class="bi bi-plus-circle"></i>

                    Tambah Berita

                </a>


                <a
                    href="<?= base_url('admin/berita/import') ?>"
                    class="btn-import-berita"
                >

                    <i class="bi bi-plus-circle"></i>

                    Import Data

                </a>

            </div>


            <!-- FLASH MESSAGE -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show berita-alert">

                    <i class="bi bi-check-circle"></i>

                    <?= esc(session()->getFlashdata('success')) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show berita-alert">

                    <i class="bi bi-exclamation-circle"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!--STATISTIC CARDS -->

            <div class="berita-statistik">

                <!-- TOTAL BERITA -->

                <div class="berita-stat-card">

                    <span>
                        Total Berita
                    </span>

                    <strong>
                        <?= $totalBerita ?? 0 ?>
                    </strong>

                    <small>
                        Keseluruhan Berita
                    </small>

                </div>


                <!-- DRAFT -->

                <div class="berita-stat-card">

                    <span>
                        Draf
                    </span>

                    <strong>
                        <?= $totalDraft ?? 0 ?>
                    </strong>

                    <small>
                        Belum dipublikasikan
                    </small>

                </div>


                <!-- PUBLIK -->

                <div class="berita-stat-card">

                    <span>
                        Publik
                    </span>

                    <strong>
                        <?= $totalPublik ?? 0 ?>
                    </strong>

                    <small>
                        Sudah dipublikasikan
                    </small>

                </div>

            </div>


            <!-- TAB FILTER-->

            <div class="berita-filter">

                <a
                    href="<?= base_url('admin/berita') ?>"
                    class="berita-tab active"
                >

                    Semua

                    <span>
                        (<?= $totalBerita ?? 0 ?>)
                    </span>

                </a>


                <a
                    href="<?= base_url('admin/berita?status=publik') ?>"
                    class="berita-tab"
                >

                    Dipublikasikan

                    <span>
                        (<?= $totalPublik ?? 0 ?>)
                    </span>

                </a>


                <a
                    href="<?= base_url('admin/berita?status=draft') ?>"
                    class="berita-tab"
                >

                    Draf

                    <span>
                        (<?= $totalDraft ?? 0 ?>)
                    </span>

                </a>

            </div>


            <!-- Card / tabel -->

            <div class="berita-table-card">

                <div class="table-responsive">

                    <table class="berita-table">

                        <thead>

                            <tr>

                                <th class="no-column">
                                    No
                                </th>

                                <th class="gambar-column">
                                    Gambar
                                </th>

                                <th class="judul-column">
                                    Judul Berita
                                </th>

                                <th class="penulis-column">
                                    Penulis
                                </th>

                                <th class="tanggal-column">
                                    Tanggal
                                </th>

                                <th class="dilihat-column">
                                    Dilihat
                                </th>

                                <th class="status-column">
                                    Status
                                </th>

                                <th class="aksi-column">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (empty($berita)) : ?>

                                <tr>

                                    <td
                                        colspan="8"
                                        class="berita-empty"
                                    >

                                        Belum ada data berita.

                                    </td>

                                </tr>

                            <?php else : ?>

                                <?php $no = 1; ?>

                                <?php foreach ($berita as $row) : ?>

                                    <tr>

                                        <!-- NO -->

                                        <td class="text-center">

                                            <?= $no++ ?>

                                        </td>


                                        <!-- GAMBAR -->

                                        <td>

                                            <?php if (!empty($row['gambar'])) : ?>

                                                <img
                                                    src="<?= base_url('uploads/berita/' . $row['gambar']) ?>"
                                                    alt="<?= esc($row['judul']) ?>"
                                                    class="berita-thumbnail"
                                                >

                                            <?php else : ?>

                                                <div class="berita-thumbnail-empty"></div>

                                            <?php endif; ?>

                                        </td>


                                        <!-- JUDUL -->

                                        <td>

                                            <span class="judul-berita">

                                                <?= esc($row['judul']) ?>

                                            </span>

                                        </td>


                                        <!-- PENULIS -->

                                        <td>

                                            <?= esc($row['publikator'] ?? '-') ?>

                                        </td>


                                        <!-- TANGGAL -->

                                        <td>

                                            <?php if (!empty($row['tanggal'])) : ?>

                                                <?= date(
                                                    'd - m - Y',
                                                    strtotime($row['tanggal'])
                                                ) ?>

                                            <?php else : ?>

                                                -

                                            <?php endif; ?>

                                        </td>


                                        <!-- DILIHAT -->

                                        <td class="text-center">

                                            <?= $row['views'] ?? 0 ?>

                                        </td>


                                        <!-- STATUS -->

                                        <td>

                                            <?php if (($row['status'] ?? '') === 'draft') : ?>

                                                <span class="status-draft">
                                                    DRAF
                                                </span>

                                            <?php else : ?>

                                                <span class="status-publik">
                                                    DIPUBLIKASIKAN
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <!-- AKSI -->

                                        <td>

                                            <div class="berita-actions">

                                                <a
                                                    href="<?= base_url('admin/berita/edit/' . $row['id']) ?>"
                                                    class="btn-edit-berita"
                                                    title="Edit"
                                                >

                                                    <i class="bi bi-pencil-square"></i>

                                                </a>


                                                <a
                                                    href="<?= base_url('admin/berita/delete/' . $row['id']) ?>"
                                                    class="btn-delete-berita"
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- pagenation -->

            <div class="berita-pagination">

                <?= $pager->links() ?>

            </div>


        </div>

    </div>

</div>

 <?= $this->include('admin/layout/footer') ?>