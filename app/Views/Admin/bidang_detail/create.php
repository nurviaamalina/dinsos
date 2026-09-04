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
             HEADER
        ====================================================== -->

        <div class="bidang-page-header">

            <div>

                <h2>
                    Tambah Detail Bidang
                </h2>

                <p>
                    Tambahkan informasi
                    <?= esc($bidang['nama_bidang']) ?>.
                </p>

            </div>

        </div>



        <!-- =====================================================
             FLASH ERROR
        ====================================================== -->

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle me-2"></i>

                <?= esc(
                    session()->getFlashdata('error')
                ) ?>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             FORM
        ====================================================== -->

        <form
            action="<?= base_url(
                'admin/bidang/detail/' .
                $bidang['id'] .
                '/store'
            ) ?>"
            method="post"
        >

            <?= csrf_field() ?>



            <!-- =================================================
                 NAMA BIDANG
            ================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-building me-2"></i>

                        Data Bidang

                    </h4>

                </div>


                <div class="p-4">

                    <label class="form-label fw-semibold">

                        Nama Bidang

                    </label>


                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $bidang['nama_bidang']
                        ) ?>"
                        readonly
                    >


                    <small class="text-muted">

                        <i class="bi bi-info-circle me-1"></i>

                        Nama bidang diambil otomatis dari
                        data master bidang.

                    </small>

                </div>

            </div>



            <!-- =================================================
                 TENTANG
            ================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Tentang Bidang

                    </h4>

                </div>


                <div class="p-4">

                    <label class="form-label fw-semibold">

                        Tentang Bidang

                        <span class="text-danger">*</span>

                    </label>


                    <textarea
                        name="tentang"
                        class="form-control"
                        rows="6"
                        placeholder="Masukkan informasi tentang bidang..."
                        required
                    ></textarea>

                </div>

            </div>



            <!-- =================================================
                 RUANG LINGKUP
            ================================================== -->

            <!-- =================================================
     RUANG LINGKUP
================================================== -->

<div class="bidang-card mb-4">

    <div class="bidang-card-header">
        <h4 class="mb-0">
            <i class="bi bi-diagram-3 me-2"></i>
            Ruang Lingkup
        </h4>
    </div>

    <div class="p-4">

        <label class="form-label fw-semibold">
            Ruang Lingkup
            <span class="text-danger">*</span>
        </label>

        <div id="ruangLingkupContainer">

            <div class="input-group mb-2 ruang-lingkup-item">
                <input
                    type="text"
                    name="ruang_lingkup[]"
                    class="form-control"
                    placeholder="Masukkan ruang lingkup..."
                    required
                >

                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="hapusItem(this)"
                >
                    <i class="bi bi-trash"></i>
                </button>
            </div>

        </div>

        <button
            type="button"
            class="btn btn-outline-primary btn-sm mt-2"
            onclick="tambahRuangLingkup()"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Ruang Lingkup
        </button>

    </div>

</div>



<!-- =================================================
     TUGAS POKOK
================================================== -->

<div class="bidang-card mb-4">

    <div class="bidang-card-header">
        <h4 class="mb-0">
            <i class="bi bi-list-check me-2"></i>
            Tugas Pokok
        </h4>
    </div>

    <div class="p-4">

        <label class="form-label fw-semibold">
            Tugas Pokok
            <span class="text-danger">*</span>
        </label>

        <div id="tugasPokokContainer">

            <div class="input-group mb-2 tugas-pokok-item">
                <input
                    type="text"
                    name="tugas_pokok[]"
                    class="form-control"
                    placeholder="Masukkan tugas pokok..."
                    required
                >

                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="hapusItem(this)"
                >
                    <i class="bi bi-trash"></i>
                </button>
            </div>

        </div>

        <button
            type="button"
            class="btn btn-outline-primary btn-sm mt-2"
            onclick="tambahTugasPokok()"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Tugas Pokok
        </button>

    </div>

</div>



            <!-- =================================================
                 PROGRAM & KEGIATAN
            ================================================== -->

            <div class="bidang-card mb-4">

                <div class="bidang-card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-calendar-check me-2"></i>

                        Program & Kegiatan

                    </h4>

                </div>


                <div class="p-4">

                    <label class="form-label fw-semibold">

                        Program & Kegiatan

                        <span class="text-danger">*</span>

                    </label>


                    <textarea
                        name="program_kegiatan"
                        class="form-control"
                        rows="7"
                        placeholder="Masukkan program dan kegiatan..."
                        required
                    ></textarea>

                </div>

            </div>



            <!-- =================================================
                 KONTAK
            ================================================== -->

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

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">

                                Telepon

                                <span class="text-danger">*</span>

                            </label>


                            <input
                                type="text"
                                name="telepon"
                                class="form-control"
                                placeholder="Contoh: (0333) 123456"
                                required
                            >

                        </div>



                        <!-- EMAIL -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">

                                Email

                                <span class="text-danger">*</span>

                            </label>


                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Contoh: bidang@dinsos.go.id"
                                required
                            >

                        </div>



                        <!-- ALAMAT -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">

                                Alamat

                                <span class="text-danger">*</span>

                            </label>


                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat..."
                                required
                            ></textarea>

                        </div>


                    </div>

                </div>

            </div>



            <!-- =================================================
                 BUTTON
            ================================================== -->

            <div class="d-flex justify-content-between mb-4">


                <a
                    href="<?= base_url(
                        'admin/bidang/detail/' .
                        $bidang['id']
                    ) ?>"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-save me-1"></i>

                    Simpan Detail

                </button>


            </div>


        </form>


    </div>

</div>


<?= $this->include('admin/layout/footer') ?>