<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/datalayanan.css') ?>">

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>

    <!-- CONTENT -->
    <div class="content flex-grow-1">

       <div class="datalayanan-container import-page">

            <!-- =========================
                 FORMAT IMPORT
            ========================== -->
            <div class="import-format-card">

                <div class="import-title">
                    Keterangan Format Import
                </div>

                <p class="import-description">
                    Pastikan file yang diunggah memiliki format kolom seperti berikut.
                    Sistem mendukung file CSV dan Excel.
                </p>

                <div class="table-responsive">

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
                                <td>Nama Layanan</td>
                                <td>Teks</td>
                                <td>Nama Layanan</td>
                                <td>Layanan Permohonan SPM</td>
                            </tr>

                            <tr>
                                <td>3.</td>
                                <td>Bidang</td>
                                <td>Teks</td>
                                <td>Nama Bidang</td>
                                <td>Perlindungan dan Jaminan Sosial</td>
                            </tr>

                            <tr>
                                <td>4.</td>
                                <td>Kecamatan</td>
                                <td>Teks</td>
                                <td>Nama Kecamatan</td>
                                <td>Banyuwangi</td>
                            </tr>

                            <tr>
                                <td>5.</td>
                                <td>Jumlah</td>
                                <td>Angka</td>
                                <td>Jumlah keseluruhan permohonan</td>
                                <td>80</td>
                            </tr>

                            <tr>
                                <td>6.</td>
                                <td>Selesai</td>
                                <td>Angka</td>
                                <td>Jumlah permohonan yang telah selesai</td>
                                <td>70</td>
                            </tr>

                            <tr>
                                <td>7.</td>
                                <td>Proses</td>
                                <td>Angka</td>
                                <td>Jumlah permohonan yang dalam proses</td>
                                <td>10</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- =========================
                 IMPORT
            ========================== -->
            <div class="import-grid">

                <!-- FORM UPLOAD -->
                <div class="import-upload-card">

                    <div class="import-title">
                        Import Data Pelayanan
                    </div>

                    <div class="import-line"></div>

                    <label class="upload-label">
                        Upload Dokumen
                    </label>

                    <form
                        action="<?= base_url('admin/datalayanan/import/process') ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>

                        <div
                            class="upload-area"
                            id="uploadArea"
                        >

                            <i class="bi bi-cloud-arrow-up upload-icon"></i>

                            <div class="upload-text">
                                Pilih file atau drag & drop di sini
                            </div>

                            <div class="upload-info">
                                Format yang didukung: CSV, XLS, XLSX, XLSM
                                <br>
                                Maksimal ukuran file 10 MB
                            </div>

                            <label for="file_import" class="browse-button">
                                Browse File
                            </label>

                            <input
                                type="file"
                                id="file_import"
                                name="file_import"
                                accept=".csv,.xls,.xlsx,.xlsm"
                                hidden
                                required
                            >

                        </div>


                        <!-- FILE TERPILIH -->
                        <div
    class="selected-file"
    id="selectedFile"
    style="display:none;"
>

    <div class="selected-file-header">
        <i class="bi bi-file-earmark-excel"></i>
        <span>File Excel Data Layanan</span>
    </div>

    <div class="selected-file-card">

        <div class="selected-file-left">

            <div class="selected-file-icon">
                <i class="bi bi-file-earmark-excel"></i>
            </div>

            <div class="selected-file-info">

                <div
                    class="selected-file-name"
                    id="fileName"
                >
                    DATA PELAYANAN.xlsx
                </div>

                <div
                    class="selected-file-size"
                    id="fileSize"
                >
                    0 KB
                </div>

            </div>

        </div>

        <button
            type="button"
            class="remove-file"
            id="removeFile"
            title="Hapus file"
        >
            <i class="bi bi-trash3"></i>
        </button>

    </div>

