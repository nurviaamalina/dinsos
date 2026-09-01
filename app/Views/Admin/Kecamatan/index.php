<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/kecamatan.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="kecamatan-header">

            <div>

                <h2>
                    Data Kecamatan
                </h2>

                <p>
                    Kelola data kecamatan yang digunakan dalam layanan
                    dan dashboard statistik
                </p>

            </div>

        </div>



        <!-- =====================================================
             CONTENT GRID
        ====================================================== -->

        <div class="kecamatan-content">


            <!-- =================================================
                 DATA TABLE
            ================================================== -->

            <div class="kecamatan-table-card">


                <!-- SEARCH -->

                <div class="kecamatan-search-wrapper">

                    <form
                        action="<?= base_url('admin/kecamatan') ?>"
                        method="get"
                    >

                        <div class="kecamatan-search">

                            <input
                                type="text"
                                name="keyword"
                                value="<?= esc($keyword ?? '') ?>"
                                placeholder="Cari kecamatan..."
                            >

                            <button type="submit">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </form>

                </div>



                <!-- FLASH MESSAGE -->

                <?php if (session()->getFlashdata('success')): ?>

                    <div class="kecamatan-alert-success">

                        <i class="bi bi-check-circle"></i>

                        <?= esc(
                            session()->getFlashdata('success')
                        ) ?>

                    </div>

                <?php endif; ?>



                <!-- TABLE -->

                <div class="table-responsive">

                    <table class="kecamatan-table">

                        <thead>

                            <tr>

                                <th width="55">
                                    No
                                </th>

                                <th>
                                    Nama Kecamatan
                                </th>

                                <th width="100">
                                    Status
                                </th>

                                <th width="90">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <?php if (!empty($kecamatan)): ?>

                                <?php

                                $no = 1 +
                                    (($pager->getCurrentPage() - 1) * 10);

                                ?>


                                <?php foreach (
                                    $kecamatan
                                    as $item
                                ): ?>


                                    <tr>


                                        <!-- NO -->

                                        <td>
                                            <?= $no++ ?>
                                        </td>



                                        <!-- NAMA -->

                                        <td>

                                            <span class="nama-kecamatan">

                                                <?= esc(
                                                    $item['nama_kecamatan']
                                                ) ?>

                                            </span>

                                        </td>



                                        <!-- STATUS -->

                                        <td>

                                            <?php if (
                                                $item['status'] === 'aktif'
                                            ): ?>

                                                <span class="status-aktif">

                                                    Aktif

                                                </span>

                                            <?php else: ?>

                                                <span class="status-nonaktif">

                                                    Tidak Aktif

                                                </span>

                                            <?php endif; ?>

                                        </td>



                                        <!-- AKSI -->

                                        <td>

                                            <div class="kecamatan-actions">


                                                <!-- EDIT -->

                                                <a
                                                    href="<?= base_url(
                                                        'admin/kecamatan/edit/' .
                                                        $item['id']
                                                    ) ?>"
                                                    class="btn-edit-kecamatan"
                                                    title="Edit"
                                                >

                                                    <i class="bi bi-pencil-square"></i>

                                                </a>



                                                <!-- DELETE -->

                                                <a
                                                    href="<?= base_url(
                                                        'admin/kecamatan/delete/' .
                                                        $item['id']
                                                    ) ?>"
                                                    class="btn-delete-kecamatan"
                                                    title="Hapus"
                                                    onclick="return confirm(
                                                        'Yakin ingin menghapus data kecamatan ini?'
                                                    )"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                </a>


                                            </div>

                                        </td>


                                    </tr>


                                <?php endforeach; ?>


                            <?php else: ?>


                                <tr>

                                    <td
                                        colspan="4"
                                        class="kecamatan-empty"
                                    >

                                        <i class="bi bi-geo-alt"></i>

                                        <p>
                                            Belum ada data kecamatan.
                                        </p>

                                    </td>

                                </tr>


                            <?php endif; ?>


                        </tbody>

                    </table>

                </div>



                <!-- PAGINATION -->

                <?php if (!empty($kecamatan)): ?>

                    <div class="kecamatan-pagination">

                        <?= $pager->links() ?>

                    </div>

                <?php endif; ?>


            </div>



            <!-- =================================================
                 FORM TAMBAH
            ================================================== -->

            <div class="kecamatan-form-card">


                <h3>
                    Tambah Data Kecamatan
                </h3>


                <form
                    action="<?= base_url('admin/kecamatan/store') ?>"
                    method="post"
                >

                    <?= csrf_field() ?>


                    <!-- NAMA -->

                    <div class="kecamatan-form-group">

                        <label>

                            Nama Kecamatan

                        </label>


                        <input
                            type="text"
                            name="nama_kecamatan"
                            value="<?= old('nama_kecamatan') ?>"
                            placeholder="Masukkan nama kecamatan"
                            required
                        >

                    </div>



                    <!-- STATUS -->

                    <div class="kecamatan-form-group">

                        <label>
                            Status
                        </label>


                        <div class="kecamatan-radio">


                            <label>

                                <input
                                    type="radio"
                                    name="status"
                                    value="aktif"
                                    <?= old('status', 'aktif') === 'aktif'
                                        ? 'checked'
                                        : '' ?>
                                    required
                                >

                                <span>
                                    Aktif
                                </span>

                            </label>


                            <label>

                                <input
                                    type="radio"
                                    name="status"
                                    value="tidak_aktif"
                                    <?= old('status') === 'tidak_aktif'
                                        ? 'checked'
                                        : '' ?>
                                >

                                <span>
                                    Tidak Aktif
                                </span>

                            </label>


                        </div>

                    </div>



                    <!-- BUTTON -->

                    <div class="kecamatan-form-actions">


                        <button
                            type="reset"
                            class="btn-batal-kecamatan"
                        >

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn-simpan-kecamatan"
                        >

                            <i class="bi bi-save"></i>

                            Simpan

                        </button>


                    </div>


                </form>

            </div>


        </div>


    </div>

</div>


<?= $this->include('admin/layout/footer') ?>