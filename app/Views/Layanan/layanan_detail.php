<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/layanan_detail.css') ?>">

<main class="layanan-detail-page">

    <div class="breadcrumb-detail">

        <a href="<?= base_url('/') ?>">
            Beranda
        </a>

        <i class="bi bi-chevron-right"></i>

        <a href="<?= base_url('layanan') ?>">
            Layanan
        </a>

        <i class="bi bi-chevron-right"></i>

        <span>
            <?= esc($layanan['nama_layanan']) ?>
        </span>

    </div>


    <!-- =====================================================
         JUDUL LAYANAN
    ====================================================== -->

    <section class="detail-heading">

        <h1>
            <?= esc($layanan['nama_layanan']) ?>
        </h1>

        <p>
            <?= esc($layanan['nama_layanan']) ?>
            merupakan layanan yang disediakan untuk membantu masyarakat
            memperoleh pelayanan dengan lebih mudah, cepat, dan transparan.
        </p>

    </section>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="detail-layout">


        <!-- =================================================
             KOLOM KIRI
        ================================================== -->

        <div class="detail-left">


            <!-- =================================================
                 DESKRIPSI LAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h2>
                        Deskripsi Layanan
                    </h2>

                </div>


                <div class="card-content">

                    <?php if (!empty($layanan['deskripsi_layanan'])): ?>

                        <?= $layanan['deskripsi_layanan'] ?>

                    <?php else: ?>

                        <p>
                            Deskripsi layanan belum tersedia.
                        </p>

                    <?php endif ?>

                </div>

            </div>

            <?php
            $standarFields = [
                'dasar_hukum' => 'Dasar Hukum',
                'persyaratan' => 'Persyaratan',
                'sistem_mekanisme_prosedur' => 'Sistem, Mekanisme, dan Prosedur',
                'jangka_waktu_pelayanan' => 'Jangka Waktu Pelayanan',
                'biaya_tarif' => 'Biaya/Tarif',
                'produk_pelayanan' => 'Produk Pelayanan',
                'penanganan_pengaduan' => 'Penanganan Pengaduan, Saran, Masukan, dan Apresiasi',
                'sarana_prasarana_fasilitas' => 'Sarana dan Prasarana dan/atau Fasilitas',
                'kompetensi_pelaksana' => 'Kompetensi Pelaksana',
                'pengawasan_internal' => 'Pengawasan Internal',
                'jumlah_pelaksana' => 'Jumlah Pelaksana',
                'jaminan_pelayanan' => 'Jaminan Pelayanan',
                'jaminan_keamanan_keselamatan' => 'Jaminan Keamanan dan Keselamatan Pelayanan',
                'evaluasi_kinerja_pelaksana' => 'Evaluasi Kinerja Pelaksana',
            ];
            foreach ($standarFields as $field => $label):
                if (empty($layanan[$field])) {
                    continue;
                }
            ?>
                <div class="detail-card">
                    <div class="card-title">
                        <div class="title-icon"><i class="bi bi-check2-square"></i></div>
                        <h2><?= esc($label) ?></h2>
                    </div>
                    <div class="card-content"><?= $layanan[$field] ?></div>
                </div>
            <?php endforeach; ?>



            <!-- =================================================
                 WAKTU PELAYANAN
            ================================================== -->

            <div class="detail-card">

                <div class="card-title">

                    <div class="title-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <h2>
                        Waktu Pelayanan
                    </h2>

                </div>


                <div class="card-content">

                    <p>
                        Pelayanan diselesaikan dalam jangka waktu maksimal
                        <strong>1–3 hari kerja</strong>
                        sejak persyaratan dinyatakan lengkap dan sesuai,
                        dengan memperhatikan hasil verifikasi dan ketentuan
                        yang berlaku.
                    </p>

                </div>

            </div>



            <!-- =================================================
                 TOMBOL KEMBALI
            ================================================== -->

            <a
                href="<?= base_url('layanan') ?>"
                class="btn-kembali"
            >

                <i class="bi bi-arrow-left"></i>

                <span>
                    Kembali
                </span>

            </a>


        </div>



        <!-- =================================================
             KOLOM KANAN
        ================================================== -->

        <aside class="detail-right">

            <div class="side-card">


                <!-- =================================================
                     BIDANG
                ================================================== -->

                <div class="side-section">

                    <h3>
                        Bidang
                    </h3>


                    <div class="bidang-badge">

                        <i class="bi bi-shield-check"></i>

                        <span>
                            <?= esc($layanan['bidang']) ?>
                        </span>

                    </div>

                </div>



                <!-- =================================================
                     SOP
                ================================================== -->

                <div class="side-section">

                    <h3>
                        Dokumen Standar Operasional (SOP)
                    </h3>


                    <?php if (!empty($layanan['dokumen'])): ?>

                        <a
                            href="<?= base_url('uploads/dokumen/' . $layanan['dokumen']) ?>"
                            target="_blank"
                            class="sop-item"
                        >

                            <div class="sop-name">

                                <i class="bi bi-file-earmark-pdf-fill"></i>

                                <span>
                                    <?= esc($layanan['dokumen']) ?>
                                </span>

                            </div>


                            <i class="bi bi-download"></i>

                        </a>

                    <?php else: ?>

                        <div class="sop-item sop-empty">

                            <div class="sop-name">

                                <i class="bi bi-file-earmark-pdf-fill"></i>

                                <span>
                                    Dokumen SOP belum tersedia
                                </span>

                            </div>

                        </div>

                    <?php endif ?>

                </div>



                <!-- =================================================
                     BANTUAN
                ================================================== -->

                <div class="side-section bantuan-section">

                    <h3>
                        Butuh Bantuan?
                    </h3>


                    <p>
                        Jika Anda mengalami kendala atau membutuhkan
                        informasi lebih lanjut terkait layanan ini,
                        silakan menghubungi petugas pelayanan kami.
                    </p>


                    <button
                        type="button"
                        id="btnHubungi"
                        class="btn-hubungi"
                        aria-haspopup="dialog"
                        aria-controls="modalHubungi"
                    >

                        <i class="bi bi-telephone"></i>

                        <span>
                            Hubungi Kami
                        </span>

                    </button>

                </div>

            </div>

        </aside>

    </div>

</main>

<div
    id="modalHubungi"
    class="hubungi-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modalHubungiTitle"
    hidden
>
    <div class="hubungi-modal-content">
        <button type="button" class="hubungi-modal-close" aria-label="Tutup" data-close-hubungi>
            <i class="bi bi-x-lg"></i>
        </button>
        <h2 id="modalHubungiTitle">Hubungi Kami</h2>
        <img
            src="<?= base_url('assets/images/hubungi-kami.jpg') ?>"
            alt="Informasi kontak layanan Banyuwangi"
        >
    </div>
</div>

<script>
    const modalHubungi = document.getElementById('modalHubungi');
    const btnHubungi = document.getElementById('btnHubungi');

    function closeHubungiModal() {
        modalHubungi.hidden = true;
        document.body.classList.remove('modal-open');
    }

    btnHubungi.addEventListener('click', function() {
        modalHubungi.hidden = false;
        document.body.classList.add('modal-open');
    });

    modalHubungi.addEventListener('click', function(event) {
        if (event.target === modalHubungi || event.target.closest('[data-close-hubungi]')) {
            closeHubungiModal();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !modalHubungi.hidden) {
            closeHubungiModal();
        }
    });
</script>


<?= $this->include('layout/footer') ?>