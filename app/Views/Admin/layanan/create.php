<?= $this->include('admin/layout/header') ?>

<!-- Library Quill.js & Dropzone -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
<link rel="stylesheet" href="<?= base_url('assets/css/admin/layanan.css') ?>">

<div class="d-flex">
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">
        
        <!-- HEADER HALAMAN -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 style="color: #5c0f28; font-weight: 700;">Tambah Data Layanan</h2>
                <p style="color: #666;">Kelola seluruh Data</p>
            </div>
            <a href="<?= base_url('admin/layanan') ?>" class="btn btn-outline-maroon">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <?php if (session('errors')): ?>
            <div class="layanan-alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-container" style="max-width: 100%;">
            <form action="<?= base_url('admin/layanan/store') ?>" method="POST" enctype="multipart/form-data" id="formLayanan">
                <?= csrf_field() ?>
                
                <div class="form-grid">
                    <!-- Nama Layanan -->
                    <div class="form-group">
                        <label>Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" value="<?= old('nama_layanan') ?>" required>
                    </div>

                    <!-- Bidang -->
                    <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang" class="form-select" required>
                            <option value="">Pilih Bidang...</option>
                            <option value="Pengendalian Penduduk" <?= old('bidang') == 'Pengendalian Penduduk' ? 'selected' : '' ?>>Pengendalian Penduduk</option>
                            <option value="Keluarga Berencana" <?= old('bidang') == 'Keluarga Berencana' ? 'selected' : '' ?>>Keluarga Berencana</option>
                            <option value="Pemberdayaan Keluarga" <?= old('bidang') == 'Pemberdayaan Keluarga' ? 'selected' : '' ?>>Pemberdayaan Keluarga</option>
                        </select>
                    </div>

                    <!-- Deskripsi Layanan (Editor) -->
                    <div class="form-group">
                        <label>Deskripsi Layanan</label>
                        <!-- Input hidden untuk menyimpan HTML dari Quill -->
                        <input type="hidden" name="deskripsi_layanan" id="deskripsi_layanan">
                        <div id="editor-deskripsi" style="min-height: 150px;"><?= old('deskripsi_layanan') ?></div>
                    </div>

                    <!-- Standar Layanan (Editor) -->
                    <div class="form-group">
                        <label>Standar Layanan</label>
                        <input type="hidden" name="standar_layanan" id="standar_layanan">
                        <div id="editor-standar" style="min-height: 150px;"><?= old('standar_layanan') ?></div>
                    </div>

                    <!-- Prosedur Pelayanan (Editor) -->
                     <div class="form-group" style="margin-top: 50px;">
                        <label>Prosedur Pelayanan</label>
                        <!-- Input hidden untuk menyimpan HTML dari Quill -->
                        <input type="hidden" name="prosedur_layanan" id="prosedur_layanan">
                        <div id="editor-prosedur" style="min-height: 200px;"><?= old('prosedur_layanan') ?></div>
                    </div>
                   

                    <!-- Unggah Dokumen SOP (Dropzone) -->
                    <div class="form-group" style="margin-top: 50px;">
                        <label>Unggah Dokumen SOP</label>
                        <div id="dropzone" class="dropzone" style="min-height: 200px; display: flex; flex-direction: column; justify-content: center;">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <p>Drag & drop files or Browse</p>
                            <small>Supported formats: JPEG, PNG, GIF, MP4, PDF, PSD, AI, Word, PPT</small>
                            <input type="file" name="dokumen" id="fileInput" class="d-none">
                        </div>
                    </div>
                </div>

                <!-- Footer Tombol -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" name="draft" value="1" class="btn btn-draft">Draft</button>
                    <button type="submit" class="btn btn-primary">Simpan & Publikasi</button>
                </div>

            </form>
        </div>
        
    </div>
</div>

<!-- Script Quill & Dropzone -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
    // Inisialisasi Quill Editor
    var quillDeskripsi = new Quill('#editor-deskripsi', { theme: 'snow' });
    var quillStandar = new Quill('#editor-standar', { theme: 'snow' });
    var quillProsedur = new Quill('#editor-prosedur', { theme: 'snow' });

    // Saat form disubmit, pindahkan isi editor ke input hidden
    document.getElementById('formLayanan').addEventListener('submit', function() {
        document.getElementById('deskripsi_layanan').value = quillDeskripsi.root.innerHTML;
        document.getElementById('standar_layanan').value = quillStandar.root.innerHTML;
        document.getElementById('prosedur_layanan').value = quillProsedur.root.innerHTML;
    });

    // Dropzone Custom
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('fileInput');

    dropzone.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            dropzone.querySelector('p').innerText = fileInput.files[0].name;
            dropzone.querySelector('i').className = 'bi bi-file-earmark-check';
        }
    });

    // Drag & Drop Support
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#8B1E3F';
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.style.borderColor = '#ddd';
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#ddd';
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            dropzone.querySelector('p').innerText = e.dataTransfer.files[0].name;
        }
    });
</script>

<?= $this->include('admin/layout/footer') ?>