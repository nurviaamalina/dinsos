<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/kecamatan.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">


        <div class="kecamatan-header">

            <div>

                <h2>
                    Edit Data Kecamatan
                </h2>

                <p>
                    Perbarui data kecamatan.
                </p>

            </div>

        </div>



        <!-- ERROR -->

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="kecamatan-alert-error">

                <strong>
                    Data belum dapat diperbarui.
                </strong>

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



        <!-- FORM -->

        <div class="kecamatan-form-card-full">

            <form
                action="<?= base_url(
                    'admin/kecamatan/update/' .
                    $kecamatan['id']
                ) ?>"
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
                        value="<?= old(
                            'nama_kecamatan',
                            $kecamatan['nama_kecamatan']
                        ) ?>"
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
                                <?= old(
                                    'status',
                                    $kecamatan['status']
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
                                    $kecamatan['status']
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



                <!-- BUTTON -->

                <div class="kecamatan-form-actions">

                    <a
                        href="<?= base_url('admin/kecamatan') ?>"
                        class="btn-batal-kecamatan"
                    >

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="btn-simpan-kecamatan"
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