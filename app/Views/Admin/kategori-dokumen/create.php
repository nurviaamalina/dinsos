<?= $this->include('Admin/layout/header'); ?>

<!-- Menggunakan CSS yang sama agar tampilan presisi seragam -->
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

            <!-- HEADER PAGE -->
            <div class="edit-header">
                <div>
                    <h1>Tambah Kategori</h1>
                    <p>Tambahkan kategori baru ke dalam sistem.</p>
                </div>

                <a
                    href="<?= base_url('admin/dokumen'); ?>"
                    class="btn-back"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <!-- ALERT ERROR -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    <?= esc(session()->getFlashdata('error')); ?>
                </div>
            <?php endif; ?>

            <!-- FORM CARD -->
            <div class="edit-document-card">

                <form
                    action="<?= base_url('admin/kategori/store'); ?>"
                    method="post"
                >
                    <?= csrf_field(); ?>

                    <!-- NAMA KATEGORI -->
                    <div class="form-group">
                        <label for="nama_kategori">
                            Nama Kategori
                            <span class="required" style="color: #dc3545;">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_kategori"
                            name="nama_kategori"
                            class="form-control"
                            value="<?= esc(old('nama_kategori', '')); ?>"
                            placeholder="Masukkan nama kategori"
                            required
                        >

                        <small>
                            Masukkan nama kategori baru (misal: Regulasi, Berita, dll).
                        </small>
                    </div>

                    <!-- DESKRIPSI KATEGORI -->
                    <div class="form-group">
                        <label for="deskripsi">
                            Deskripsi Kategori
                        </label>

                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="form-control"
                            placeholder="Masukkan deskripsi singkat kategori (opsional)"
                            rows="4"
                        ><?= esc(old('deskripsi', '')); ?></textarea>

                        <small>
                            Penjelasan singkat mengenai fungsi kategori ini.
                        </small>
                    </div>

                    <!-- ACTION BUTTONS -->
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
                            Simpan Kategori
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?= $this->include('Admin/layout/footer'); ?>