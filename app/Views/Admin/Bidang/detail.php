<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/bidang.css') ?>"
>

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4 bg-light">


        <!-- =====================================================
             HEADER HALAMAN
        ====================================================== -->

        <div class="bidang-page-header">

            <div>

                <h2>
                    Detail <?= esc($bidang['nama_bidang']) ?>
                </h2>

                <p>
                    Kelola informasi detail bidang Dinas Sosial.
                </p>

            </div>


            <?php if (!$detail): ?>

                <a
                    href="<?= base_url(
                        'admin/bidang/detail/' .
                        $bidang['id'] .
                        '/create'
                    ) ?>"
                    class="btn-bidang-tambah"
                >

                    <i class="bi bi-plus-lg"></i>

                    Tambah Detail

                </a>

            <?php else: ?>

                <a
                    href="<?= base_url(
                        'admin/bidang/detail/edit/' .
                        $detail['id']
                    ) ?>"
                    class="btn-bidang-tambah"
                >

                    <i class="bi bi-pencil-square"></i>

                    Edit Detail

                </a>

            <?php endif; ?>

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


        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle"></i>

                <?= esc(
                    session()->getFlashdata('error')
                ) ?>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             DETAIL BELUM TERSEDIA
        ====================================================== -->

        <?php if (!$detail): ?>

            <div class="bidang-card">

                <div
                    class="text-center"
                    style="padding: 70px 20px;"
                >

                    <i
                        class="bi bi-file-earmark-text"
                        style="
                            font-size: 55px;
                            color: #adb5bd;
                        "
                    ></i>


                    <h4 class="mt-3 fw-bold">
                        Detail Bidang Belum Tersedia
                    </h4>


                    <p class="text-muted">

                        Silakan tambahkan informasi detail untuk

                        <strong>
                            <?= esc(
                                $bidang['nama_bidang']
                            ) ?>
                        </strong>.

                    </p>


                    <a
                        href="<?= base_url(
                            'admin/bidang/detail/' .
                            $bidang['id'] .
                            '/create'
                        ) ?>"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Tambah Detail

                    </a>

                </div>

            </div>


        <?php else: ?>


            <!-- =====================================================
                 TENTANG BIDANG
            ====================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Tentang Bidang

                    </h4>

                </div>


                <div class="p-4">

                    <?php if (!empty($detail['tentang'])): ?>

                        <p class="mb-0">

                            <?= nl2br(
                                esc($detail['tentang'])
                            ) ?>

                        </p>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Belum ada informasi.
                        </p>

                    <?php endif; ?>

                </div>

            </div>



            <!-- =====================================================
                 RUANG LINGKUP
            ====================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-diagram-3 me-2"></i>

                        Ruang Lingkup

                    </h4>

                </div>


                <div class="p-4">

                    <?php if (!empty($detail['ruang_lingkup'])): ?>

                        <?= nl2br(
                            esc(
                                $detail['ruang_lingkup']
                            )
                        ) ?>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Belum ada informasi.
                        </p>

                    <?php endif; ?>

                </div>

            </div>



            <!-- =====================================================
                 TUGAS POKOK
            ====================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-list-check me-2"></i>

                        Tugas Pokok

                    </h4>

                </div>


                <div class="p-4">

                    <?php if (!empty($detail['tugas_pokok'])): ?>

                        <?= nl2br(
                            esc(
                                $detail['tugas_pokok']
                            )
                        ) ?>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Belum ada informasi.
                        </p>

                    <?php endif; ?>

                </div>

            </div>



            <!-- =====================================================
                 PROGRAM & KEGIATAN
            ====================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-calendar-check me-2"></i>

                        Program & Kegiatan

                    </h4>

                </div>


                <div class="p-4">

                    <?php if (!empty($detail['program_kegiatan'])): ?>

                        <?= nl2br(
                            esc(
                                $detail['program_kegiatan']
                            )
                        ) ?>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Belum ada informasi.
                        </p>

                    <?php endif; ?>

                </div>

            </div>



            <!-- =====================================================
                 INFORMASI KONTAK
            ====================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-person-lines-fill me-2"></i>

                        Informasi Kontak

                    </h4>

                </div>


                <div class="p-4">

                    <div class="row">


                        <!-- TELEPON -->

                        <div class="col-md-4 mb-4">

                            <div class="d-flex align-items-start">

                                <i
                                    class="bi bi-telephone fs-4 me-3"
                                ></i>

                                <div>

                                    <small class="text-muted d-block">
                                        Telepon
                                    </small>

                                    <?php if (!empty($detail['telepon'])): ?>

                                        <strong>
                                            <?= esc(
                                                $detail['telepon']
                                            ) ?>
                                        </strong>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum tersedia
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>



                        <!-- EMAIL -->

                        <div class="col-md-4 mb-4">

                            <div class="d-flex align-items-start">

                                <i
                                    class="bi bi-envelope fs-4 me-3"
                                ></i>

                                <div>

                                    <small class="text-muted d-block">
                                        Email
                                    </small>

                                    <?php if (!empty($detail['email'])): ?>

                                        <strong>
                                            <?= esc(
                                                $detail['email']
                                            ) ?>
                                        </strong>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum tersedia
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>



                        <!-- ALAMAT -->

                        <div class="col-md-4 mb-4">

                            <div class="d-flex align-items-start">

                                <i
                                    class="bi bi-geo-alt fs-4 me-3"
                                ></i>

                                <div>

                                    <small class="text-muted d-block">
                                        Alamat
                                    </small>

                                    <?php if (!empty($detail['alamat'])): ?>

                                        <strong>
                                            <?= esc(
                                                $detail['alamat']
                                            ) ?>
                                        </strong>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum tersedia
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            <!-- =====================================================
                 TOMBOL
            ====================================================== -->

            <div class="d-flex justify-content-between mb-4">

                <a
                    href="<?= base_url('admin/bidang') ?>"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>


                <a
                    href="<?= base_url(
                        'admin/bidang/detail/delete/' .
                        $detail['id']
                    ) ?>"
                    class="btn btn-outline-danger"
                    onclick="return confirm(
                        'Yakin ingin menghapus detail bidang ini?'
                    )"
                >

                    <i class="bi bi-trash me-1"></i>

                    Hapus Detail

                </a>

            </div>


        <?php endif; ?>


    </div>

</div>


<?= $this->include('admin/layout/footer') ?>