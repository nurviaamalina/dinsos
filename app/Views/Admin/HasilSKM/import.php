<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/hasil-skm.css') ?>"
>

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4">

        <div class="skm-page">

            <!-- =====================================================
                 HEADER
            ====================================================== -->

            <div class="page-header">

                <div>

                    <h1>
                        Import Data Survei Kepuasan Masyarakat
                    </h1>

                    <p>
                        Import data SKM menggunakan file Excel
                    </p>

                </div>

            </div>


            <!-- =====================================================
                 ALERT
            ====================================================== -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">

                    <?= session()->getFlashdata('error') ?>

                </div>

            <?php endif; ?>


            <!-- =====================================================
                 IMPORT CARD
            ====================================================== -->

            <div class="table-card">

                <div class="card-body">

                    <form
                        action="<?= base_url('admin/hasil-skm/import/process') ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


                        <!-- FILE -->
                        <div class="mb-4">

                            <label
                                for="file_excel"
                                class="form-label"
                            >
                                File Excel
                            </label>

                            <input
                                type="file"
                                name="file_excel"
                                id="file_excel"
                                class="form-control"
                                accept=".xlsx,.xls"
                                required
                            >

                            <div class="form-text">

                                Format yang didukung:
                                XLSX dan XLS.

                            </div>

                        </div>


                        <!-- INFO -->
                        <div class="alert alert-info">

                            <i class="bi bi-info-circle"></i>

                            Setelah file diupload, sistem akan membaca
                            nama kolom Excel terlebih dahulu.

                            Selanjutnya kolom akan dipetakan ke data SKM.

                        </div>


                        <!-- BUTTON -->
                        <div class="d-flex gap-2">

                            <a
                                href="<?= base_url('admin/hasil-skm') ?>"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-arrow-left"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-upload"></i>

                                Impor Data

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>