<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/profil.css') ?>"
>


<div class="d-flex">


    <!-- =========================================
         SIDEBAR
    ========================================== -->

    <?= $this->include('admin/layout/sidebar') ?>


    <!-- =========================================
         CONTENT
    ========================================== -->

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid profil-create-page">


            <!-- =====================================
                 HEADER
            ====================================== -->

            <div class="profil-create-header">

                <h1>
                    Tambah Sejarah Dinas
                </h1>

                <p>
                    Kelola informasi profil dinas
                </p>

            </div>


            <!-- =====================================
                 FORM
            ====================================== -->

            <form
    action="<?= base_url('admin/profil/store') ?>"
    method="post"
    enctype="multipart/form-data"
>


                <div class="profil-form-grid">


                    <!-- =================================
                         KOLOM KIRI
                    ================================== -->

                    <div class="profil-form-left">


                        <!-- =============================
                             SEJARAH
                        ============================== -->

                        <div class="form-group editor-group">

                            <label>
                                Sejarah
                            </label>


                            <div class="editor-wrapper">

                                <div class="editor-toolbar">

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


                                <textarea
    name="sejarah"
    class="editor-area"
    placeholder=""
><?= esc($profil['sejarah'] ?? '') ?></textarea>

                            </div>

                        </div>


                        <!-- =============================
                             KONTAK
                        ============================== -->

                        <div class="form-group">

                            <label for="kontak">
                                Kontak
                            </label>

                            <input
    type="text"
    name="kontak"
    id="kontak"
    class="form-control-profil"
    value="<?= esc($profil['kontak'] ?? '') ?>"
>

                        </div>


                        <!-- =============================
                             EMAIL
                        ============================== -->

                        <div class="form-group">

                            <label for="email">
                                Email
                            </label>

                            <input
    type="email"
    name="email"
    id="email"
    class="form-control-profil"
    value="<?= esc($profil['email'] ?? '') ?>"
>

                        </div>


                        <!-- =============================
                             INSTAGRAM
                        ============================== -->

                        <div class="form-group">

                            <label for="instagram">
                                Instagram
                            </label>

                            <input
                                type="text"
                                name="instagram"
                                id="instagram"
                                class="form-control-profil"
                                value="<?= esc($profil['instagram'] ?? '') ?>"
                            >

                        </div>


                        <!-- =============================
                             FACEBOOK
                        ============================== -->

                        <div class="form-group">

                            <label for="facebook">
                                Facebook
                            </label>

                            <input
                                type="text"
                                name="facebook"
                                id="facebook"
                                class="form-control-profil"
                                value="<?= esc($profil['facebook'] ?? '') ?>"
                            >

                        </div>

<!-- MAKLUMAT PELAYANAN -->

<div class="form-section">

    <div class="form-section-header">

        <div>

            <h3>
               Maklumat Pelayanan
            </h3>

            <p>
                Masukkan maklumat pelayanan yang akan
                ditampilkan pada halaman profil.
            </p>

        </div>

    </div>


    <!-- =========================================
         EDITOR SASARAN STRATEGIS
    ========================================== -->

    <div class="form-group editor-group">

        <div class="editor-wrapper">

            <!-- =====================================
                 TOOLBAR
            ====================================== -->

            <div class="editor-toolbar">

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


            <!-- =====================================
                 INPUT
            ====================================== -->

            <textarea
                name="maklumat_pelayanan"
                class="editor-area"
                placeholder="Masukkan maklumat pelayanan..."
            ><?= esc($profil['maklumat_pelayanan'] ?? '') ?></textarea>

        </div>

    </div>

