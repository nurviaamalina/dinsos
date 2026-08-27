<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/bidang.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">


        <!-- =====================================================
             HEADER HALAMAN
        ====================================================== -->

        <div class="bidang-page-header">

            <div>

                <h2>
                    Data Bidang
                </h2>

                <p>
                    Kelola data master bidang Dinas Sosial.
                </p>

            </div>


            <a
                href="<?= base_url('admin/bidang/create') ?>"
                class="btn-bidang-tambah"
            >

                <i class="bi bi-plus-lg"></i>

                Tambah Data

            </a>

        </div>



        <!-- =====================================================
             FLASH MESSAGE
        ====================================================== -->

        <?php if (session()->getFlashdata('success')): ?>

            <div class="bidang-alert-success">

                <i class="bi bi-check-circle"></i>

                <?= esc(
                    session()->getFlashdata('success')
                ) ?>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             CARD DATA
        ====================================================== -->

        <div class="bidang-card">


            <!-- =================================================
                 SEARCH
            ================================================== -->

            <div class="bidang-card-header">

                <form
                    action="<?= base_url('admin/bidang') ?>"
                    method="get"
                >

                    <div class="bidang-search">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="keyword"
                            value="<?= esc($keyword ?? '') ?>"
                            placeholder="Cari nama bidang..."
                        >

                    </div>

                </form>

            </div>



            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="table-responsive">

                <table class="bidang-table">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Bidang
                            </th>

                            <th width="150">
                                Status
                            </th>

                            <th width="130">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (!empty($bidang)): ?>

                            <?php
                            $no = 1 +
                                (($pager->getCurrentPage() - 1) * 10);
                            ?>


                            <?php foreach ($bidang as $item): ?>

                                <tr>

                                    <td>
                                        <?= $no++ ?>
                                    </td>


                                    <td>

                                        <div class="nama-bidang">

                                            <?= esc(
                                                $item['nama_bidang']
                                            ) ?>

                                        </div>

                                    </td>


                                    <td>

                                        <?php if (
                                            $item['status'] === 'aktif'
                                        ): ?>

                                            <span class="status-bidang aktif">
                                                Aktif
                                            </span>

                                        <?php else: ?>

                                            <span class="status-bidang tidak-aktif">
                                                Tidak Aktif
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <div class="bidang-aksi">

                                            <a
                                                href="<?= base_url(
                                                    'admin/bidang/edit/' .
                                                    $item['id']
                                                ) ?>"
                                                class="aksi-edit"
                                                title="Edit"
                                            >

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            <a
                                                href="<?= base_url(
                                                    'admin/bidang/delete/' .
                                                    $item['id']
                                                ) ?>"
                                                class="aksi-delete"
                                                title="Hapus"
                                                onclick="return confirm(
                                                    'Yakin ingin menghapus data bidang ini?'
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
                                    class="bidang-empty"
                                >

                                    <i class="bi bi-folder2-open"></i>

                                    <p>
                                        Belum ada data bidang.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>



            <!-- =================================================
                 PAGINATION
            ================================================== -->

            <?php if (!empty($bidang)): ?>

                <div class="bidang-pagination">

                    <?= $pager->links() ?>

                </div>

            <?php endif; ?>


        </div>


    </div>

</div>


<?= $this->include('admin/layout/footer') ?>