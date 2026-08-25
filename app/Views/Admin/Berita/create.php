<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/berita.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">


            <!-- Judul.header  dan tombol kembali -->

            <div class="berita-form-header">

                <div>

                    <h1>
                        Form Tambah Berita
                    </h1>

                    <p>
                        Tambahkan berita baru ke dalam website.
                    </p>

                </div>


                <a
                    href="<?= base_url('admin/berita') ?>"
                    class="btn-kembali-berita"
                >

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>


            </div>


        </div>

        <div class ="container-fluid">
            <!-- FORM -->
                 

            <form
                action="<?= base_url('admin/berita/store') ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>


                <div class="berita-form-container">


                    <!-- KOLOM KIRI -->

                    <div class="berita-form-left">


                        <!-- JUDUL BERITA -->

                        <div class="form-group-berita">

                            <label>
                                Judul Berita
                            </label>

                            <input
                                type="text"
                                name="judul"
                                placeholder="Masukkan judul berita"
                                required
                            >

                        </div>


                        <!-- SLUG -->

                        <div class="form-group-berita">

                            <label>
                                Slug
                            </label>

                            <input
                                type="text"
                                name="slug"
                                placeholder="contoh-judul-berita"
                                required
                            >

                        </div>


                        <!-- PENULIS -->

                        <div class="form-group-berita">

                            <label>
                                Penulis
                            </label>

                            <input
                                type="text"
                                name="publikator"
                                placeholder="Nama penulis"
                                required
                            >

                        </div>


                        <!-- TANGGAL -->

                        <div class="form-group-berita">

                           <label for="tanggal">
                                    Tanggal
                                </label>

                                <div class="input-icon">

                                    <input
                                        type="text"
                                        id="tanggal"
                                        name="tanggal"
                                        class="form-control"
                                        placeholder="DD/MM/YYYY"
                                        maxlength="10"
                                        autocomplete="off"
                                        inputmode="numeric"
                                    >


                                </div>

                                <small id="tanggalError" class="tanggal-error"></small>

                        </div>


                        <!-- UPLOAD THUMBNAIL -->

                        <div class="form-group-berita">
                            <label>
                                    Upload Thumbnail
                                </label>

                                <!-- UPLOAD BOX -->
                                <div
                                    class="upload-box-berita"
                                    id="uploadBox"
                                >

                                    <i class="bi bi-cloud-arrow-up"></i>

                                    <p>
                                        Choose a file or drag & drop it here
                                    </p>

                                    <small>
                                        JPEG, PNG, JPG, maksimal 2MB
                                    </small>

                                    <label class="browse-button">

                                        Browse File

                                        <input
                                            type="file"
                                            id="gambar"
                                            name="gambar"
                                            accept=".jpg,.jpeg,.png"
                                            required
                                        >

                                    </label>

                                </div>


                                <!-- PREVIEW -->
                                <div
                                    class="uploaded-preview"
                                    id="uploadedPreview"
                                >

                                    <h3>
                                        Uploaded
                                    </h3>

                                    <div
                                        class="uploaded-item"
                                        id="uploadedItem"
                                    >

                                        <div class="uploaded-thumbnail">

                                            <img
                                                id="previewImage"
                                                src=""
                                                alt="Preview Thumbnail"
                                            >

                                        </div>

                                        <div class="uploaded-name">
                                            <span id="fileName"></span>
                                        </div>

                                        <button
                                            type="button"
                                            class="delete-upload"
                                            id="deleteUpload"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>

                                    </div>

                                </div>

                                <!-- ERROR -->
                                <small
                                    class="upload-error"
                                    id="uploadError"
                                ></small>

                        </div>


                    </div>


                    <!-- KOLOM KANAN -->

                    <div class="berita-form-right">


                        <!-- ISI BERITA -->

                        <div class="form-group-berita isi-berita-group">

                            <label>
                                Isi Berita
                            </label>

                            <textarea
                                name="isi"
                                placeholder="Tuliskan isi berita..."
                                required
                            ></textarea>

                        </div>


                        <!-- TOMBOL -->

                        <div class="berita-form-actions">

                            <button
                                type="submit"
                                name="status"
                                value="draft"
                                class="btn-draft-berita"
                            >

                                Draf

                            </button>


                            <button
                                type="submit"
                                name="status"
                                value="publik"
                                class="btn-publikasi-berita"
                            >

                                Simpan &amp; Publikasi

                            </button>

                        </div>


                    </div>


                </div>

            </form>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       TANGGAL
    ===================================================== */

    const tanggalInput = document.getElementById('tanggal');
    const tanggalError = document.getElementById('tanggalError');

    if (tanggalInput) {

        tanggalInput.addEventListener('input', function () {

            // Hanya angka
            let value = this.value.replace(/\D/g, '');

            // Maksimal DDMMYYYY
            value = value.substring(0, 8);

            let formatted = '';

            // ==============================
            // TANGGAL
            // ==============================

            if (value.length > 0) {

                let day = value.substring(0, 2);

                if (parseInt(day) > 31) {
                    day = '31';
                }

                formatted = day;
            }


            // ==============================
            // BULAN
            // ==============================

            if (value.length >= 3) {

                let month = value.substring(2, 4);

                if (parseInt(month) > 12) {
                    month = '12';
                }

                formatted += '/' + month;
            }


            // ==============================
            // TAHUN
            // ==============================

            if (value.length >= 5) {

                let year = value.substring(4, 8);

                formatted += '/' + year;
            }


            this.value = formatted;

            validateTanggal();

        });

    }


    function validateTanggal() {

        if (!tanggalInput || !tanggalError) {
            return;
        }

        const value = tanggalInput.value;

        tanggalError.textContent = '';

        // Belum lengkap
        if (value.length < 10) {
            return;
        }

        const parts = value.split('/');

        const day = parseInt(parts[0]);
        const month = parseInt(parts[1]);
        const year = parseInt(parts[2]);


        // Cek bulan
        if (month < 1 || month > 12) {

            tanggalError.textContent =
                'Bulan harus antara 01 sampai 12.';

            return;
        }


        // Jumlah hari dalam bulan
        const jumlahHari =
            new Date(year, month, 0).getDate();


        // Cek tanggal
        if (day < 1 || day > jumlahHari) {

            tanggalError.textContent =
                `Tanggal tidak valid. Bulan ${String(month).padStart(2, '0')} hanya memiliki ${jumlahHari} hari.`;

            return;
        }

    }


    /* =====================================================
       UPLOAD THUMBNAIL
    ===================================================== */

    const gambarInput =
        document.getElementById('gambar');

    const uploadBox =
        document.getElementById('uploadBox');

    const uploadedPreview =
        document.getElementById('uploadedPreview');

    const previewImage =
        document.getElementById('previewImage');

    const fileName =
        document.getElementById('fileName');

    const deleteUpload =
        document.getElementById('deleteUpload');

    const uploadError =
        document.getElementById('uploadError');


    // Pastikan element tersedia
    if (
        !gambarInput ||
        !uploadBox ||
        !uploadedPreview ||
        !previewImage ||
        !fileName ||
        !deleteUpload ||
        !uploadError
    ) {

        console.error(
            'Element upload thumbnail tidak ditemukan.'
        );

        return;
    }


    /* =====================================================
       PILIH FILE
    ===================================================== */

    gambarInput.addEventListener('change', function () {

        const file = this.files[0];

        uploadError.textContent = '';


        // Tidak ada file
        if (!file) {
            return;
        }


        /* =================================================
           VALIDASI FORMAT
        ================================================= */

        const allowedTypes = [
            'image/jpeg',
            'image/png'
        ];

        if (!allowedTypes.includes(file.type)) {

            uploadError.textContent =
                'Format file harus JPG, JPEG, atau PNG.';

            this.value = '';

            return;
        }


        /* =================================================
           VALIDASI UKURAN
        ================================================= */

        const maxSize =
            5 * 1024 * 1024;

        if (file.size > maxSize) {

            uploadError.textContent =
                'Ukuran file maksimal 2MB.';

            this.value = '';

            return;
        }


        /* =================================================
           NAMA FILE
        ================================================= */

        fileName.textContent =
            file.name;


        /* =================================================
           PREVIEW
        ================================================= */

        const reader =
            new FileReader();


        reader.onload = function (event) {

            // Masukkan gambar ke preview
            previewImage.src =
                event.target.result;


            // Sembunyikan upload box
            uploadBox.style.display =
                'none';


            // Tampilkan preview
            uploadedPreview.style.display =
                'block';

        };


        reader.readAsDataURL(file);

    });


    /* =====================================================
       HAPUS FILE
    ===================================================== */

    deleteUpload.addEventListener('click', function () {

        // Kosongkan input file
        gambarInput.value = '';


        // Hapus preview gambar
        previewImage.src = '';


        // Hapus nama file
        fileName.textContent = '';


        // Sembunyikan preview
        uploadedPreview.style.display =
            'none';


        // Tampilkan kembali upload box
        uploadBox.style.display =
            'flex';


        // Hapus pesan error
        uploadError.textContent = '';

    });

});

</script>

<?= $this->include('admin/layout/footer') ?>