</div>


                        <!-- ACTION -->
                        <div class="import-actions">

                            <a
                                href="<?= base_url('admin/datalayanan') ?>"
                                class="btn-cancel"
                            >
                                Batal
                            </a>

                           <button type="submit" class="btn-import">
                                <i class="bi bi-upload"></i>
                                Import Data
                            </button>

                        </div>

                    </form>

                </div>


                <!-- PETUNJUK -->
                <div class="import-guide-card">

                    <div class="import-title">
                        Petunjuk Import
                    </div>

                    <div class="import-line"></div>

                    <ul>

                        <li>
                            Pastikan nama kolom dan format data pada
                            Excel sesuai dengan format yang telah ditentukan.
                        </li>

                        <li>
                            Pastikan data yang diinput sudah lengkap dan
                            benar sebelum melakukan import.
                        </li>

                        <li>
                            Kolom Jumlah, Selesai, dan Proses diisi dengan
                            angka sesuai jumlah permohonan.
                        </li>

                        <li>
                            Jika kolom Selesai atau Proses tidak diisi,
                            sistem tidak akan bisa menghitung persentase.
                        </li>

                        <li>
                            File yang dapat diunggah:
                            <strong>CSV (.csv)</strong>,
                            <strong>Excel 97-2003 (.xls)</strong>,
                            <strong>Excel (.xlsx)</strong>,
                            dan <strong>Excel Macro-Enabled (.xlsm)</strong>.
                        </li>

                    </ul>

                    <a
                        href="<?= base_url('admin/datalayanan/import/template') ?>"
                        class="download-template"
                    >
                        <i class="bi bi-download"></i>
                        Download Template
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

const fileInput = document.getElementById('file_import');
const uploadArea = document.getElementById('uploadArea');

const selectedFile = document.getElementById('selectedFile');
const fileName = document.getElementById('fileName');
const fileSize = document.getElementById('fileSize');

const removeFile = document.getElementById('removeFile');


/*
|--------------------------------------------------------------------------
| Tampilkan File yang Dipilih
|--------------------------------------------------------------------------
*/

fileInput.addEventListener('change', function () {

    if (this.files.length === 0) {
        selectedFile.style.display = 'none';
        return;
    }

    const file = this.files[0];

    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);

    selectedFile.style.display = 'flex';

});


/*
|--------------------------------------------------------------------------
| Format Ukuran File
|--------------------------------------------------------------------------
*/

function formatFileSize(bytes)
{
    if (bytes === 0) {
        return '0 KB';
    }

    const sizes = ['Bytes', 'KB', 'MB', 'GB'];

    const i = Math.floor(
        Math.log(bytes) / Math.log(1024)
    );

    return (
        parseFloat(
            (bytes / Math.pow(1024, i)).toFixed(2)
        )
        + ' '
        + sizes[i]
    );
}


/*
|--------------------------------------------------------------------------
| Hapus File
|--------------------------------------------------------------------------
*/

removeFile.addEventListener('click', function () {

    fileInput.value = '';

    selectedFile.style.display = 'none';

});


/*
|--------------------------------------------------------------------------
| Drag & Drop
|--------------------------------------------------------------------------
*/

uploadArea.addEventListener('dragover', function (e) {

    e.preventDefault();

    this.classList.add('drag-over');

});


uploadArea.addEventListener('dragleave', function () {

    this.classList.remove('drag-over');

});


uploadArea.addEventListener('drop', function (e) {

    e.preventDefault();

    this.classList.remove('drag-over');

    if (e.dataTransfer.files.length === 0) {
        return;
    }

    const file = e.dataTransfer.files[0];

    const allowedExtensions = [
        '.csv',
        '.xls',
        '.xlsx',
        '.xlsm'
    ];

    const extension =
        file.name
            .substring(file.name.lastIndexOf('.'))
            .toLowerCase();

    if (!allowedExtensions.includes(extension)) {

        alert(
            'Format file tidak didukung.\n\n' +
            'Gunakan CSV, XLS, XLSX, atau XLSM.'
        );

        return;
    }

    fileInput.files = e.dataTransfer.files;

    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);

    selectedFile.style.display = 'flex';

});

</script>