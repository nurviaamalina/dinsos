<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/kegiatan.css') ?>"
>


<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">


            <!-- =====================================================
                 HEADER
            ====================================================== -->

            <div class="kegiatan-form-header">

                <div>

                    <h1>
                        Tambah Kegiatan
                    </h1>

                    <p>
                        Tambahkan data kegiatan baru.
                    </p>

                </div>


                <a
                    href="<?= base_url('admin/kegiatan') ?>"
                    class="btn-kembali-kegiatan"
                >

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>


            <!-- =====================================================
                 FLASH ERROR
            ====================================================== -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- =====================================================
                 FORM
            ====================================================== -->

            <form
                action="<?= base_url('admin/kegiatan/store') ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>


                <div class="kegiatan-form-card">


                    <div class="kegiatan-form-container">


                        <!-- =================================================
                             LEFT
                        ================================================== -->

                        <div class="kegiatan-form-left">


                            <!-- JUDUL -->

                            <div class="form-group-kegiatan">

                                <label>
                                    Judul Kegiatan
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    value="<?= old('judul') ?>"
                                    placeholder="Masukkan judul kegiatan"
                                    required
                                >

                            </div>


                            <!-- TANGGAL -->

                            <div class="form-group-kegiatan">

    <label for="tanggal">
        Tanggal Kegiatan
    </label>

    <input
        type="text"
        id="tanggal"
        name="tanggal"
        value="<?= old('tanggal') ?>"
        placeholder="DD/MM/YYYY"
        maxlength="10"
        autocomplete="off"
        inputmode="numeric"
        required
    >

    <small
        id="tanggalError"
        class="tanggal-error"
    ></small>

</div>


                            <!-- =================================================
                                 THUMBNAIL
                            ================================================== -->

                            <div class="form-group-kegiatan">

                                <label>
                                    Thumbnail
                                </label>


                                <div
                                    class="kegiatan-upload-box"
                                    id="thumbnailUploadBox"
                                >

                                    <i
                                        class="bi bi-cloud-arrow-up"
                                    ></i>


                                    <p>
                                        Pilih thumbnail kegiatan
                                    </p>


                                    <small>
                                        JPG, JPEG, PNG, WEBP
                                    </small>


                                    <label
                                        class="browse-button-kegiatan"
                                    >

                                        Browse File

                                        <input
                                            type="file"
                                            name="thumbnail"
                                            id="thumbnailInput"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            required
                                        >

                                    </label>

                                </div>


                                <!-- PREVIEW THUMBNAIL -->

                                <div
                                    class="kegiatan-uploaded-preview"
                                    id="thumbnailPreview"
                                >

                                    <h3>
                                        Gambar dipilih
                                    </h3>


                                    <div
                                        class="kegiatan-uploaded-item"
                                    >

                                        <div
                                            class="kegiatan-uploaded-thumbnail"
                                        >

                                            <img
                                                id="thumbnailPreviewImage"
                                                src=""
                                                alt="Preview thumbnail"
                                            >

                                        </div>


                                        <div
                                            class="kegiatan-uploaded-name"
                                        >

                                            <span
                                                id="thumbnailFileName"
                                            ></span>

                                        </div>


                                        <button
                                            type="button"
                                            class="delete-upload-kegiatan"
                                            id="removeThumbnail"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             RIGHT
                        ================================================== -->

                        <div class="kegiatan-form-right">


                            <!-- DESKRIPSI -->

                            <div
                                class="form-group-kegiatan"
                            >

                                <label>
                                    Deskripsi Kegiatan
                                </label>


                                <textarea
                                    name="deskripsi"
                                    placeholder="Tuliskan deskripsi kegiatan..."
                                    required
                                ><?= old('deskripsi') ?></textarea>

                            </div>


                            <!-- =================================================
                                 DOKUMENTASI
                            ================================================== -->

                            <div
                                class="form-group-kegiatan"
                            >

                                <label>
                                    Dokumentasi Kegiatan
                                </label>


                                <div
                                    class="kegiatan-upload-box"
                                    id="dokumentasiUploadBox"
                                >

                                    <i
                                        class="bi bi-images"
                                    ></i>


                                    <p>
                                        Upload dokumentasi kegiatan
                                    </p>


                                    <small>
                                        Bisa memilih lebih dari satu gambar
                                    </small>


                                    <label
                                        class="browse-button-kegiatan"
                                    >

                                        Browse File

                                        <input
                                            type="file"
                                            name="dokumentasi[]"
                                            id="dokumentasiInput"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            multiple
                                        >

                                    </label>

                                </div>


                                <!-- PREVIEW DOKUMENTASI -->

                                <div
                                    class="kegiatan-dokumentasi-preview"
                                    id="dokumentasiPreview"
                                >

                                    <h3>
                                        Dokumentasi dipilih
                                    </h3>


                                    <div
                                        class="kegiatan-preview-grid"
                                        id="dokumentasiPreviewGrid"
                                    >
                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 ACTION
                            ================================================== -->

                            <div
                                class="kegiatan-form-actions"
                            >

                                <a
                                    href="<?= base_url('admin/kegiatan') ?>"
                                    class="btn-batal-kegiatan"
                                >

                                    Batal

                                </a>


                                <button
                                    type="submit"
                                    class="btn-simpan-kegiatan"
                                >

                                    <i class="bi bi-save"></i>

                                    Simpan Kegiatan

                                </button>

                            </div>


                        </div>


                    </div>

                </div>

            </form>


        </div>

    </div>

