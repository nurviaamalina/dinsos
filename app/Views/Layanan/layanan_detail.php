<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/layanan_detail.css') ?>">

<main class="layanan-detail-page">

    <!-- =========================
         BREADCRUMB
    ========================== -->
    <div class="breadcrumb-detail">

        <a href="<?= base_url('/') ?>">Beranda</a>

        <i class="bi bi-chevron-right"></i>

        <a href="<?= base_url('layanan') ?>">Layanan</a>

        <i class="bi bi-chevron-right"></i>

        <span><?= esc($layanan['nama_layanan'] ?? 'Pelayanan Surat Pernyataan Miskin (SPM) Online') ?></span>

    </div>


    <!-- =========================
         JUDUL
    ========================== -->
    <section class="detail-heading">

        <h1>
            <?= esc($layanan['nama_layanan'] ?? 'Layanan Surat Pernyataan Miskin (SPM) Online') ?>
        </h1>

        <p>
            <?= esc(
                $layanan['deskripsi_singkat']
                ?? 'Layanan pengajuan Surat Pernyataan Miskin (SPM) secara online untuk membantu masyarakat memperoleh dokumen pernyataan kondisi sosial ekonomi dengan lebih mudah, cepat, dan transparan.'
            ) ?>
        </p>

    </section>


    <!-- =========================
         CONTENT
    ========================== -->
    <div class="detail-layout">

        <!-- =====================
             KOLOM KIRI
        ====================== -->
        <div class="detail-left">

            <!-- DESKRIPSI -->
            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h2>Deskripsi Layanan</h2>

                </div>

                <div class="card-content">

                    <?= $layanan['deskripsi'] ?? '
                    <p>
                        Layanan Surat Pernyataan Miskin Online merupakan fasilitas digital
                        yang memungkinkan masyarakat mengajukan permohonan SPM tanpa harus
                        melakukan proses secara langsung di kantor pelayanan.
                        Pemohon dapat mengisi data, mengunggah dokumen persyaratan,
                        serta memantau proses pengajuan secara online.
                    </p>
                    ' ?>

                </div>

            </div>


            <!-- STANDAR LAYANAN -->
            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-clipboard-text"></i>
                    </div>

                    <h2>Standar Layanan</h2>

                </div>

                <div class="card-content">

                    <?= $layanan['standar_layanan'] ?? '
                    <p>
                        Pelayanan Surat Pernyataan Miskin dilaksanakan berdasarkan prinsip
                        sederhana, mudah, cepat, transparan, akuntabel, dan sesuai dengan
                        ketentuan peraturan perundang-undangan.
                    </p>

                    <p>Standar pelayanan meliputi:</p>

                    <ul>
                        <li>Persyaratan pelayanan;</li>
                        <li>Prosedur dan mekanisme pelayanan;</li>
                        <li>Jangka waktu penyelesaian;</li>
                        <li>Produk pelayanan;</li>
                        <li>Biaya/tarif pelayanan; dan</li>
                        <li>Penanganan pengaduan, saran, dan masukan.</li>
                    </ul>
                    ' ?>

                </div>

            </div>


            <!-- PROSEDUR -->
            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <h2>Prosedur Pelayanan</h2>

                </div>

                <div class="card-content">

                    <?php if (!empty($layanan['prosedur'])): ?>

                        <?= $layanan['prosedur'] ?>

                    <?php else: ?>

                        <ol>
                            <li>
                                Pemohon mengakses layanan Surat Pernyataan Miskin (SPM) Online.
                            </li>

                            <li>
                                Pemohon melakukan pengisian formulir permohonan dengan data
                                yang benar dan lengkap.
                            </li>

                            <li>
                                Pemohon mengunggah dokumen persyaratan sesuai dengan ketentuan
                                yang ditetapkan.
                            </li>

                            <li>
                                Petugas melakukan pemeriksaan kelengkapan dan verifikasi
                                data permohonan.
                            </li>

                            <li>
                                Apabila terdapat ketidaksesuaian atau kekurangan persyaratan,
                                pemohon diminta melakukan perbaikan atau melengkapi dokumen.
                            </li>

                            <li>
                                Permohonan yang telah memenuhi persyaratan diproses oleh petugas.
                            </li>

                            <li>
                                Surat Pernyataan Miskin diterbitkan sesuai dengan hasil verifikasi.
                            </li>

                            <li>
                                Pemohon memperoleh informasi atau dokumen hasil pelayanan
                                melalui sistem yang tersedia.
                            </li>
                        </ol>

                    <?php endif ?>

                </div>

            </div>


            <!-- WAKTU -->
            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <h2>Waktu Pelayanan</h2>

                </div>

                <div class="card-content">

                    <?= $layanan['waktu_pelayanan'] ?? '
                    <p>
                        Pelayanan diselesaikan dalam jangka waktu maksimal
                        <strong>1–3 hari kerja</strong> sejak persyaratan dinyatakan lengkap
                        dan sesuai, dengan memperhatikan hasil verifikasi dan ketentuan
                        yang berlaku.
                    </p>
                    ' ?>

                </div>

            </div>


            <!-- TOMBOL KEMBALI -->
            <a href="<?= base_url('layanan') ?>" class="btn-kembali">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>

        </div>


        <!-- =====================
             KOLOM KANAN
        ====================== -->
        <aside class="detail-right">

            <div class="side-card">

                <!-- BIDANG -->
                <div class="side-section">

                    <h3>Bidang</h3>

                    <div class="bidang-badge">

                        <i class="bi bi-shield-check"></i>

                        <span>
                            <?= esc(
                                $layanan['nama_bidang']
                                ?? 'Perlindungan dan Jaminan Sosial'
                            ) ?>
                        </span>

                    </div>

                </div>


                <!-- SOP -->
                <div class="side-section">

                    <h3>Dokumen Standar Operasional (SOP)</h3>

                    <?php if (!empty($layanan['dokumen_sop'])): ?>

                        <a
                            href="<?= base_url('uploads/sop/' . $layanan['dokumen_sop']) ?>"
                            target="_blank"
                            class="sop-item"
                        >

                            <i class="bi bi-file-earmark-pdf-fill"></i>

                            <span>
                                <?= esc($layanan['dokumen_sop']) ?>
                            </span>

                            <i class="bi bi-download"></i>

                        </a>

                    <?php else: ?>

                        <div class="sop-item">

                            <i class="bi bi-file-earmark-pdf-fill"></i>

                            <span>NAMA DOKUMEN.PDF</span>

                            <i class="bi bi-download"></i>

                        </div>

                    <?php endif ?>

                </div>


                <!-- BANTUAN -->
                <div class="side-section bantuan-section">

                    <h3>Butuh Bantuan?</h3>

                    <p>
                        Jika Anda mengalami kendala atau membutuhkan informasi lebih lanjut
                        terkait layanan ini, silakan menghubungi petugas pelayanan kami.
                    </p>

                    <a href="<?= base_url('kontak') ?>" class="btn-hubungi">

                        <i class="bi bi-telephone"></i>

                        <span>Hubungi Kami</span>

                    </a>

                </div>

            </div>

        </aside>

    </div>

</main>


<?= $this->include('layout/footer') ?>