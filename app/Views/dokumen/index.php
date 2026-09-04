<?= $this->include('layout/header') ?>


<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dokumen.css') ?>"
>


<main class="dokumen-page">


    <!-- =====================================================
         HEADER DOKUMEN
    ====================================================== -->

    <section class="dokumen-hero">

        <div class="dokumen-container">

            <span class="dokumen-label">
                PUSAT DOKUMEN
            </span>


            <h1>
                Dokumen Resmi
            </h1>


            <p>
                Unduh peraturan, laporan kinerja, program, dan data publik
                DINSOSP PKB
                <br>
                Kabupaten Banyuwangi.
            </p>

        </div>

    </section>



    <!-- =====================================================
         FILTER
    ====================================================== -->

    <section class="dokumen-filter">

        <div class="dokumen-container filter-wrapper">


            <!-- SEARCH -->

            <div class="search-dokumen">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchDokumen"
                    placeholder="Cari dokumen, formulir, atau regulasi..."
                >

            </div>



            <!-- FILTER TAHUN -->

            <div class="filter-action">

                <button
                    type="button"
                    class="filter-semua"
                    id="filterSemua"
                >
                    Semua
                </button>


                <select
                    id="filterTahun"
                    class="filter-tahun"
                >

                    <option value="">
                        Tahun
                    </option>

                    <?php
                    $tahunSekarang = date('Y');

                    for (
                        $i = $tahunSekarang;
                        $i >= 2020;
                        $i--
                    ):
                    ?>

                        <option value="<?= $i ?>">
                            <?= $i ?>
                        </option>

                    <?php endfor; ?>

                </select>

            </div>

        </div>

    </section>



    <!-- =====================================================
         DAFTAR DOKUMEN
    ====================================================== -->

    <section class="dokumen-content">

        <div class="dokumen-container">


            <div class="dokumen-grid">


                <?php if (!empty($dokumen)): ?>


                    <?php foreach ($dokumen as $item): ?>


                        <!-- =================================================
                             CARD DOKUMEN
                        ================================================== -->

                        <div
                            class="dokumen-card"
                            data-tahun="<?= esc($item['tahun']) ?>"
                        >


                            <!-- =================================================
                                 ICON
                            ================================================== -->

                            <div class="card-top">

                                <div class="dokumen-icon">

                                    <?php

                                    $extension = strtolower(
                                        pathinfo(
                                            $item['file'] ?? '',
                                            PATHINFO_EXTENSION
                                        )
                                    );

                                    ?>

                                    <?php if ($extension === 'pdf'): ?>

                                        <i class="bi bi-file-earmark-pdf"></i>

                                    <?php elseif (
                                        $extension === 'doc' ||
                                        $extension === 'docx'
                                    ): ?>

                                        <i class="bi bi-file-earmark-word"></i>

                                    <?php elseif (
                                        $extension === 'xls' ||
                                        $extension === 'xlsx'
                                    ): ?>

                                        <i class="bi bi-file-earmark-excel"></i>

                                    <?php else: ?>

                                        <i class="bi bi-file-earmark-text"></i>

                                    <?php endif; ?>

                                </div>

                            </div>



                            <!-- =================================================
                                 KATEGORI
                            ================================================== -->

                            <?php if (!empty($item['nama_kategori'])): ?>

                                <span class="dokumen-kategori">

                                    <?= esc(
                                        $item['nama_kategori']
                                    ) ?>

                                </span>

                            <?php endif; ?>



                            <!-- =================================================
                                 JUDUL
                            ================================================== -->

                            <h3 class="dokumen-title">

                                <?= esc(
                                    $item['judul']
                                ) ?>

                            </h3>



                            <!-- =================================================
                                 META
                            ================================================== -->

                            <div class="dokumen-meta">

                                <span>

                                    <?= strtoupper(
                                        $extension ?: 'FILE'
                                    ) ?>

                                </span>


                                <span class="meta-dot">
                                    •
                                </span>


                                <span>

                                    <?= esc(
                                        $item['tahun']
                                    ) ?>

                                </span>

                            </div>



                            <!-- =================================================
                                 BUTTON LIHAT
                            ================================================== -->

                            <div class="dokumen-card-footer">


                                <?php if (!empty($item['file'])): ?>

                                    <a
                                        href="<?= base_url(
                                            'dokumen/detail/' .
                                            $item['id']
                                        ) ?>"
                                        class="btn-lihat"
                                    >

                                        <i class="bi bi-eye"></i>

                                        Lihat

                                    </a>

                                <?php else: ?>

                                    <span class="btn-lihat disabled">

                                        <i class="bi bi-eye-slash"></i>

                                        File tidak tersedia

                                    </span>

                                <?php endif; ?>


                            </div>


                        </div>


                    <?php endforeach; ?>


                <?php else: ?>


                    <!-- =================================================
                         DATA KOSONG
                    ================================================== -->

                    <div class="dokumen-kosong">

                        <i class="bi bi-folder-x"></i>


                        <h3>
                            Dokumen belum tersedia
                        </h3>


                        <p>
                            Belum ada dokumen yang dipublikasikan.
                        </p>

                    </div>


                <?php endif; ?>


            </div>

        </div>

    </section>


</main>


<?= $this->include('layout/footer') ?>



<!-- =====================================================
     FILTER JAVASCRIPT
====================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const searchInput =
            document.getElementById(
                'searchDokumen'
            );


        const filterTahun =
            document.getElementById(
                'filterTahun'
            );


        const filterSemua =
            document.getElementById(
                'filterSemua'
            );


        const cards =
            document.querySelectorAll(
                '.dokumen-card'
            );



        function filterDokumen() {

            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();


            const tahun =
                filterTahun.value;



            cards.forEach(
                function (card) {

                    const judulElement =
                        card.querySelector(
                            '.dokumen-title'
                        );


                    const kategoriElement =
                        card.querySelector(
                            '.dokumen-kategori'
                        );


                    const judul =
                        judulElement
                            ? judulElement.innerText
                                .toLowerCase()
                            : '';


                    const kategori =
                        kategoriElement
                            ? kategoriElement.innerText
                                .toLowerCase()
                            : '';


                    const tahunDokumen =
                        card.dataset.tahun;



                    const cocokKeyword =
                        judul.includes(keyword) ||
                        kategori.includes(keyword);


                    const cocokTahun =
                        tahun === '' ||
                        tahunDokumen === tahun;



                    if (
                        cocokKeyword &&
                        cocokTahun
                    ) {

                        card.style.display =
                            'flex';

                    } else {

                        card.style.display =
                            'none';

                    }

                }
            );

        }



        searchInput.addEventListener(
            'input',
            filterDokumen
        );


        filterTahun.addEventListener(
            'change',
            filterDokumen
        );


        filterSemua.addEventListener(
            'click',
            function () {

                searchInput.value = '';

                filterTahun.value = '';

                filterDokumen();

            }
        );

    }
);

</script>