</div>


<!-- =========================================================
     PREVIEW JAVASCRIPT
========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       THUMBNAIL
    ====================================================== */

    const thumbnailInput =
        document.getElementById('thumbnailInput');

    const thumbnailPreview =
        document.getElementById('thumbnailPreview');

    const thumbnailImage =
        document.getElementById('thumbnailPreviewImage');

    const thumbnailFileName =
        document.getElementById('thumbnailFileName');

    const removeThumbnail =
        document.getElementById('removeThumbnail');


    thumbnailInput.addEventListener('change', function () {

        const file = this.files[0];


        if (!file) {

            thumbnailPreview.style.display = 'none';

            return;
        }


        const reader = new FileReader();


        reader.onload = function (e) {

            thumbnailImage.src = e.target.result;

            thumbnailFileName.textContent =
                file.name;

            thumbnailPreview.style.display =
                'block';
        };


        reader.readAsDataURL(file);

    });


    removeThumbnail.addEventListener('click', function () {

        thumbnailInput.value = '';

        thumbnailImage.src = '';

        thumbnailFileName.textContent = '';

        thumbnailPreview.style.display = 'none';

    });



    /* =====================================================
       DOKUMENTASI
    ====================================================== */

    const dokumentasiInput =
        document.getElementById('dokumentasiInput');

    const dokumentasiPreview =
        document.getElementById('dokumentasiPreview');

    const dokumentasiPreviewGrid =
        document.getElementById('dokumentasiPreviewGrid');


    dokumentasiInput.addEventListener('change', function () {

        dokumentasiPreviewGrid.innerHTML = '';


        const files =
            Array.from(this.files);


        if (files.length === 0) {

            dokumentasiPreview.style.display =
                'none';

            return;
        }


        dokumentasiPreview.style.display =
            'block';


        files.forEach(function (file) {

            const reader =
                new FileReader();


            reader.onload = function (e) {

                const item =
                    document.createElement('div');

                item.className =
                    'kegiatan-preview-item';


                item.innerHTML = `

                    <div class="kegiatan-preview-image">

                        <img
                            src="${e.target.result}"
                            alt="${file.name}"
                        >

                    </div>

                    <div class="kegiatan-preview-info">

                        <span>
                            ${file.name}
                        </span>

                    </div>

                `;


                dokumentasiPreviewGrid.appendChild(item);

            };


            reader.readAsDataURL(file);

        });

    });

});


/* =====================================================
   FORMAT TANGGAL
====================================================== */

const tanggalInput =
    document.getElementById('tanggal');

const tanggalError =
    document.getElementById('tanggalError');


if (tanggalInput) {

    tanggalInput.addEventListener(
        'input',
        function () {

            let value =
                this.value.replace(/\D/g, '');

            value =
                value.substring(0, 8);


            let formatted = '';


            /* HARI */

            if (value.length > 0) {

                let day =
                    value.substring(0, 2);

                if (parseInt(day) > 31) {

                    day = '31';

                }

                formatted = day;

            }


            /* BULAN */

            if (value.length >= 3) {

                let month =
                    value.substring(2, 4);

                if (parseInt(month) > 12) {

                    month = '12';

                }

                formatted +=
                    '/' + month;

            }


            /* TAHUN */

            if (value.length >= 5) {

                let year =
                    value.substring(4, 8);

                formatted +=
                    '/' + year;

            }


            this.value =
                formatted;


            validateTanggal();

        }
    );


    function validateTanggal() {

        tanggalError.textContent = '';


        const value =
            tanggalInput.value;


        if (value.length < 10) {

            return;

        }


        const parts =
            value.split('/');


        const day =
            parseInt(parts[0]);


        const month =
            parseInt(parts[1]);


        const year =
            parseInt(parts[2]);


        if (
            month < 1 ||
            month > 12
        ) {

            tanggalError.textContent =
                'Bulan harus antara 01 sampai 12.';

            return;

        }


        const jumlahHari =
            new Date(
                year,
                month,
                0
            ).getDate();


        if (
            day < 1 ||
            day > jumlahHari
        ) {

            tanggalError.textContent =
                `Tanggal tidak valid. Bulan ${String(month).padStart(2, '0')} hanya memiliki ${jumlahHari} hari.`;

        }

    }

}

</script>


<?= $this->include('admin/layout/footer') ?>