</div>
                    </div>


                    <!-- =================================
                         KOLOM KANAN
                    ================================== -->

                    <div class="profil-form-right">


                        <!-- =============================
                             VISI MISI
                        ============================== -->

                        <div class="form-group editor-group">

                            <label>
                                Visi 
                            </label>


                            <div class="editor-wrapper">

                                <div class="editor-toolbar">

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


                                <textarea
                                    name="visi"
                                    class="editor-area"
                                ><?= esc($profil['visi'] ?? '') ?></textarea>

                            </div>

                        </div>

                          <!-- =============================
                              MISI
                        ============================== -->

                        <div class="form-group editor-group">

                            <label>
                                Misi 
                            </label>


                            <div class="editor-wrapper">

                                <div class="editor-toolbar">

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


                                <textarea
                                    name="misi"
                                    class="editor-area"
                                ><?= esc($profil['misi'] ?? '') ?></textarea>

                            </div>

                        </div>

<!-- =====================================================
     SASARAN STRATEGIS
====================================================== -->

<div class="form-section">

    <div class="form-section-header">

        <div>

            <h3>
                Sasaran Strategis
            </h3>

            <p>
                Masukkan sasaran strategis yang akan
                ditampilkan pada halaman profil.
            </p>

        </div>

    </div>


    <!-- =========================================
         EDITOR SASARAN STRATEGIS
    ========================================== -->

    <div class="form-group editor-group">

        <div class="editor-wrapper">

            <!-- =====================================
                 TOOLBAR
            ====================================== -->

            <div class="editor-toolbar">

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


            <!-- =====================================
                 INPUT
            ====================================== -->

            <textarea
                name="sasaran_strategis"
                class="editor-area"
                placeholder="Masukkan sasaran strategis..."
            ><?= esc($profil['sasaran_strategis'] ?? '') ?></textarea>

        </div>

    </div>

</div>

                        <!-- =============================
                             STRUKTUR ORGANISASI
                        ============================== -->

                        <div class="form-group struktur-group">

                            <label>
                                Struktur Organisasi
                            </label>


                            <div class="upload-box">

                                <div class="upload-icon">

                                    <i class="bi bi-cloud-arrow-up"></i>

                                </div>


                                <div class="upload-title">

                                    Choose a file or drag & drop it here

                                </div>


                                <div class="upload-info">

                                    JPEG, PNG, PDG, and MP4 formats,
                                    up to 50MB

                                </div>


                                <label
                                    for="struktur"
                                    class="btn-browse"
                                >

                                    Browse File

                                </label>


                                <input
                                    type="file"
                                    name="struktur"
                                    id="struktur"
                                    accept=".jpg,.jpeg,.png,.pdf,.mp4"
                                    hidden
                                >

                            </div>

                        </div>


                        <!-- =============================
                             SIMPAN
                        ============================== -->

                        <div class="button-wrapper">

                            <button
                                type="submit"
                                class="btn-simpan-profil"
                            >

                                Simpan

                            </button>

                        </div>


                    </div>


                </div>


            </form>


        </div>

    </div>

</div>


<!-- =========================================
     FOOTER
========================================= -->

<?= $this->include('admin/layout/footer') ?>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================
       FILE UPLOAD
    ========================================= */

    const fileInput =
        document.getElementById('struktur');


    const uploadBox =
        document.querySelector('.upload-box');


    if (fileInput && uploadBox) {


        fileInput.addEventListener(
            'change',
            function () {

                if (this.files.length > 0) {

                    const fileName =
                        this.files[0].name;


                    const title =
                        uploadBox.querySelector(
                            '.upload-title'
                        );


                    title.textContent =
                        fileName;

                }

            }
        );


        /* DRAG & DROP */

        uploadBox.addEventListener(
            'dragover',
            function (event) {

                event.preventDefault();

                uploadBox.classList.add(
                    'drag-active'
                );

            }
        );


        uploadBox.addEventListener(
            'dragleave',
            function () {

                uploadBox.classList.remove(
                    'drag-active'
                );

            }
        );


        uploadBox.addEventListener(
            'drop',
            function (event) {

                event.preventDefault();

                uploadBox.classList.remove(
                    'drag-active'
                );


                if (event.dataTransfer.files.length) {

                    fileInput.files =
                        event.dataTransfer.files;


                    const title =
                        uploadBox.querySelector(
                            '.upload-title'
                        );


                    title.textContent =
                        event.dataTransfer.files[0].name;

                }

            }
        );

    }


});

</script>