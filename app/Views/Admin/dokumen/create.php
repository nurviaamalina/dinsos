<?= $this->include('Admin/layout/header'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/edit-dokumen.css'); ?>"
>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <?= $this->include('Admin/layout/sidebar'); ?>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <div class="edit-document-page">

            <!-- HEADER -->
            <div class="edit-header">

                <div>
                    <h1>Tambah Dokumen</h1>

                    <p>
                        Tambahkan dokumen baru ke dalam sistem.
                    </p>
                </div>

                <a
                    href="<?= base_url('admin/dokumen'); ?>"
                    class="btn-back"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>


            <!-- ERROR -->
            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-circle"></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ); ?>

                </div>

            <?php endif; ?>


            <!-- FORM -->
            <div class="edit-document-card">

                <form
                    action="<?= base_url('admin/dokumen/store'); ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field(); ?>


                    <!-- JUDUL -->
                    <div class="form-group">

                        <label for="judul">
                            Judul Dokumen
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            class="form-control"
                            value="<?= esc(old('judul', '')); ?>"
                            placeholder="Masukkan judul dokumen"
                            required
                        >

                        <small>
                            Masukkan nama atau judul dokumen.
                        </small>

                    </div>


                    <!-- KATEGORI -->
                    <div class="form-group">

                        <label for="kategori_id">
                            Kategori
                            <span class="required">*</span>
                        </label>

                        <select
                            id="kategori_id"
                            name="kategori_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <?php foreach ($kategori as $item): ?>

                                <option
                                    value="<?= esc($item['id']); ?>"
                                    <?= old('kategori_id') == $item['id']
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    <?= esc(
                                        $item['nama_kategori']
                                    ); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                        <small>
                            Pilih kategori untuk dokumen ini.
                        </small>

                    </div>


                    <!-- TAHUN -->
                    <div class="form-group">

                        <label for="tahun">
                            Tahun
                            <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="tahun"
                            name="tahun"
                            class="form-control"
                            value="<?= esc(
                                old('tahun', date('Y'))
                            ); ?>"
                            min="2000"
                            max="<?= date('Y') + 1; ?>"
                            placeholder="Contoh: 2026"
                            required
                        >

                        <small>
                            Masukkan tahun dokumen.
                        </small>

                    </div>


                    <!-- STATUS -->
                    <div class="form-group">

                        <label for="status">
                            Status
                            <span class="required">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="DRAFT"
                                <?= old(
                                    'status',
                                    'DRAFT'
                                ) === 'DRAFT'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Draf
                            </option>

                            <option
                                value="PUBLISHED"
                                <?= old('status') === 'PUBLISHED'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Dipublikasikan
                            </option>

                        </select>

                        <small>
                            Dokumen berstatus Draf tidak akan tampil
                            pada halaman frontend.
                        </small>

                    </div>


                    <!-- FILE -->
                    <div class="form-group">

                        <label for="file">
                            File Dokumen
                            <span class="required">*</span>
                        </label>

                        <input
                            type="file"
                            id="file"
                            name="file"
                            class="form-control"
                            accept=".pdf,.doc,.docx,.xls,.xlsx"
                            required
                        >

                        <small>
                            Format yang diperbolehkan:
                            PDF, DOC, DOCX, XLS, XLSX.
                        </small>

                    </div>


                    <!-- ACTION -->
                    <div class="form-actions">

                        <a
                            href="<?= base_url('admin/dokumen'); ?>"
                            class="btn-cancel"
                        >
                            <i class="bi bi-x-lg"></i>
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-save"
                        >
                            <i class="bi bi-save"></i>
                            Simpan Dokumen
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?= $this->include('Admin/layout/footer'); ?>