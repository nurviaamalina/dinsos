<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/layanan.css') ?>">

<main class="layanan-page">

    <!-- =========================
         BREADCRUMB
    ========================== -->

    <div class="breadcrumb">

        <a href="<?= base_url('/') ?>">
            <i class="bi bi-house-fill"></i>
            Beranda
        </a>

        <i class="bi bi-chevron-right"></i>

        <span>Layanan</span>

    </div>


    <!-- =========================
         JUDUL
    ========================== -->

    <section class="page-heading">

        <h1>Layanan</h1>

        <p>
            Informasi Lengkap mengenai layanan yang tersedia di<br>
            Dinas Sosial Pemberdayaan Perempuan dan KB<br>
            Kabupaten Banyuwangi
        </p>

    </section>


    <!-- =========================
         SEARCH
    ========================== -->

    <div class="search-wrapper">

        <input
            type="text"
            id="searchLayanan"
            placeholder="Cari Layanan..."
            autocomplete="off"
        >

        <i class="bi bi-search"></i>

    </div>


    <!-- =========================
         DAFTAR LAYANAN
    ========================== -->

    <section class="layanan-grid" id="layananGrid">

        <?php if (!empty($layanan)): ?>

            <?php foreach ($layanan as $item): ?>

                <div
                    class="layanan-card"
                    data-search="<?= esc(
                        strtolower(
                            $item['nama_layanan'] . ' ' .
                            $item['bidang'] . ' ' .
                            strip_tags($item['deskripsi_layanan'] ?? '')
                        )
                    ) ?>"
                >

                    <!-- =====================
                         BAGIAN ATAS CARD
                    ====================== -->

                    <div class="card-top">

                        <div class="layanan-icon">

                            <?php if (!empty($item['gambar'])): ?>

                                <img
                                    src="<?= base_url('uploads/layanan/' . $item['gambar']) ?>"
                                    alt="<?= esc($item['nama_layanan']) ?>"
                                >

                            <?php else: ?>

                                <i class="bi bi-shield-check"></i>

                            <?php endif; ?>

                        </div>


                        <h3>
                            <?= esc($item['nama_layanan']) ?>
                        </h3>

                    </div>


                    <!-- =====================
                         DESKRIPSI
                    ====================== -->

                    <p>

                        <?php

                        $deskripsi = strip_tags(
                            $item['deskripsi_layanan'] ?? ''
                        );

                        $deskripsi = trim(
                            preg_replace('/\s+/', ' ', $deskripsi)
                        );

                        if (strlen($deskripsi) > 150) {

                            echo esc(
                                substr($deskripsi, 0, 150) . '...'
                            );

                        } else {

                            echo esc($deskripsi);

                        }

                        ?>

                    </p>


                    <!-- =====================
                         DETAIL
                    ====================== -->

                    <a
                        href="<?= base_url('layanan/detail/' . $item['id']) ?>"
                        class="btn-detail"
                    >
                        Selengkapnya
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            <?php endforeach; ?>


        <?php else: ?>

            <!-- =====================
                 JIKA BELUM ADA DATA
            ====================== -->

            <div class="layanan-empty">

                <i class="bi bi-info-circle"></i>

                <p>
                    Belum ada layanan yang tersedia.
                </p>

            </div>

        <?php endif; ?>

    </section>


    <!-- =========================
         TIDAK DITEMUKAN
    ========================== -->

    <div
        id="layananTidakDitemukan"
        class="layanan-empty"
        style="display: none;"
    >

        <i class="bi bi-search"></i>

        <p>
            Layanan yang kamu cari tidak ditemukan.
        </p>

    </div>


    <!-- =========================
         TOMBOL KEMBALI
    ========================== -->

    <div class="back-wrapper">

        <a
            href="javascript:history.back()"
            class="btn-back"
        >
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>

    </div>

</main>


<script>

const searchInput = document.getElementById('searchLayanan');
const cards = document.querySelectorAll('.layanan-card');
const notFound = document.getElementById('layananTidakDitemukan');

searchInput.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase().trim();

    let ditemukan = 0;

    cards.forEach(card => {

        const text = card.dataset.search;

        if (text.includes(keyword)) {

            card.style.display = '';

            ditemukan++;

        } else {

            card.style.display = 'none';

        }

    });


    if (ditemukan === 0 && keyword !== '') {

        notFound.style.display = 'block';

    } else {

        notFound.style.display = 'none';

    }

});

</script>


<?= $this->include('layout/footer') ?>