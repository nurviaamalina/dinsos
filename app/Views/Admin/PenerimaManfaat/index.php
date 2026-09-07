<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/penerima_manfaat.css') ?>"
>

<div class="d-flex">

    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <?= $this->include('admin/layout/sidebar') ?>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="content flex-grow-1">

        <div class="penerima-page">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="penerima-header">

                <div class="penerima-header-text">

                    <h1>
                        Data Penerima Manfaat
                    </h1>

                    <p>
                        Kelola seluruh Data Permohonan,
                        Pengajuan untuk Kebutuhan Statistik
                    </p>

                </div>

            </div>


            <!-- =================================================
                 STATISTIK
            ================================================== -->

            <div class="penerima-statistik">


                <!-- TOTAL -->

                <div class="penerima-stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div class="stat-number">

                        <?= number_format(
                            $totalPenerima ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="stat-label">
                        Total Penerima Manfaat
                    </div>

                </div>


                <!-- PENYANDANG DISABILITAS -->

                <div class="penerima-stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-universal-access"></i>
                    </div>

                    <div class="stat-number">

                        <?= number_format(
                            $kategori['Penyandang Disabilitas'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="stat-label">
                        Penyandang Disabilitas
                    </div>

                </div>


                <!-- LANSIA -->

                <div class="penerima-stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-person-walking"></i>
                    </div>

                    <div class="stat-number">

                        <?= number_format(
                            $kategori['Lansia'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="stat-label">
                        Lansia
                    </div>

                </div>


                <!-- ANAK -->

                <div class="penerima-stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-emoji-smile"></i>
                    </div>

                    <div class="stat-number">

                        <?= number_format(
                            $kategori['Anak'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="stat-label">
                        Anak
                    </div>

                </div>


                <!-- KELUARGA PENERIMA MANFAAT -->

                <div class="penerima-stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div class="stat-number">

                        <?= number_format(
                            $kategori['Keluarga Penerima Manfaat'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="stat-label">
                        Keluarga Penerima Manfaat
                    </div>

                </div>


            </div>


            <!-- =================================================
                 TOOLBAR
            ================================================== -->

            <div class="penerima-toolbar">


                <!-- SEARCH -->

                <form
                    action="<?= base_url('admin/penerima-manfaat') ?>"
                    method="get"
                    class="penerima-search"
                >

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="keyword"
                        value="<?= esc($keyword ?? '') ?>"
                        placeholder="Cari data..."
                    >

                </form>


                <!-- BUTTON -->

                <div class="penerima-toolbar-actions">

                    <a
                        href="<?= base_url(
                            'admin/penerima-manfaat/import'
                        ) ?>"
                        class="btn-import-kategori"
                    >

                        <i class="bi bi-box-arrow-in-down"></i>

                        Import Data

                    </a>


                    <a
                        href="<?= base_url(
                            'admin/penerima-manfaat/create'
                        ) ?>"
                        class="btn-tambah-kategori"
                    >

                        <i class="bi bi-plus-circle"></i>

                        Tambah Data

                    </a>

                </div>

            </div>


            <!-- =================================================
                 ALERT SUCCESS
            ================================================== -->

            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success penerima-alert">

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 ALERT ERROR
            ================================================== -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger penerima-alert">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="penerima-table-wrapper">

                <table class="penerima-table">

                    <thead>

                        <tr>

                            <th class="col-no">
                                No
                            </th>

                            <th class="col-periode">
                                Periode
                            </th>

                            <th class="col-kategori">
                                Kategori Penerima
                            </th>

                            <th class="col-jumlah">
                                Jumlah
                            </th>

                            <th class="col-aksi">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php if (!empty($penerima)): ?>

                            <?php

                            $no =
                                1 +
                                (
                                    ($pager->getCurrentPage() - 1)
                                    *
                                    $pager->getPerPage()
                                );

                            ?>


                            <?php foreach ($penerima as $item): ?>

                                <tr>


                                    <!-- NO -->

                                    <td class="text-center">

                                        <?= $no++ ?>

                                    </td>


                                    <!-- PERIODE -->

                                    <td>

                                        <?php

                                        $namaBulan = [

                                            1 => 'Januari',

                                            2 => 'Februari',

                                            3 => 'Maret',

                                            4 => 'April',

                                            5 => 'Mei',

                                            6 => 'Juni',

                                            7 => 'Juli',

                                            8 => 'Agustus',

                                            9 => 'September',

                                            10 => 'Oktober',

                                            11 => 'November',

                                            12 => 'Desember',

                                        ];

                                        $bulan =
                                            (int)
                                            ($item['periode_bulan'] ?? 0);

                                        $tahun =
                                            $item['periode_tahun']
                                            ?? '';

                                        ?>


                                        <span class="periode-text">

                                            <?= esc(
                                                $namaBulan[$bulan] ?? '-'
                                            ) ?>

                                            <?= esc($tahun) ?>

                                        </span>

                                    </td>


                                    <!-- KATEGORI -->

                                    <td class="kategori-cell">

                                        <?= esc(
                                            $item['kategori'] ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- JUMLAH -->

                                    <td class="jumlah-cell">

                                        <?= number_format(
                                            (int)
                                            ($item['jumlah'] ?? 0),
                                            0,
                                            ',',
                                            '.'
                                        ) ?>

                                    </td>


                                    <!-- AKSI -->

                                    <td>

                                        <div class="penerima-actions">


                                            <!-- EDIT -->

                                            <a
                                                href="<?= base_url(
                                                    'admin/penerima-manfaat/edit/' .
                                                    $item['id']
                                                ) ?>"
                                                class="btn-edit"
                                                title="Edit"
                                            >

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            <!-- DELETE -->

                                            <a
                                                href="<?= base_url(
                                                    'admin/penerima-manfaat/delete/' .
                                                    $item['id']
                                                ) ?>"
                                                class="btn-delete"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </a>


                                        </div>

                                    </td>


                                </tr>

                            <?php endforeach; ?>


                        <?php else: ?>


                            <tr>

                                <td
                                    colspan="5"
                                    class="penerima-empty"
                                >

                                    <i class="bi bi-inbox"></i>

                                    <p>
                                        Belum ada data penerima manfaat.
                                    </p>

                                </td>

                            </tr>


                        <?php endif; ?>


                    </tbody>

                </table>

            </div>


            <!-- =================================================
                 PAGINATION
            ================================================== -->

            <?php if (
                isset($pager) &&
                $pager->getPageCount() > 1
            ): ?>

                <div class="penerima-pagination">

                    <?= $pager->only(['default'])->links() ?>

                </div>

            <?php endif; ?>


        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>