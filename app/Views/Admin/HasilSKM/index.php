<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/hasil-skm.css') ?>"
>

<div class="d-flex">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4">

        <div class="skm-page">

            <!-- =====================================================
                 HEADER
            ====================================================== -->
            <div class="page-header">

                <div>
                    <h1>
                        Data Survei Kepuasan Masyarakat
                    </h1>

                    <p>
                        Kelola seluruh Data untuk Kebutuhan Statistik
                    </p>
                </div>

            </div>


            <!-- =====================================================
                 ALERT
            ====================================================== -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>

            <?php endif; ?>


            <!-- =====================================================
                 SUMMARY
            ====================================================== -->

            <div class="row g-3 mb-4">

                <!-- RATA IKM -->
                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                Rata-rata IKM
                            </span>

                            <strong>
                                <?= number_format($rataIKM ?? 0, 2) ?>
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- RESPONDEN -->
                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                Total Responden
                            </span>

                            <strong>
                                <?= number_format($totalResponden ?? 0) ?>
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- PERIODE -->
                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                Periode Terakhir
                            </span>

                            <strong>
                                <?= esc($periodeTerakhir ?? '-') ?>
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- MUTU -->
                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="bi bi-award"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                Kategori IKM
                            </span>

                            <?php

                            $nilai = (float) ($rataIKM ?? 0);

                            if ($nilai >= 88.31) {
                                $mutu = 'A - Sangat Baik';
                            } elseif ($nilai >= 76.61) {
                                $mutu = 'B - Baik';
                            } elseif ($nilai >= 65.00) {
                                $mutu = 'C - Kurang Baik';
                            } elseif ($nilai >= 25.00) {
                                $mutu = 'D - Tidak Baik';
                            } else {
                                $mutu = 'E - Sangat Tidak Baik';
                            }

                            ?>

                            <strong>
                                <?= $mutu ?>
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 TABLE CARD
            ====================================================== -->

            <div class="table-card">

                <!-- TOOLBAR -->
                <div class="table-toolbar">

                    <!-- SEARCH -->
                    <form
                        action="<?= base_url('admin/hasil-skm') ?>"
                        method="get"
                        class="search-form"
                    >

                        <div class="search-box">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                name="keyword"
                                value="<?= esc($keyword ?? '') ?>"
                                placeholder="Cari kecamatan atau tahun..."
                            >

                        </div>

                    </form>


                    <!-- IMPORT -->
                    <a
                        href="<?= base_url('admin/hasil-skm/import') ?>"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-upload"></i>

                        Import Data

                    </a>

                </div>


                <!-- =================================================
                     TABLE
                ================================================== -->

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Periode
                                </th>

                                <th>
                                    Kecamatan
                                </th>

                                <th>
                                    Jumlah Responden
                                </th>

                                <th>
                                    Nilai IKM
                                </th>

                                <th>
                                    Mutu
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (!empty($hasilSKM)) : ?>

                                <?php $no = 1 + (10 * (($pager->getCurrentPage() ?? 1) - 1)); ?>

                                <?php foreach ($hasilSKM as $item) : ?>

                                    <?php

                                    $bulan = [
                                        1  => 'Januari',
                                        2  => 'Februari',
                                        3  => 'Maret',
                                        4  => 'April',
                                        5  => 'Mei',
                                        6  => 'Juni',
                                        7  => 'Juli',
                                        8  => 'Agustus',
                                        9  => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];

                                    $namaBulan =
                                        $bulan[(int) $item['periode_bulan']]
                                        ?? '-';


                                    $nilaiIKM =
                                        (float) $item['nilai_ikm'];


                                    if ($nilaiIKM >= 88.31) {

                                        $kodeMutu = 'A';
                                        $labelMutu = 'Sangat Baik';

                                    } elseif ($nilaiIKM >= 76.61) {

                                        $kodeMutu = 'B';
                                        $labelMutu = 'Baik';

                                    } elseif ($nilaiIKM >= 65.00) {

                                        $kodeMutu = 'C';
                                        $labelMutu = 'Kurang Baik';

                                    } elseif ($nilaiIKM >= 25.00) {

                                        $kodeMutu = 'D';
                                        $labelMutu = 'Tidak Baik';

                                    } else {

                                        $kodeMutu = 'E';
                                        $labelMutu = 'Sangat Tidak Baik';

                                    }

                                    ?>

                                    <tr>

                                        <!-- NO -->
                                        <td>
                                            <?= $no++ ?>
                                        </td>


                                        <!-- PERIODE -->
                                        <td>

                                            <?= $namaBulan ?>

                                            <?= esc($item['periode_tahun']) ?>

                                        </td>


                                        <!-- KECAMATAN -->
                                        <td>

                                            <?= esc($item['kecamatan']) ?>

                                        </td>


                                        <!-- RESPONDEN -->
                                        <td>

                                            <?= number_format(
                                                $item['jumlah_responden']
                                            ) ?>

                                        </td>


                                        <!-- IKM -->
                                        <td>

                                            <strong>

                                                <?= number_format(
                                                    $nilaiIKM,
                                                    2
                                                ) ?>

                                            </strong>

                                        </td>


                                        <!-- MUTU -->
                                        <td>

                                            <span class="badge bg-primary">

                                                <?= $kodeMutu ?>

                                            </span>

                                            <span>

                                                <?= $labelMutu ?>

                                            </span>

                                        </td>


                                        <!-- AKSI -->
                                        <td>

                                            <a
                                                href="<?= base_url(
                                                    'admin/hasil-skm/delete/' .
                                                    $item['id']
                                                ) ?>"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus"
                                                onclick="return confirm(
                                                    'Apakah Anda yakin ingin menghapus data SKM ini?'
                                                )"
                                            >

                                                <i class="bi bi-trash3"></i>

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center py-5"
                                    >

                                        <i class="bi bi-inbox fs-1"></i>

                                        <p class="mt-2 mb-0">
                                            Belum ada data SKM.
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

                <?php if (!empty($hasilSKM)) : ?>

                    <div class="mt-3">

                        <?= $pager->links() ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>