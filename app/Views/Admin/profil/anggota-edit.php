<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/profil.css') ?>"
>


<div class="d-flex">

    <!-- SIDEBAR -->

    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid anggota-create-page">


            <!-- =========================================
                 HEADER
            ========================================== -->

            <div class="anggota-create-header">

                <h1>
                    Edit Anggota Dinas
                </h1>

                <p>
                    Kelola informasi profil dinas
                </p>

            </div>


            <!-- =========================================
                 ERROR
            ========================================== -->

            <?php if (session()->getFlashdata('errors')): ?>

                <div class="alert alert-danger">

                    <?php foreach (
                        session()->getFlashdata('errors') as $error
                    ): ?>

                        <div>
                            <?= esc($error) ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <!-- =========================================
                 FORM
            ========================================== -->

            <form
                action="<?= base_url(
                    'admin/profil/anggota/update/' . $anggota['id']
                ) ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <div class="anggota-form-grid">


                    <!-- =================================
                         KOLOM KIRI
                    ================================== -->

                    <div class="anggota-form-left">


                        <!-- =============================
                             NAMA
                        ============================== -->

                        <div class="anggota-form-group">

                            <label for="nama">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="anggota-input"
                                value="<?= esc($anggota['nama'] ?? '') ?>"
                                required
                            >

                        </div>


                        <!-- =============================
                             JABATAN
                        ============================== -->

                        <div class="anggota-form-group">

                            <label for="jabatan">
                                Jabatan
                            </label>

                            <input
                                type="text"
                                name="jabatan"
                                id="jabatan"
                                class="anggota-input"
                                value="<?= esc($anggota['jabatan'] ?? '') ?>"
                                required
                            >

                        </div>


                        <!-- =============================
                             BIDANG
                        ============================== -->

                        <div class="anggota-form-group">

                            <label for="bidang">
                                Bidang
                            </label>

                            <input
                                type="text"
                                name="bidang"
                                id="bidang"
                                class="anggota-input"
                                value="<?= esc($anggota['bidang'] ?? '') ?>"
                                required
                            >

                        </div>


                        <!-- =============================
                             CAPTION
                        ============================== -->

                        <div class="anggota-form-group caption-group">

                            <label for="caption">
                                Caption
                            </label>


                            <div class="caption-editor">


                                <!-- TOOLBAR -->

                                <div class="caption-toolbar">

                                    <button type="button">
                                        <strong>B</strong>
                                    </button>

                                    <button type="button">
                                        <em>I</em>
                                    </button>

                                    <button type="button">
                                        <u>U</u>
                                    </button>

                                    <button type="button">
                                        <span>A:</span>
                                    </button>


                                    <span class="toolbar-divider"></span>


                                    <button type="button">
                                        <i class="bi bi-text-left"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-text-center"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-list-ol"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-list-ul"></i>
                                    </button>


                                    <span class="toolbar-divider"></span>


                                    <button type="button">
                                        <i class="bi bi-link-45deg"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-image"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>

                                    <button type="button">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>


                                    <span class="toolbar-spacer"></span>


                                    <button
                                        type="button"
                                        disabled
                                    >
                                        ↶
                                    </button>

                                    <button
                                        type="button"
                                        disabled
                                    >
                                        ↷
                                    </button>

                                    <button type="button">
                                        ⋮
                                    </button>

                                </div>


                                <!-- CAPTION LAMA -->

                                <textarea
                                    name="caption"
                                    id="caption"
                                    class="caption-area"
                                ><?= esc($anggota['caption'] ?? '') ?></textarea>

                            </div>

                        </div>

                    </div>


                    <!-- =================================
                         KOLOM KANAN
                    ================================== -->

                    <div class="anggota-form-right">


                        <!-- =============================
                             FOTO
                        ============================== -->

                        <div class="foto-form-group">

                            <label>
                                Upload Foto Profil
                            </label>


                            <!-- FOTO LAMA -->

                            <?php if (!empty($anggota['foto'])): ?>

                                <div class="foto-lama-wrapper">

                                    <img
                                        src="<?= base_url(
                                            'uploads/profil/' . $anggota['foto']
                                        ) ?>"
                                        alt="<?= esc($anggota['nama']) ?>"
                                        class="foto-lama"
                                    >

                                    <div class="foto-lama-text">
                                        Foto saat ini
                                    </div>

                                </div>

                            <?php endif; ?>


                            <!-- UPLOAD BOX -->

                            <div
                                class="foto-upload-box"
                                id="fotoUploadBox"
                            >

                                <div class="foto-upload-icon">

                                    <i class="bi bi-cloud-arrow-up"></i>

                                </div>


                                <div class="foto-upload-title">

                                    Choose a file or drag & drop it here

                                </div>


                                <div class="foto-upload-info">

                                    JPEG, PNG, PDG, and MP4 formats,
                                    up to 50MB

                                </div>


                                <label
                                    for="foto"
                                    class="btn-browse-foto"
                                >

                                    Browse File

                                </label>


                                <input
                                    type="file"
                                    name="foto"
                                    id="foto"
                                    accept=".jpg,.jpeg,.png"
                                    hidden
                                >

                            </div>


                            <!-- PREVIEW FOTO BARU -->

                            <div
                                class="foto-preview-wrapper"
                                id="fotoPreviewWrapper"
                            >

                                <img
                                    src=""
                                    id="fotoPreview"
                                    alt="Preview"
                                >

                            </div>

                        </div>


                        <!-- =============================
                             SIMPAN
                        ============================== -->

                        <div class="anggota-button-wrapper">

                            <button
                                type="submit"
                                class="btn-simpan-anggota"
                            >

                                Simpan Perubahan

                            </button>

                        </div>


                    </div>


                </div>

            </form>


        </div>

    </div>

