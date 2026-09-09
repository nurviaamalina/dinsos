<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatan.css') ?>"
>


<section class="kegiatan-page">

    <div class="container">


        <!-- =================================================
             BREADCRUMB
        ================================================== -->

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Kegiatan

                </li>

            </ol>

        </nav>


        <!-- =================================================
             JUDUL
        ================================================== -->

        <div class="kegiatan-page-header">

            <h1>
                Kegiatan Dinas
            </h1>

            <p>
                Rangkuman kegiatan Dinas selama tahun berjalan.
            </p>

        </div>


        <!-- =================================================
             RECAP TAHUN
        ================================================== -->

        <?php
        $tahunTersedia = [];

        foreach ($kegiatan as $item) {

            if (!in_array($item['tahun'], $tahunTersedia)) {

                $tahunTersedia[] = $item['tahun'];

            }
        }

        rsort($tahunTersedia);
        ?>


        <?php if (!empty($tahunTersedia)): ?>

            <div class="kegiatan-tahun-list">

                <?php foreach ($tahunTersedia as $tahun): ?>

                    <a
                        href="<?= base_url('kegiatan/tahun/' . $tahun) ?>"
                        class="kegiatan-tahun-card"
                    >

                        <span>
                            Recap Kegiatan
                        </span>

                        <strong>
                            Tahun <?= esc($tahun) ?>
                        </strong>

                        <i class="bi bi-arrow-right"></i>

                    </a>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>


<?= $this->include('layout/footer') ?>