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
                        Import Data Kegiatan Lama
                    </h1>

                    <p>
                        Import data kegiatan lama menggunakan file Excel
                        dan ZIP gambar.
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
                 CARD IMPORT
            ====================================================== -->

            <div class="import-card">

                <div class="import-card-body">


                    <!-- =================================================
                         PETUNJUK IMPORT
                    ================================================== -->

                    <div class="import-info">

                        <div class="import-section-title">

                            <i class="bi bi-info-circle"></i>

                            <strong>
                                Petunjuk Import
                            </strong>

                        </div>


                        <ul>

                            <li>
                                Pilih file Excel yang berisi data
                                kegiatan lama.
                            </li>

                            <li>
                                Data kegiatan harus berada pada sheet
                                <strong>KEGIATAN</strong>.
                            </li>

                            <li>
                                Kolom Excel harus mengikuti format
                                yang telah disediakan.
                            </li>

                            <li>
                                Pilih file ZIP yang berisi thumbnail
                                dan foto dokumentasi kegiatan.
                            </li>

                            <li>
                                Nama file gambar pada Excel harus sama
                                dengan nama file gambar yang ada di ZIP.
                            </li>

                            <li>
                                Jika satu kegiatan memiliki beberapa
                                dokumentasi, pisahkan nama file dengan
                                tanda koma.
                            </li>

                        </ul>

                    </div>


                    <!-- =================================================
                         FORMAT EXCEL
                    ================================================== -->

                    <div class="import-format-card">

                        <div class="import-section-title">

                            <i class="bi bi-file-earmark-excel"></i>

                            Format Excel

                        </div>


                        <p class="import-description">

                            Gunakan sheet dengan nama
                            <strong>KEGIATAN</strong>
                            dan susunan kolom berikut:

                        </p>


                        <div class="import-table-wrapper">

                            <table class="import-format-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Kolom
                                        </th>

                                        <th>
                                            Nama Kolom
                                        </th>

                                        <th>
                                            Keterangan
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <tr>

                                        <td>
                                            A
                                        </td>

                                        <td>
                                            Kode Kegiatan
                                        </td>

                                        <td>
                                            Kode unik kegiatan.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            B
                                        </td>

                                        <td>
                                            Judul Kegiatan
                                        </td>

                                        <td>
                                            Judul atau nama kegiatan.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            C
                                        </td>

                                        <td>
                                            Deskripsi
                                        </td>

                                        <td>
                                            Deskripsi lengkap kegiatan.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            D
                                        </td>

                                        <td>
                                            Tanggal
                                        </td>

                                        <td>
                                            Tanggal kegiatan dengan format
                                            <strong>DD/MM/YYYY</strong>.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            E
                                        </td>

                                        <td>
                                            Tahun
                                        </td>

                                        <td>
                                            Tahun kegiatan.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            F
                                        </td>

                                        <td>
                                            Thumbnail
                                        </td>

                                        <td>
                                            Nama file thumbnail yang ada
                                            di dalam ZIP.
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            G
                                        </td>

                                        <td>
                                            Dokumentasi
                                        </td>

                                        <td>
                                            Nama file dokumentasi.
                                            Jika lebih dari satu,
                                            pisahkan dengan koma.
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>


                    <!-- =================================================
                         FORM
                    ================================================== -->

                    <form
                        action="<?= base_url('admin/kegiatan/import') ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


                        <!-- =============================================
                             EXCEL
                        ============================================== -->

                        <div class="import-upload-group">

                            <label>

                                <i class="bi bi-file-earmark-excel"></i>

                                File Excel Kegiatan

                            </label>


                            <div
                                class="import-upload-box"
                                id="excelUploadBox"
                            >

                                <i class="bi bi-cloud-arrow-up"></i>


                                <p>
                                    Choose a file or drag & drop it here
                                </p>


                                <small>
                                    XLSX, XLS
                                </small>


                                <label class="import-browse-button">

                                    Browse File

                                    <input
                                        type="file"
                                        name="excel"
                                        id="excel"
                                        accept=".xlsx,.xls"
                                        required
                                    >

                                </label>

                            </div>


                            <!-- PREVIEW -->

                            <div
                                class="import-file-preview"
                                id="excelPreview"
                            >

                                <div class="import-file-icon">

                                    <i class="bi bi-file-earmark-excel"></i>

                                </div>


                                <div class="import-file-info">

                                    <strong id="excelName"></strong>

                                    <small id="excelSize"></small>

                                </div>


                                <button
                                    type="button"
                                    class="import-remove-file"
                                    id="removeExcel"
                                >

                                    <i class="bi bi-trash3"></i>

                                </button>

                            </div>


                            <small
                                class="import-file-error"
                                id="excelError"
                            ></small>

                        </div>


                        <!-- =============================================
                             ZIP
                        ============================================== -->

                        <div class="import-upload-group">

                            <label>

                                <i class="bi bi-file-earmark-zip"></i>

                                ZIP Gambar Kegiatan

                            </label>


                            <div
                                class="import-upload-box"
                                id="zipUploadBox"
                            >

                                <i class="bi bi-cloud-arrow-up"></i>


                                <p>
                                    Choose a file or drag & drop it here
                                </p>


                                <small>
                                    ZIP
                                </small>


                                <label class="import-browse-button">

                                    Browse File

                                    <input
                                        type="file"
                                        name="zip"
                                        id="zip"
                                        accept=".zip"
                                        required
                                    >

                                </label>

                            </div>


                            <!-- PREVIEW ZIP -->

                            <div
                                class="import-file-preview"
                                id="zipPreview"
                            >

                                <div class="import-file-icon">

                                    <i class="bi bi-file-earmark-zip"></i>

                                </div>


                                <div class="import-file-info">

                                    <strong id="zipName"></strong>

                                    <small id="zipSize"></small>

                                </div>


                                <button
                                    type="button"
                                    class="import-remove-file"
                                    id="removeZip"
                                >

                                    <i class="bi bi-trash3"></i>

                                </button>

                            </div>


                            <small
                                class="import-file-error"
                                id="zipError"
                            ></small>

                        </div>


                        <!-- =================================================
                             PETUNJUK ZIP
                        ================================================== -->

                        <div class="import-zip-info">

                            <div class="import-section-title">

                                <i class="bi bi-folder2-open"></i>

                                Petunjuk Isi ZIP

                            </div>


                            <p>

                                ZIP harus berisi folder
                                <strong>KEGIATAN</strong>
                                yang berisi thumbnail dan seluruh
                                foto dokumentasi kegiatan.

                            </p>


                            <div class="zip-structure">

