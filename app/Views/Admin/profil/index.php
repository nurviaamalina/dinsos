<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/profil.css') ?>"
>


<div class="d-flex">

    <!-- SIDEBAR -->

    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid profil-page">


            <!-- =========================================
                 HEADER
            ========================================== -->

            <div class="profil-header">

                <div class="profil-header-text">

                    <h1>
                        Profil dan Sejarah Dinas
                    </h1>

                    <p>
                        Kelola informasi profil dinas
                    </p>

                </div>

            </div>


            <!-- =========================================
                 SEARCH + TAMBAH
            ========================================== -->

            <div class="profil-toolbar">

                <div class="profil-search">

                    <input
                        type="text"
                        id="searchProfil"
                    >

                    <button type="button">

                        <i class="bi bi-search"></i>

                    </button>

                </div>


                <a
    href="<?= base_url('admin/profil/anggota/create') ?>"
    class="btn-tambah-profil"
>

    <i class="bi bi-plus-circle"></i>

    Tambah Anggota

</a>

            </div>


            <!-- =========================================
                 CARD ANGGOTA
            ========================================== -->

           <div class="anggota-grid">

    <?php if (!empty($anggota)): ?>

        <?php foreach ($anggota as $item): ?>

            <div class="anggota-card">

                <!-- FOTO -->

                <div class="anggota-foto">

                    <?php if (!empty($item['foto'])): ?>

                        <img
                            src="<?= base_url(
                                'uploads/profil/' . $item['foto']
                            ) ?>"
                            alt="<?= esc($item['nama']) ?>"
                        >

                    <?php else: ?>

                        <div class="foto-placeholder"></div>

                    <?php endif; ?>

                </div>


                <!-- JABATAN -->

                <h2>
                    <?= esc($item['jabatan']) ?>
                </h2>


                <!-- NAMA -->

                <p class="anggota-nama">
                    <?= esc($item['nama']) ?>
                </p>


                <!-- CAPTION -->

                <p class="anggota-tugas">

                    <?= nl2br(
                        esc($item['caption'] ?? '')
                    ) ?>

                </p>


                <!-- ACTION -->

                <div class="anggota-action">

                    <a
    href="<?= base_url('admin/profil/anggota/edit/' . $item['id']) ?>"
    class="btn-edit-profil"
    title="Edit"
>
    <i class="bi bi-pencil-square"></i>
</a>


                    <a
                        href="#"
                        class="btn-delete-profil"
                        title="Hapus"
                    >

                        <i class="bi bi-trash3"></i>

                    </a>

                </div>

            </div>

        <?php endforeach; ?>


    <?php else: ?>

        <div class="profil-empty">

            Belum ada data anggota.

        </div>

    <?php endif; ?>

</div>


            <!-- =========================================
                 SEJARAH DINAS
            ========================================== -->

            <div class="sejarah-box">


                <!-- HEADER -->

                <div class="sejarah-header">

                    <h2>
                        SEJARAH DINAS
                    </h2>


                   <a
    href="<?= base_url('admin/profil/create') ?>"
    class="btn-edit-sejarah"
>

                        <i class="bi bi-pencil-square"></i>

                        Edit Sejarah Dinas

                    </a>

                </div>


                <!-- TABS -->

                <div class="sejarah-tabs">

                    <button
                        type="button"
                        class="sejarah-tab active"
                        data-tab="sejarah"
                    >
                        Sejarah
                    </button>


                    <button
                        type="button"
                        class="sejarah-tab"
                        data-tab="visi-misi"
                    >
                        Visi Misi
                    </button>

<button
                        type="button"
                        class="sejarah-tab"
                        data-tab="sasaran-strategis"
                    >
                        Sasaran Strategi
                    </button>

                    <button
                        type="button"
                        class="sejarah-tab"
                        data-tab="maklumat-pelayanan"
                    >
                        Maklumat Pelayanan
                    </button>

                    <button
                        type="button"
                        class="sejarah-tab"
                        data-tab="struktur"
                    >
                        Struktur Organisasi
                    </button>


                    <button
                        type="button"
                        class="sejarah-tab"
                        data-tab="informasi"
                    >
                        Informasi Tambahan
                    </button>

                </div>


                <!-- CONTENT -->

                <div class="sejarah-content">


                    <!-- SEJARAH -->

                    <div
    class="tab-content active"
    id="tab-sejarah"
>

    <?php if (!empty($profil['sejarah'])): ?>

        <p>
            <?= nl2br(esc($profil['sejarah'])) ?>
        </p>

    <?php else: ?>

        <p>
            Belum ada sejarah dinas.
        </p>

    <?php endif; ?>

</div>


                    <!-- VISI MISI -->

<div
    class="tab-content"
    id="tab-visi-misi"
>

    <?php if (!empty($profil)): ?>

        <div class="visi-misi-wrapper">

            <!-- =====================================
                 VISI
            ====================================== -->

            <div class="visi-section">

                <h3>
                    Visi
                </h3>

                <?php if (!empty($profil['visi'])): ?>

                    <div class="visi-content">

                        <?= nl2br(
                            esc($profil['visi'])
                        ) ?>

                    </div>

                <?php else: ?>

                    <p class="empty-content">
                        Belum ada data visi.
                    </p>

                <?php endif; ?>

            </div>


            <!-- =====================================
                 MISI
            ====================================== -->

            <div class="misi-section">

                <h3>
                    Misi
                </h3>

                <?php if (!empty($profil['misi'])): ?>

                    <div class="misi-content">

                        <?= nl2br(
                            esc($profil['misi'])
                        ) ?>

                    </div>

                <?php else: ?>

                    <p class="empty-content">
                        Belum ada data misi.
                    </p>

                <?php endif; ?>

            </div>

        </div>

    <?php else: ?>

        <p class="empty-content">
            Belum ada visi dan misi.
        </p>

    <?php endif; ?>

