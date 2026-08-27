<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/bidang.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="bidang-page-header">

            <div>

                <h2>
                    Edit Data Bidang
                </h2>

                <p>
                    Perbarui informasi data master bidang.
                </p>

            </div>

        </div>



        <!-- =====================================================
             ERROR
        ====================================================== -->

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="bidang-alert-error">

                <div class="error-title">

                    <i class="bi bi-exclamation-circle"></i>

                    Periksa kembali data yang dimasukkan.

                </div>


                <ul>

                    <?php foreach (
                        session()->getFlashdata('errors')
                        as $error
                    ): ?>

                        <li>
                            <?= esc($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             FORM
        ====================================================== -->

        <div class="bidang-form-card">

            <form
                action="<?= base_url(
                    'admin/bidang/update/' .
                    $bidang['id']
                ) ?>"
                method="post"
            >

                <?= csrf_field() ?>


                <!-- NAMA BIDANG -->

                <div class="bidang-form-group">

                    <label>

                        Nama Bidang

                        <span>
                            *
                        </span>

                    </label>


                    <input
                        type="text"
                        name="nama_bidang"
                        value="<?= old(
                            'nama_bidang',
                            $bidang['nama_bidang']
                        ) ?>"
                        placeholder="Masukkan nama bidang"
                        required
                    >


                    <small>
                        Masukkan nama bidang sesuai struktur organisasi.
                    </small>

                </div>



                <!-- STATUS -->

                <div class="bidang-form-group">

                    <label>

                        Status

                        <span>
                            *
                        </span>

                    </label>


                    <div class="bidang-radio-group">


                        <label>

                            <input
                                type="radio"
                                name="status"
                                value="aktif"
                                <?= old(
                                    'status',
                                    $bidang['status']
                                ) === 'aktif'
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
                                <?= old(
                                    'status',
                                    $bidang['status']
                                ) === 'tidak_aktif'
                                    ? 'checked'
                                    : '' ?>
                            >

                            <span>
                                Tidak Aktif
                            </span>

                        </label>


                    </div>

                </div>



                <!-- ACTION -->

                <div class="bidang-form-actions">

                    <a
                        href="<?= base_url('admin/bidang') ?>"
                        class="btn-bidang-batal"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="btn-bidang-simpan"
                    >

                        <i class="bi bi-save"></i>

                        Simpan Perubahan

                    </button>

                </div>


            </form>

        </div>


    </div>

</div>


<?= $this->include('admin/layout/footer') ?>