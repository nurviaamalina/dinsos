<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Detail <?= esc($bidang['nama_bidang']) ?>
            </h4>

            <p class="text-muted mb-0">
                Kelola informasi detail bidang
            </p>
        </div>

        <?php if (!$detail): ?>

            <a href="<?= base_url('admin/bidang/detail/' . $bidang['id'] . '/create') ?>"
               class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>
                Tambah Detail

            </a>

        <?php else: ?>

            <a href="<?= base_url('admin/bidang/detail/edit/' . $detail['id']) ?>"
               class="btn btn-warning">

                <i class="bi bi-pencil me-1"></i>
                Edit Detail

            </a>

        <?php endif; ?>

    </div>


    <!-- ALERT -->

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>

    <?php endif; ?>


    <?php if (!$detail): ?>

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-file-earmark-text fs-1 text-muted"></i>

                <h5 class="mt-3">
                    Detail bidang belum tersedia
                </h5>

                <p class="text-muted">
                    Silakan tambahkan informasi detail untuk
                    <?= esc($bidang['nama_bidang']) ?>.
                </p>

                <a href="<?= base_url('admin/bidang/detail/' . $bidang['id'] . '/create') ?>"
                   class="btn btn-primary">

                    Tambah Detail

                </a>

            </div>

        </div>

    <?php else: ?>


        <!-- TENTANG -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">
                    Tentang Bidang
                </h5>
            </div>

            <div class="card-body">

                <?= nl2br(esc($detail['tentang'])) ?>

            </div>

        </div>


        <!-- RUANG LINGKUP -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">
                    Ruang Lingkup
                </h5>
            </div>

            <div class="card-body">

                <?= nl2br(esc($detail['ruang_lingkup'])) ?>

            </div>

        </div>


        <!-- TUGAS POKOK -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">
                    Tugas Pokok
                </h5>

            </div>

            <div class="card-body">

                <?= nl2br(esc($detail['tugas_pokok'])) ?>

            </div>

        </div>


        <!-- PROGRAM & KEGIATAN -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">
                    Program & Kegiatan
                </h5>

            </div>

            <div class="card-body">

                <?= nl2br(esc($detail['program_kegiatan'])) ?>

            </div>

        </div>


        <!-- KONTAK -->

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">
                    Informasi Kontak
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <strong>
                            <i class="bi bi-telephone me-2"></i>
                            Telepon
                        </strong>

                        <p class="text-muted">
                            <?= esc($detail['telepon']) ?>
                        </p>

                    </div>


                    <div class="col-md-4">

                        <strong>
                            <i class="bi bi-envelope me-2"></i>
                            Email
                        </strong>

                        <p class="text-muted">
                            <?= esc($detail['email']) ?>
                        </p>

                    </div>


                    <div class="col-md-4">

                        <strong>
                            <i class="bi bi-geo-alt me-2"></i>
                            Alamat
                        </strong>

                        <p class="text-muted">
                            <?= esc($detail['alamat']) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->include('admin/layout/footer') ?>