<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/penerima_manfaat.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>


    <div class="content flex-grow-1 penerima-page">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="penerima-header">

            <div>

                <h1>
                    Import Data Penerima Manfaat
                </h1>

                <p>
                    Kelola seluruh Data untuk Kebutuhan Statistik
                </p>

            </div>

        </div>



        <!-- =====================================================
             ALERT
        ====================================================== -->

        <?php if (session()->getFlashdata('error')): ?>

            <div class="penerima-alert penerima-alert-error">

                <?= session()->getFlashdata('error') ?>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             KETERANGAN FORMAT EXCEL
        ====================================================== -->

        <div class="import-format-card">

            <h2>
                Keterangan Format Excel
            </h2>

            <p>
                Pastikan file excel yang anda unggah memiliki format
                kolom sebagai berikut
            </p>


            <div class="import-table-wrapper">

                <table class="import-format-table">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Nama Kolom</th>

                            <th>Tipe Data</th>

                            <th>Isi Kolom</th>

                            <th>Contoh Data</th>

                        </tr>

                    </thead>


                    <tbody>

                        <tr>

                            <td>1.</td>

                            <td>Periode</td>

                            <td>Teks dan Angka</td>

                            <td>Bulan dan Tahun</td>

                            <td>Juli 2026</td>

                        </tr>


                        <tr>

                            <td>2.</td>

                            <td>Kategori</td>

                            <td>Teks</td>

                            <td>Nama Kategori</td>

                            <td>Lansia</td>

                        </tr>


                        <tr>

                            <td>3.</td>

                            <td>Jumlah</td>

                            <td>Angka</td>

                            <td>
                                Jumlah Keseluruhan kategori per periode
                            </td>

                            <td>1029</td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>



        <!-- =====================================================
             BAGIAN BAWAH
        ====================================================== -->

        <div class="import-bottom-grid">


            <!-- ================================================
                 FORM IMPORT
            ================================================= -->

            <div class="import-upload-card">


                <div class="import-card-title">

                    <h2>
                        Import Data Kategori Penerima
                    </h2>

                    <span></span>

                </div>



                <form
                    action="<?= base_url(
                        'admin/penerima-manfaat/importProcess'
                    ) ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field() ?>


                    <div class="import-upload-group">

                        <label>
                            Upload Dokumen
                        </label>


                        <div
                            class="import-dropzone"
                            id="importDropzone"
                        >

                            <i class="bi bi-cloud-arrow-up"></i>


                            <div class="import-drop-title">
                                Choose a file or drag & drop it here
                            </div>


                            <div class="import-drop-info">
                                XLSX, XLS format, up to 50MB
                            </div>


                            <label
                                for="file_excel"
                                class="import-browse-button"
                            >
                                Browse File
                            </label>


                            <input
                                type="file"
                                id="file_excel"
                                name="file_excel"
                                accept=".xlsx,.xls"
                                hidden
                                required
                            >

                        </div>


                        <!-- NAMA FILE -->

                        <div
                            id="selectedFile"
                            class="import-selected-file"
                        ></div>

                    </div>



                    <!-- BUTTON -->

                    <div class="import-actions">

                        <a
                            href="<?= base_url(
                                'admin/penerima-manfaat'
                            ) ?>"
                            class="btn-penerima-cancel"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="btn-penerima-save"
                        >

                            <i class="bi bi-download"></i>

                            Impor Data

                        </button>

                    </div>

                </form>

            </div>



            <!-- ================================================
                 PETUNJUK
            ================================================= -->

            <div class="import-instruction-card">

                <h2>
                    Petunjuk Import
                </h2>


                <ul>

                    <li>
                        Pastikan
                        <strong>nama kolom dan format data</strong>
                        pada Excel sesuai dengan format yang telah
                        ditentukan.
                    </li>


                    <li>
                        Pastikan data yang diinput sudah lengkap
                        dan benar sebelum melakukan import.
                    </li>


                    <li>
                        Pastikan file yang diunggah menggunakan
                        format
                        <strong>Excel (.xlsx)</strong>.
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>



<script>

const fileInput = document.getElementById('file_excel');
const selectedFile = document.getElementById('selectedFile');
const dropzone = document.getElementById('importDropzone');


// =====================================================
// TAMPILKAN FILE
// =====================================================

function showSelectedFile(file)
{
    if (!file) {
        selectedFile.innerHTML = '';
        selectedFile.style.display = 'none';
        return;
    }

    const fileSize = formatFileSize(file.size);

    selectedFile.innerHTML = `
        <div class="selected-file-title">
            <i class="bi bi-file-earmark-excel"></i>
            <span>File Excel Berita</span>
        </div>

        <div class="selected-file-card">

            <div class="selected-file-info">

                <div class="selected-file-icon">
                    <i class="bi bi-file-earmark-excel"></i>
                </div>

                <div class="selected-file-name">

                    <strong>${file.name}</strong>

                    <small>
                        ${fileSize}
                    </small>

                </div>

            </div>

            <button
                type="button"
                class="selected-file-delete"
                onclick="removeSelectedFile()"
                title="Hapus file"
            >
                <i class="bi bi-trash3"></i>
            </button>

        </div>
    `;

    selectedFile.style.display = 'block';
}


// =====================================================
// FORMAT UKURAN FILE
// =====================================================

function formatFileSize(bytes)
{
    if (bytes === 0) {
        return '0 KB';
    }

    const units = [
        'Bytes',
        'KB',
        'MB',
        'GB'
    ];

    const index = Math.floor(
        Math.log(bytes) / Math.log(1024)
    );

    return (
        parseFloat(
            (bytes / Math.pow(1024, index))
            .toFixed(2)
        )
        + ' '
        + units[index]
    );
}


// =====================================================
// FILE DIPILIH
// =====================================================

fileInput.addEventListener('change', function () {

    if (this.files.length > 0) {

        showSelectedFile(
            this.files[0]
        );

    } else {

        removeSelectedFile();

    }

});


// =====================================================
// HAPUS FILE
// =====================================================

function removeSelectedFile()
{
    fileInput.value = '';

    selectedFile.innerHTML = '';

    selectedFile.style.display = 'none';
}


// =====================================================
// DRAG OVER
// =====================================================

dropzone.addEventListener('dragover', function (e) {

    e.preventDefault();

    this.classList.add('drag-over');

});


// =====================================================
// DRAG LEAVE
// =====================================================

dropzone.addEventListener('dragleave', function () {

    this.classList.remove('drag-over');

});


// =====================================================
// DROP FILE
// =====================================================

dropzone.addEventListener('drop', function (e) {

    e.preventDefault();

    this.classList.remove('drag-over');

    if (e.dataTransfer.files.length > 0) {

        fileInput.files =
            e.dataTransfer.files;

        showSelectedFile(
            e.dataTransfer.files[0]
        );

    }

});

</script>