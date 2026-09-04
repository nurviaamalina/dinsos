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
                        Edit Kegiatan
                    </h1>

                    <p>
                        Perbarui data kegiatan.
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
                 FLASH MESSAGE
            ====================================================== -->

            <?php if (
                session()->getFlashdata('success')
            ) : ?>

                <div class="alert alert-success">

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                </div>

            <?php endif; ?>


            <?php if (
                session()->getFlashdata('error')
            ) : ?>

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
                action="<?= base_url(
                    'admin/kegiatan/update/' .
                    $kegiatan['id']
                ) ?>"
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
                                    value="<?= esc(
                                        $kegiatan['judul']
                                    ) ?>"
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
        value="<?= !empty($kegiatan['tanggal']) 
            ? date('d/m/Y', strtotime($kegiatan['tanggal'])) 
            : '' ?>"
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
                                 THUMBNAIL LAMA
                            ================================================== -->

                            <div class="form-group-kegiatan">

                                <label>
                                    Thumbnail
                                </label>


                                <?php if (
                                    !empty(
                                        $kegiatan['thumbnail']
                                    )
                                ) : ?>

                                    <div
                                        class="kegiatan-current-image"
                                    >

                                        <img
                                            src="<?= base_url(
                                                'uploads/kegiatan/thumbnail/' .
                                                $kegiatan['thumbnail']
                                            ) ?>"
                                            alt="Thumbnail kegiatan"
                                        >


                                        <small>
                                            Thumbnail saat ini
                                        </small>

                                    </div>

                                <?php endif; ?>


                                <!-- UPLOAD THUMBNAIL BARU -->

                                <div
                                    class="kegiatan-upload-box"
                                >

                                    <i
                                        class="bi bi-cloud-arrow-up"
                                    ></i>


                                    <p>
                                        Ganti thumbnail
                                    </p>


                                    <small>
                                        Kosongkan jika tidak ingin mengganti
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
                                        >

                                    </label>

                                </div>


                                <!-- PREVIEW THUMBNAIL BARU -->

                                <div
                                    class="kegiatan-uploaded-preview"
                                    id="thumbnailPreview"
                                >

                                    <h3>
                                        Thumbnail baru
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

                                            <i
                                                class="bi bi-trash"
                                            ></i>

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
                                    required
                                ><?= esc(
                                    $kegiatan['deskripsi']
                                ) ?></textarea>

                            </div>


                            <!-- =================================================
                                 DOKUMENTASI LAMA
                            ================================================== -->

                            <div
                                class="form-group-kegiatan"
                            >

                                <label>
                                    Dokumentasi Kegiatan
                                </label>


                                <?php if (
                                    !empty($foto)
                                ) : ?>

                                    <div
                                        class="kegiatan-existing-gallery"
                                    >

                                        <div
                                            class="kegiatan-existing-grid"
                                        >

                                            <?php foreach (
                                                $foto as $item
                                            ) : ?>

                                                <div
                                                    class="kegiatan-existing-item"
                                                >

                                                    <img
                                                        src="<?= base_url(
                                                            'uploads/kegiatan/dokumentasi/' .
                                                            $item['foto']
                                                        ) ?>"
                                                        alt="Dokumentasi kegiatan"
                                                    >


                                                    <a
                                                        href="<?= base_url(
                                                            'admin/kegiatan/delete-foto/' .
                                                            $item['id']
                                                        ) ?>"
                                                        class="kegiatan-delete-foto"
                                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                                    >

                                                        <i
                                                            class="bi bi-trash"
                                                        ></i>

                                                    </a>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                    </div>

                                <?php else : ?>

                                    <div
                                        class="kegiatan-no-foto"
                                    >

                                        Belum ada dokumentasi.

                                    </div>

                                <?php endif; ?>

                            </div>


                            <!-- =================================================
                                 TAMBAH DOKUMENTASI
                            ================================================== -->

                            <div
                                class="form-group-kegiatan"
                            >

                                <label>
                                    Tambah Dokumentasi
                                </label>


                                <div
                                    class="kegiatan-upload-box"
                                >

                                    <i
                                        class="bi bi-images"
                                    ></i>


                                    <p>
                                        Tambahkan dokumentasi baru
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


                                <!-- PREVIEW DOKUMENTASI BARU -->

                                <div
                                    class="kegiatan-dokumentasi-preview"
                                    id="dokumentasiPreview"
                                >

                                    <h3>
                                        Dokumentasi baru
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
                                    href="<?= base_url(
                                        'admin/kegiatan'
                                    ) ?>"
                                    class="btn-batal-kegiatan"
                                >

                                    Batal

                                </a>


                                <button
                                    type="submit"
                                    class="btn-simpan-kegiatan"
                                >

                                    <i class="bi bi-save"></i>

                                    Simpan Perubahan

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

            thumbnailPreview.style.display =
                'none';

            return;
        }


        const reader =
            new FileReader();


        reader.onload = function (e) {

            thumbnailImage.src =
                e.target.result;

            thumbnailFileName.textContent =
                file.name;

            thumbnailPreview.style.display =
                'block';

        };


        reader.readAsDataURL(file);

    });


    removeThumbnail.addEventListener(
        'click',
        function () {

            thumbnailInput.value = '';

            thumbnailImage.src = '';

            thumbnailFileName.textContent = '';

            thumbnailPreview.style.display =
                'none';

        }
    );



    /* =====================================================
       DOKUMENTASI
    ====================================================== */

    const dokumentasiInput =
        document.getElementById(
            'dokumentasiInput'
        );

    const dokumentasiPreview =
        document.getElementById(
            'dokumentasiPreview'
        );

    const dokumentasiPreviewGrid =
        document.getElementById(
            'dokumentasiPreviewGrid'
        );


    dokumentasiInput.addEventListener(
        'change',
        function () {

            dokumentasiPreviewGrid.innerHTML =
                '';


            const files =
                Array.from(this.files);


            if (
                files.length === 0
            ) {

                dokumentasiPreview.style.display =
                    'none';

                return;
            }


            dokumentasiPreview.style.display =
                'block';


            files.forEach(
                function (file) {

                    const reader =
                        new FileReader();


                    reader.onload =
                        function (e) {

                            const item =
                                document.createElement(
                                    'div'
                                );


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


                            dokumentasiPreviewGrid
                                .appendChild(item);

                        };


                    reader.readAsDataURL(file);

                }
            );

        }
    );

});

</script>


<?= $this->include('admin/layout/footer') ?>