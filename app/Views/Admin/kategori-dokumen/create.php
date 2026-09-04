<?= $this->include('Admin/layout/header'); ?>

<link rel="stylesheet"
      href="<?= base_url('assets/css/admin/kategoriDokumen.css'); ?>">


<div class="admin-container">

    <!-- SIDEBAR -->
    <?= $this->include('Admin/layout/sidebar'); ?>


    <!-- MAIN -->
    <div class="main-content">


        <!-- HEADER -->
        <div class="page-header">

            <div>

                <h1>
                    Tambah Kategori
                </h1>

                <p>
                    Tambahkan kategori dokumen baru
                </p>

            </div>


            <a
                href="<?= base_url('admin/dokumen'); ?>"
                class="btn-back"
            >

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>


        <!-- FORM CONTAINER -->
        <div class="form-container">


            <!-- ERROR -->
            <?php if (
                session()->getFlashdata('errors')
            ): ?>

                <div class="alert alert-danger">

                    <i class="fas fa-exclamation-circle"></i>

                    <div>

                        <?php foreach (
                            session()->getFlashdata('errors')
                            as $error
                        ): ?>

                            <div>
                                <?= esc($error); ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>


            <!-- ERROR SLUG -->
            <?php if (
                session()->getFlashdata('error')
            ): ?>

                <div class="alert alert-danger">

                    <i class="fas fa-exclamation-circle"></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ); ?>

                </div>

            <?php endif; ?>


            <!-- FORM -->
            <form
                action="<?= base_url('admin/kategori-dokumen/store'); ?>"
                method="post"
            >

                <?= csrf_field(); ?>


                <!-- NAMA KATEGORI -->
                <div class="form-group">

                    <label for="nama_kategori">

                        Nama Kategori

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        value="<?= old('nama_kategori'); ?>"
                        placeholder="Contoh: Laporan"
                        required
                    >

                    <small>
                        Masukkan nama kategori dokumen.
                    </small>

                </div>


                <!-- SLUG -->
                <div class="form-group">

                    <label for="slug">

                        Slug

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="<?= old('slug'); ?>"
                        placeholder="Contoh: laporan"
                        required
                    >

                    <small>
                        Gunakan huruf kecil dan tanda -
                        untuk memisahkan kata.
                    </small>

                </div>


                <!-- DESKRIPSI -->
                <div class="form-group">

                    <label for="deskripsi">

                        Deskripsi

                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Masukkan deskripsi kategori..."
                    ><?= old('deskripsi'); ?></textarea>

                    <small>
                        Deskripsi akan ditampilkan pada
                        bagian Kategori Dokumen.
                    </small>

                </div>


                <!-- BUTTON -->
                <div class="form-actions">

                    <a
                        href="<?= base_url('admin/dokumen'); ?>"
                        class="btn-cancel"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="btn-save"
                    >

                        <i class="fas fa-save"></i>

                        Simpan Kategori

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<?= $this->include('Admin/layout/footer'); ?>


<script>

    // ==========================================
    // OTOMATIS MEMBUAT SLUG
    // ==========================================

    const namaKategori =
        document.getElementById('nama_kategori');

    const slug =
        document.getElementById('slug');


    namaKategori.addEventListener(
        'input',
        function () {

            let value = this.value
                .toLowerCase()
                .trim()

                .replace(
                    /[^a-z0-9\s-]/g,
                    ''
                )

                .replace(
                    /\s+/g,
                    '-'
                )

                .replace(
                    /-+/g,
                    '-'
                );


            slug.value = value;

        }
    );

</script>