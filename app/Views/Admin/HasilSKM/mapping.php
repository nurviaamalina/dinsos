<?= $this->include('admin/layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/admin/hasil-skm.css') ?>"
>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4">

        <div class="skm-page">

            <!-- HEADER -->
            <div class="page-header">

                <h1>
                    Mapping Kolom Data SKM
                </h1>

                <p>
                    Sistem telah membaca struktur file Excel.
                    Periksa mapping sebelum melanjutkan import.
                </p>

            </div>


            <!-- FILE -->
            <div class="table-card mb-3">

                <div class="card-body">

                    <strong>
                        File:
                    </strong>

                    <?= esc($fileName) ?>

                </div>

            </div>


            <!-- SHEET -->
            <div class="table-card mb-3">

                <div class="card-body">

                    <label class="form-label">
                        Sheet Data Utama
                    </label>

                    <select
                        name="sheet_preview"
                        class="form-select"
                        disabled
                    >

                        <?php foreach (
                            $sheetInfo as $sheet
                        ) : ?>

                            <option
                                value="<?= esc($sheet['name']) ?>"
                                <?= $sheet['name'] === $selectedSheet
                                    ? 'selected'
                                    : '' ?>
                            >

                                <?= esc($sheet['name']) ?>

                                — skor
                                <?= (int) $sheet['score'] ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <small class="text-muted">

                        Sistem otomatis memilih sheet yang
                        paling menyerupai data SKM.

                    </small>

                </div>

            </div>


            <!-- MAPPING -->
            <div class="table-card mb-3">

                <div class="card-body">

                    <form
                        action="<?= base_url(
                            'admin/hasil-skm/import/save'
                        ) ?>"
                        method="post"
                    >

                        <?= csrf_field() ?>


                        <div class="mapping-header">

                            <div>
                                Kolom Excel
                            </div>

                            <div>
                                Digunakan Sebagai
                            </div>

                        </div>


                        <?php foreach (
                            $headers as $column => $header
                        ) : ?>

                            <div class="mapping-row">

                                <div>

                                    <div class="excel-column">

                                        <?= esc($header) ?>

                                    </div>

                                    <small>
                                        Kolom <?= esc($column) ?>
                                    </small>

                                </div>


                                <div>

                                    <select
                                        name="mapping[<?= esc($column) ?>]"
                                        class="form-select"
                                    >

                                        <option value="">
                                            -- Tidak digunakan --
                                        </option>


                                        <option
                                            value="id_responden"
                                            <?= ($autoMapping[$column] ?? '') === 'id_responden'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            ID Responden
                                        </option>


                                        <option
                                            value="tanggal"
                                            <?= ($autoMapping[$column] ?? '') === 'tanggal'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Tanggal Survei
                                        </option>


                                        <option
                                            value="periode"
                                            <?= ($autoMapping[$column] ?? '') === 'periode'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Periode
                                        </option>


                                        <option
                                            value="periode_bulan"
                                            <?= ($autoMapping[$column] ?? '') === 'periode_bulan'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Periode Bulan
                                        </option>


                                        <option
                                            value="periode_tahun"
                                            <?= ($autoMapping[$column] ?? '') === 'periode_tahun'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Periode Tahun
                                        </option>


                                        <option
                                            value="kecamatan"
                                            <?= ($autoMapping[$column] ?? '') === 'kecamatan'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Kecamatan / Wilayah
                                        </option>


                                        <option
                                            value="nama_layanan"
                                            <?= ($autoMapping[$column] ?? '') === 'nama_layanan'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Nama Layanan
                                        </option>


                                        <option
                                            value="bidang"
                                            <?= ($autoMapping[$column] ?? '') === 'bidang'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Bidang
                                        </option>


                                        <option
                                            value="jumlah_responden"
                                            <?= ($autoMapping[$column] ?? '') === 'jumlah_responden'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Jumlah Responden
                                        </option>


                                        <option
                                            value="nilai_ikm"
                                            <?= ($autoMapping[$column] ?? '') === 'nilai_ikm'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Nilai IKM
                                        </option>


                                        <option
                                            value="u1"
                                            <?= ($autoMapping[$column] ?? '') === 'u1'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U1 — Persyaratan
                                        </option>


                                        <option
                                            value="u2"
                                            <?= ($autoMapping[$column] ?? '') === 'u2'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U2 — Prosedur
                                        </option>


                                        <option
                                            value="u3"
                                            <?= ($autoMapping[$column] ?? '') === 'u3'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U3 — Waktu Pelayanan
                                        </option>


                                        <option
                                            value="u4"
                                            <?= ($autoMapping[$column] ?? '') === 'u4'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U4 — Biaya/Tarif
                                        </option>


                                        <option
                                            value="u5"
                                            <?= ($autoMapping[$column] ?? '') === 'u5'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U5 — Produk Pelayanan
                                        </option>


                                        <option
                                            value="u6"
                                            <?= ($autoMapping[$column] ?? '') === 'u6'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U6 — Kompetensi
                                        </option>


                                        <option
                                            value="u7"
                                            <?= ($autoMapping[$column] ?? '') === 'u7'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U7 — Perilaku
                                        </option>


                                        <option
                                            value="u8"
                                            <?= ($autoMapping[$column] ?? '') === 'u8'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U8 — Pengaduan
                                        </option>


                                        <option
                                            value="u9"
                                            <?= ($autoMapping[$column] ?? '') === 'u9'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            U9 — Sarana Prasarana
                                        </option>


                                        <option
                                            value="demografi_jenis_kelamin"
                                            <?= ($autoMapping[$column] ?? '') === 'demografi_jenis_kelamin'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Demografi — Jenis Kelamin
                                        </option>


                                        <option
                                            value="demografi_pendidikan"
                                            <?= ($autoMapping[$column] ?? '') === 'demografi_pendidikan'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Demografi — Pendidikan
                                        </option>

                                    </select>

                                </div>

                            </div>

                        <?php endforeach; ?>


                        <!-- PREVIEW -->
                        <div class="mapping-preview">

                            <h5>
                                Preview Data
                            </h5>

                            <div class="table-responsive">

                                <table class="table table-sm">

                                    <thead>

                                        <tr>

                                            <?php foreach (
                                                $headers as $header
                                            ) : ?>

                                                <th>
                                                    <?= esc($header) ?>
                                                </th>

                                            <?php endforeach; ?>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php foreach (
                                            $preview as $row
                                        ) : ?>

                                            <tr>

                                                <?php foreach (
                                                    $headers as $column => $header
                                                ) : ?>

                                                    <td>

                                                        <?= esc(
                                                            $row[$column]
                                                            ?? ''
                                                        ) ?>

                                                    </td>

                                                <?php endforeach; ?>

                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        <!-- ACTION -->
                        <div
                            class="mapping-actions"
                        >

                            <a
                                href="<?= base_url(
                                    'admin/hasil-skm/import'
                                ) ?>"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-check2"></i>

                                Proses Import

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>