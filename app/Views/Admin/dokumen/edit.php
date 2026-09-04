<?= $this->include('Admin/layout/header'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/edit-dokumen.css'); ?>" >

<div class="admin-layout">

<?= $this->include('Admin/layout/sidebar'); ?>

<main class="main-content">

    <div class="edit-document-page">

        <!-- HEADER -->
        <div class="edit-header">

            <div>
                <h1>Edit Dokumen</h1>

                <p>
                    Perbarui informasi dokumen.
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


        <!-- ALERT VALIDATION -->
        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle"></i>

                <div>

                    <?php foreach (
                        session()->getFlashdata('errors')
                        as $error
                    ): ?>

                        <div>
                            <?= esc($error); ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif; ?>


        <!-- ALERT ERROR -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle"></i>

                <div>
                    <?= esc(session()->getFlashdata('error')); ?>
                </div>

            </div>

        <?php endif; ?>


        <!-- FORM CARD -->
        <div class="edit-document-card">

            <form
                action="<?= base_url(
                    'admin/dokumen/update/' . $dokumen['id']
                ); ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field(); ?>


                <!-- KATEGORI -->
                <div class="form-group">

                    <label for="kategori_id">
                        Kategori
                        <span class="required">*</span>
                    </label>

                    <select
                        name="kategori_id"
                        id="kategori_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <?php foreach ($kategori as $item): ?>

                            <option
                                value="<?= $item['id']; ?>"
                                <?= old(
                                    'kategori_id',
                                    $dokumen['kategori_id']
                                ) == $item['id']
                                    ? 'selected'
                                    : ''; ?>
                            >
                                <?= esc(
                                    $item['nama_kategori']
                                ); ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- JUDUL -->
                <div class="form-group">

                    <label for="judul">
                        Judul Dokumen
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control"
                        value="<?= old(
                            'judul',
                            $dokumen['judul']
                        ); ?>"
                        placeholder="Masukkan judul dokumen"
                        required
                    >

                </div>


                <!-- TAHUN -->
                <div class="form-group">

                    <label for="tahun">
                        Tahun
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="tahun"
                        id="tahun"
                        class="form-control"
                        value="<?= old(
                            'tahun',
                            $dokumen['tahun']
                        ); ?>"
                        placeholder="Contoh: 2026"
                        min="2000"
                        max="2100"
                        required
                    >

                </div>


                <!-- STATUS -->
                <div class="form-group">

                    <label for="status">
                        Status
                        <span class="required">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >

                        <option
                            value="DRAFT"
                            <?= old(
                                'status',
                                $dokumen['status']
                            ) === 'DRAFT'
                                ? 'selected'
                                : ''; ?>
                        >
                            Draf
                        </option>

                        <option
                            value="PUBLISHED"
                            <?= old(
                                'status',
                                $dokumen['status']
                            ) === 'PUBLISHED'
                                ? 'selected'
                                : ''; ?>
                        >
                            Dipublikasikan
                        </option>

                    </select>

                    <div class="status-help">
                        Dokumen Draf tidak akan ditampilkan di halaman
                        frontend. Pilih Dipublikasikan agar dokumen
                        dapat dilihat pengguna.
                    </div>

                </div>


                <!-- FILE DOKUMEN -->
                <div class="form-group">

                    <label for="file">
                        File Dokumen
                    </label>

                    <?php if (!empty($dokumen['file'])): ?>

                        <div class="current-file">

                            <i class="bi bi-file-earmark-text"></i>

                            <strong>
                                <?= esc($dokumen['file']); ?>
                            </strong>

                        </div>

                        <div class="file-help">
                            File di atas merupakan file saat ini.
                            Pilih file baru jika ingin menggantinya.
                        </div>

                    <?php else: ?>

                        <div class="file-help">
                            Belum ada file dokumen.
                        </div>

                    <?php endif; ?>


                    <input
                        type="file"
                        name="file"
                        id="file"
                        class="form-control"
                        accept=".pdf,.doc,.docx,.xls,.xlsx"
                    >

                    <small>
                        Kosongkan jika tidak ingin mengganti file lama.
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
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

</div>

<?= $this->include('Admin/layout/footer'); ?>