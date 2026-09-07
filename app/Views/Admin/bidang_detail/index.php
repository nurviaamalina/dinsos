<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/bidang-detail.css') ?>">

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4 bg-light">

        <!-- HEADER -->
        <div class="bidang-detail-header">

            <div>

                <h2>
                    Detail <?= esc($bidang['nama_bidang']) ?>
                </h2>

                <p>
                    Kelola informasi detail bidang
                </p>

            </div>


            <?php if (!$detail): ?>

                <a href="<?= base_url('admin/bidang/detail/' . $bidang['id'] . '/create') ?>"
                   class="btn-bidang-tambah">

                    <i class="bi bi-plus-lg"></i>
                    Tambah Detail

                </a>

            <?php else: ?>

                <a href="<?= base_url('admin/bidang/detail/edit/' . $detail['id']) ?>"
                   class="btn-bidang-edit">

                    <i class="bi bi-pencil"></i>
                    Edit Detail

                </a>

            <?php endif; ?>

        </div>


        <!-- FLASH SUCCESS -->
        <?php if (session()->getFlashdata('success')): ?>

            <div class="bidang-alert-success">

                <i class="bi bi-check-circle"></i>

                <?= esc(session()->getFlashdata('success')) ?>

            </div>

        <?php endif; ?>


        <!-- FLASH ERROR -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="bidang-alert-error">

                <i class="bi bi-exclamation-circle"></i>

                <?= esc(session()->getFlashdata('error')) ?>

            </div>

        <?php endif; ?>


        <?php if (!$detail): ?>


            <!-- DETAIL BELUM ADA -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-empty">

                    <i class="bi bi-file-earmark-text"></i>

                    <h5>
                        Detail bidang belum tersedia
                    </h5>

                    <p>
                        Silakan tambahkan informasi detail untuk
                        <?= esc($bidang['nama_bidang']) ?>.
                    </p>

                    <a href="<?= base_url('admin/bidang/detail/' . $bidang['id'] . '/create') ?>"
                       class="btn-bidang-tambah">

                        Tambah Detail

                    </a>

                </div>

            </div>


        <?php else: ?>


            <!-- =========================================
                 TENTANG BIDANG
            ========================================== -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-card-header">

                    <h5>
                        Tentang Bidang
                    </h5>

                </div>

                <div class="bidang-detail-card-body">

                    <?= nl2br(esc($detail['tentang'])) ?>

                </div>

            </div>


            <!-- =========================================
                 RUANG LINGKUP
            ========================================== -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-card-header">

                    <h5>
                        Ruang Lingkup
                    </h5>

                </div>

                <div class="bidang-detail-card-body">

                    <?= nl2br(esc($detail['ruang_lingkup'])) ?>

                </div>

            </div>


            <!-- =========================================
                 TUGAS POKOK
            ========================================== -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-card-header">

                    <h5>
                        Tugas Pokok
                    </h5>

                </div>

                <div class="bidang-detail-card-body">

                    <?= nl2br(esc($detail['tugas_pokok'])) ?>

                </div>

            </div>


            <!-- =========================================
                 PROGRAM & KEGIATAN
            ========================================== -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-card-header">

                    <h5>
                        Program & Kegiatan
                    </h5>

                </div>

                <div class="bidang-detail-card-body">

                    <?= nl2br(esc($detail['program_kegiatan'])) ?>

                </div>

            </div>


            <!-- =========================================
                 INFORMASI KONTAK
            ========================================== -->

            <div class="bidang-detail-card">

                <div class="bidang-detail-card-header">

                    <h5>
                        Informasi Kontak
                    </h5>

                </div>

                <div class="bidang-detail-card-body">

                    <div class="row">

                        <!-- TELEPON -->
                        <div class="col-md-4">

                            <div class="kontak-item">

                                <strong>

                                    <i class="bi bi-telephone"></i>

                                    Telepon

                                </strong>

                                <p>
                                    <?= esc($detail['telepon']) ?>
                                </p>

                            </div>

                        </div>


                        <!-- EMAIL -->
                        <div class="col-md-4">

                            <div class="kontak-item">

                                <strong>

                                    <i class="bi bi-envelope"></i>

                                    Email

                                </strong>

                                <p>
                                    <?= esc($detail['email']) ?>
                                </p>

                            </div>

                        </div>


                        <!-- ALAMAT -->
                        <div class="col-md-4">

                            <div class="kontak-item">

                                <strong>

                                    <i class="bi bi-geo-alt"></i>

                                    Alamat

                                </strong>

                                <p>
                                    <?= esc($detail['alamat']) ?>
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

<!-- TOMBOL KEMBALI -->

<div class="bidang-detail-footer">

    <a href="<?= base_url('admin/bidang') ?>"
       class="btn-bidang-kembali">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>
        <?php endif; ?>

    </div>

    

</div>




<?= $this->include('admin/layout/footer') ?>