</div>

<div
    class="tab-content"
    id="tab-sasaran-strategis"
>

    <?php if (!empty($profil['sasaran_strategis'])): ?>

        <p>
            <?= nl2br(
                esc($profil['sasaran_strategis'])
            ) ?>
        </p>

    <?php else: ?>

        <p>
            Belum ada sasaran strategis.
        </p>

    <?php endif; ?>

</div>

<div
    class="tab-content"
    id="tab-maklumat-pelayanan"
>

    <?php if (!empty($profil['maklumat_pelayanan'])): ?>

        <p>
            <?= nl2br(
                esc($profil['maklumat_pelayanan'])
            ) ?>
        </p>

    <?php else: ?>

        <p>
            Belum ada maklumat pelayanan.
        </p>

    <?php endif; ?>

</div>

                    <!-- STRUKTUR -->

                    <div
    class="tab-content"
    id="tab-struktur"
>

    <?php if (!empty($profil['struktur'])): ?>

        <?php
        $struktur = $profil['struktur'];
        $extension = strtolower(
            pathinfo($struktur, PATHINFO_EXTENSION)
        );
        ?>


        <?php if (in_array($extension, ['jpg', 'jpeg', 'png'])): ?>

            <img
                src="<?= base_url('uploads/struktur/' . $struktur) ?>"
                alt="Struktur Organisasi"
                style="max-width: 100%;"
            >

        <?php elseif ($extension === 'pdf'): ?>

            <iframe
                src="<?= base_url('uploads/struktur/' . $struktur) ?>"
                width="100%"
                height="600"
                style="border: none;"
            ></iframe>

        <?php endif; ?>


    <?php else: ?>

        <p>
            Belum ada struktur organisasi.
        </p>

    <?php endif; ?>

</div>


                    <!-- INFORMASI -->

                    <div
    class="tab-content"
    id="tab-informasi"
>

    <div class="informasi-profil">


        <!-- KONTAK -->

        <div class="informasi-item">

            <div class="informasi-icon">
                <i class="bi bi-telephone"></i>
            </div>

            <div class="informasi-detail">

                <span>
                    Kontak
                </span>

                <strong>
                    <?= esc($profil['kontak'] ?? '-') ?>
                </strong>

            </div>

        </div>


        <!-- EMAIL -->

        <div class="informasi-item">

            <div class="informasi-icon">
                <i class="bi bi-envelope"></i>
            </div>

            <div class="informasi-detail">

                <span>
                    Email
                </span>

                <strong>
                    <?= esc($profil['email'] ?? '-') ?>
                </strong>

            </div>

        </div>


        <!-- INSTAGRAM -->

        <div class="informasi-item">

            <div class="informasi-icon">
                <i class="bi bi-instagram"></i>
            </div>

            <div class="informasi-detail">

                <span>
                    Instagram
                </span>

                <?php if (!empty($profil['instagram'])): ?>

                    <a
                        href="<?= esc($profil['instagram']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <?= esc($profil['instagram']) ?>
                    </a>

                <?php else: ?>

                    <strong>-</strong>

                <?php endif; ?>

            </div>

        </div>


        <!-- FACEBOOK -->

        <div class="informasi-item">

            <div class="informasi-icon">
                <i class="bi bi-facebook"></i>
            </div>

            <div class="informasi-detail">

                <span>
                    Facebook
                </span>

                <?php if (!empty($profil['facebook'])): ?>

                    <a
                        href="<?= esc($profil['facebook']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <?= esc($profil['facebook']) ?>
                    </a>

                <?php else: ?>

                    <strong>-</strong>

                <?php endif; ?>

            </div>

        </div>


    </div>

</div>


                </div>

            </div>


        </div>

    </div>

</div>


<!-- =========================================
     FOOTER
========================================= -->

<?= $this->include('admin/layout/footer') ?>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       TAB SEJARAH
    ===================================================== */

    const tabs =
        document.querySelectorAll('.sejarah-tab');

    const contents =
        document.querySelectorAll('.tab-content');


    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            const target =
                this.getAttribute('data-tab');


            tabs.forEach(function (item) {

                item.classList.remove('active');

            });


            contents.forEach(function (content) {

                content.classList.remove('active');

            });


            this.classList.add('active');


            const targetContent =
                document.getElementById(
                    'tab-' + target
                );


            if (targetContent) {

                targetContent.classList.add('active');

            }

        });

    });


    /* =====================================================
       SEARCH
    ===================================================== */

    const searchInput =
        document.getElementById('searchProfil');


    const cards =
        document.querySelectorAll('.anggota-card');


    if (searchInput) {

        searchInput.addEventListener(
            'keyup',
            function () {

                const keyword =
                    this.value.toLowerCase();


                cards.forEach(function (card) {

                    const text =
                        card.innerText.toLowerCase();


                    if (text.includes(keyword)) {

                        card.style.display = '';

                    } else {

                        card.style.display = 'none';

                    }

                });

            }
        );

    }

});

</script>