</div>


<!-- FOOTER -->

<?= $this->include('admin/layout/footer') ?>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const fileInput =
            document.getElementById('foto');


        const uploadBox =
            document.getElementById('fotoUploadBox');


        const previewWrapper =
            document.getElementById(
                'fotoPreviewWrapper'
            );


        const preview =
            document.getElementById('fotoPreview');


        const title =
            document.querySelector(
                '.foto-upload-title'
            );


        /* =========================================
           FILE SELECT
        ========================================= */

        fileInput.addEventListener(
            'change',
            function () {

                if (this.files.length > 0) {

                    previewFoto(
                        this.files[0]
                    );

                }

            }
        );


        /* =========================================
           DRAG OVER
        ========================================= */

        uploadBox.addEventListener(
            'dragover',
            function (event) {

                event.preventDefault();

                uploadBox.classList.add(
                    'drag-active'
                );

            }
        );


        /* =========================================
           DRAG LEAVE
        ========================================= */

        uploadBox.addEventListener(
            'dragleave',
            function () {

                uploadBox.classList.remove(
                    'drag-active'
                );

            }
        );


        /* =========================================
           DROP
        ========================================= */

        uploadBox.addEventListener(
            'drop',
            function (event) {

                event.preventDefault();

                uploadBox.classList.remove(
                    'drag-active'
                );


                if (
                    event.dataTransfer.files.length
                ) {

                    fileInput.files =
                        event.dataTransfer.files;


                    previewFoto(
                        event.dataTransfer.files[0]
                    );

                }

            }
        );


        /* =========================================
           PREVIEW
        ========================================= */

        function previewFoto(file)
        {

            if (!file) {
                return;
            }


            if (!file.type.startsWith('image/')) {

                alert(
                    'File harus berupa gambar.'
                );

                return;

            }


            title.textContent =
                file.name;


            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    preview.src =
                        event.target.result;

                    previewWrapper.style.display =
                        'block';

                };


            reader.readAsDataURL(file);

        }

    }
);

</script>