<pre>KEGIATAN/
├── KG001.jpg
├── KG001-1.jpg
├── KG001-2.jpg
├── KG001-3.jpg
└── KG002.jpg</pre>

                            </div>


                            <small>

                                <strong>Contoh:</strong>

                                jika pada Excel kolom
                                <strong>Thumbnail</strong>
                                berisi
                                <strong>KG001.jpg</strong>,
                                maka file tersebut harus tersedia
                                di dalam ZIP.

                                <br><br>

                                Jika kolom
                                <strong>Dokumentasi</strong>
                                berisi:

                                <strong>
                                    KG001-1.jpg, KG001-2.jpg, KG001-3.jpg
                                </strong>

                                maka ketiga file tersebut juga harus
                                tersedia di dalam ZIP.

                            </small>

                        </div>


                        <!-- =================================================
                             TOMBOL
                        ================================================== -->

                        <div class="import-form-actions">


                            <a
                                href="<?= base_url('admin/kegiatan') ?>"
                                class="btn-import-batal"
                            >

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn-import-submit"
                            >

                                <i class="bi bi-file-earmark-arrow-up"></i>

                                Import Data

                            </button>


                        </div>


                    </form>

                </div>

            </div>


        </div>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =========================================================
           FORMAT FILE
        ========================================================= */

        function formatFileSize(bytes)
        {

            if (bytes === 0) {

                return '0 Bytes';

            }


            const sizes = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];


            const i =
                Math.floor(
                    Math.log(bytes) /
                    Math.log(1024)
                );


            return (
                Math.round(
                    bytes /
                    Math.pow(1024, i) *
                    100
                ) / 100
            )
            + ' '
            + sizes[i];

        }


        /* =========================================================
           EXCEL
        ========================================================= */

        const excelInput =
            document.getElementById('excel');

        const excelBox =
            document.getElementById('excelUploadBox');

        const excelPreview =
            document.getElementById('excelPreview');

        const excelName =
            document.getElementById('excelName');

        const excelSize =
            document.getElementById('excelSize');

        const excelError =
            document.getElementById('excelError');

        const removeExcel =
            document.getElementById('removeExcel');


        if (excelInput) {

            excelInput.addEventListener(
                'change',
                function () {

                    const file =
                        this.files[0];


                    excelError.textContent = '';


                    if (!file) {

                        return;

                    }


                    const extension =
                        file.name
                            .split('.')
                            .pop()
                            .toLowerCase();


                    if (
                        ![
                            'xlsx',
                            'xls'
                        ].includes(extension)
                    ) {

                        excelError.textContent =
                            'File harus berformat XLSX atau XLS.';

                        this.value = '';

                        return;

                    }


                    excelName.textContent =
                        file.name;


                    excelSize.textContent =
                        formatFileSize(
                            file.size
                        );


                    excelBox.style.display =
                        'none';


                    excelPreview.style.display =
                        'flex';

                }
            );


            removeExcel.addEventListener(
                'click',
                function () {

                    excelInput.value = '';

                    excelPreview.style.display =
                        'none';

                    excelBox.style.display =
                        'flex';

                    excelError.textContent = '';

                }
            );

        }


        /* =========================================================
           ZIP
        ========================================================= */

        const zipInput =
            document.getElementById('zip');

        const zipBox =
            document.getElementById('zipUploadBox');

        const zipPreview =
            document.getElementById('zipPreview');

        const zipName =
            document.getElementById('zipName');

        const zipSize =
            document.getElementById('zipSize');

        const zipError =
            document.getElementById('zipError');

        const removeZip =
            document.getElementById('removeZip');


        if (zipInput) {

            zipInput.addEventListener(
                'change',
                function () {

                    const file =
                        this.files[0];


                    zipError.textContent = '';


                    if (!file) {

                        return;

                    }


                    const extension =
                        file.name
                            .split('.')
                            .pop()
                            .toLowerCase();


                    if (extension !== 'zip') {

                        zipError.textContent =
                            'File gambar harus berformat ZIP.';

                        this.value = '';

                        return;

                    }


                    zipName.textContent =
                        file.name;


                    zipSize.textContent =
                        formatFileSize(
                            file.size
                        );


                    zipBox.style.display =
                        'none';


                    zipPreview.style.display =
                        'flex';

                }
            );


            removeZip.addEventListener(
                'click',
                function () {

                    zipInput.value = '';

                    zipPreview.style.display =
                        'none';

                    zipBox.style.display =
                        'flex';

                    zipError.textContent = '';

                }
            );

        }

    }
);

</script>


<?= $this->include('admin/layout/footer') ?>