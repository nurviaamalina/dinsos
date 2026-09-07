<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/penerima_manfaat.css') ?>"
>

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 penerima-page">

        <!-- HEADER -->
        <div class="penerima-header">

            <div class="penerima-header-text">

                <h1>
                    Tambah Data Penerima Manfaat
                </h1>

                <p>
                    Kelola seluruh Data Permohonan, Pengajuan untuk Kebutuhan Statistik
                </p>

            </div>

        </div>


        <!-- ALERT -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="penerima-alert penerima-alert-error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>


        <!-- FORM CARD -->
        <div class="penerima-form-card">

            <!-- FORM HEADER -->
            <div class="penerima-form-header">

                <div class="form-title-wrapper">

                    <h2>
                        Form Tambah Data
                    </h2>

                    <span></span>

                </div>


                <a
                    href="<?= base_url('admin/penerima-manfaat/import') ?>"
                    class="btn-import-outline"
                >

                    <i class="bi bi-box-arrow-in-down"></i>

                    Import Data

                </a>

            </div>


            <!-- FORM -->
            <form
                action="<?= base_url('admin/penerima-manfaat/store') ?>"
                method="post"
            >

                <?= csrf_field() ?>


                <div class="penerima-form-grid">


                    <!-- ==========================
                         PERIODE
                    =========================== -->

                    <div class="penerima-form-group periode-group">

                        <div class="periode-wrapper">

                            <!-- BULAN -->
                            <div class="periode-field">

                                <label for="periode_bulan">
                                    Bulan
                                </label>

                                <select
                                    name="periode_bulan"
                                    id="periode_bulan"
                                    required
                                >

                                    <option value="">
                                        Pilih Bulan
                                    </option>

                                    <?php
                                    $namaBulan = [
                                        1  => 'Januari',
                                        2  => 'Februari',
                                        3  => 'Maret',
                                        4  => 'April',
                                        5  => 'Mei',
                                        6  => 'Juni',
                                        7  => 'Juli',
                                        8  => 'Agustus',
                                        9  => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                    ?>

                                    <?php foreach ($namaBulan as $nomor => $nama): ?>

                                        <option
                                            value="<?= $nomor ?>"
                                            <?= old('periode_bulan') == $nomor ? 'selected' : '' ?>
                                        >
                                            <?= $nama ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>


                            <!-- TAHUN -->
                            <div class="periode-field">

                                <label for="periode_tahun">
                                    Tahun
                                </label>

                                <input
                                    type="number"
                                    name="periode_tahun"
                                    id="periode_tahun"
                                    value="<?= old('periode_tahun') ?>"
                                    placeholder="Contoh: 2026"
                                    min="2000"
                                    max="2100"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <!-- ==========================
                         KATEGORI
                    =========================== -->

                    <div class="penerima-form-group kategori-group">

                        <label for="kategori">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            id="kategori"
                            required
                        >

                            <option value="">
                                Pilih Kategori
                            </option>

                            <option
                                value="Penyandang Disabilitas"
                                <?= old('kategori') === 'Penyandang Disabilitas' ? 'selected' : '' ?>
                            >
                                Penyandang Disabilitas
                            </option>

                            <option
                                value="Lansia"
                                <?= old('kategori') === 'Lansia' ? 'selected' : '' ?>
                            >
                                Lansia
                            </option>

                            <option
                                value="Anak"
                                <?= old('kategori') === 'Anak' ? 'selected' : '' ?>
                            >
                                Anak
                            </option>

                            <option
                                value="Keluarga Penerima Manfaat"
                                <?= old('kategori') === 'Keluarga Penerima Manfaat' ? 'selected' : '' ?>
                            >
                                Keluarga Penerima Manfaat
                            </option>

                        </select>

                    </div>


                    <!-- ==========================
                         JUMLAH
                    =========================== -->

                    <div class="penerima-form-group jumlah-group">

                        <label for="jumlah">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            id="jumlah"
                            name="jumlah"
                            value="<?= old('jumlah') ?>"
                            min="0"
                            required
                        >

                    </div>

                </div>


                <!-- BUTTON -->
                <div class="penerima-form-actions">

                    <a
                        href="<?= base_url('admin/penerima-manfaat') ?>"
                        class="btn-penerima-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn-penerima-save"
                    >

                        <i class="bi bi-save"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>