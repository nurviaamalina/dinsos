<?php

namespace App\Controllers;

class Bidang extends BaseController
{
    public function detail($slug)
    {
        $bidang = [

            // =====================================================
            // SEKRETARIAT
            // =====================================================

            'sekretariat' => [
                'nama' => 'Sekretariat',

                'subjudul' => 'Administrasi dan Pelayanan Internal',

                'icon' => 'bi-building',

                'deskripsi' => 'Sekretariat mempunyai tugas membantu Kepala Dinas dalam melaksanakan koordinasi, penyusunan program, administrasi umum, kepegawaian, keuangan, serta pelayanan administratif di lingkungan Dinas Sosial.',

                'deskripsi_2' => 'Sekretariat berperan dalam mendukung kelancaran pelaksanaan tugas seluruh bidang agar penyelenggaraan pemerintahan dan pelayanan sosial dapat berjalan secara efektif, tertib, dan terkoordinasi.',

                'tugas' => [
                    'Melaksanakan koordinasi penyusunan program dan kegiatan Dinas Sosial.',
                    'Melaksanakan administrasi umum dan kepegawaian.',
                    'Melaksanakan pengelolaan administrasi keuangan.',
                    'Melaksanakan pengelolaan surat-menyurat dan kearsipan.',
                    'Melaksanakan koordinasi pelayanan administratif antarbidang.',
                ],

                'fungsi' => [
                    [
                        'icon' => 'bi-file-earmark-text',
                        'judul' => 'Administrasi',
                        'deskripsi' => 'Pengelolaan administrasi umum dan surat-menyurat.'
                    ],
                    [
                        'icon' => 'bi-people',
                        'judul' => 'Kepegawaian',
                        'deskripsi' => 'Pengelolaan administrasi dan kebutuhan kepegawaian.'
                    ],
                    [
                        'icon' => 'bi-cash-stack',
                        'judul' => 'Keuangan',
                        'deskripsi' => 'Pengelolaan administrasi dan pelaporan keuangan.'
                    ],
                    [
                        'icon' => 'bi-bar-chart',
                        'judul' => 'Perencanaan',
                        'deskripsi' => 'Koordinasi penyusunan program dan kegiatan.'
                    ],
                ],

                'program' => [
                    [
                        'judul' => 'Administrasi Perkantoran',
                        'deskripsi' => 'Pelayanan administrasi dan tata usaha Dinas Sosial.'
                    ],
                    [
                        'judul' => 'Perencanaan Program',
                        'deskripsi' => 'Penyusunan dan pengendalian program kegiatan.'
                    ],
                    [
                        'judul' => 'Pengelolaan Keuangan',
                        'deskripsi' => 'Pengelolaan administrasi dan pelaporan keuangan.'
                    ],
                ],
            ],


            // =====================================================
            // LINJAMSOS
            // =====================================================

            'linjamsos' => [
                'nama' => 'Bidang Linjamsos',

                'subjudul' => 'Perlindungan dan Jaminan Sosial',

                'icon' => 'bi-shield-check',

                'deskripsi' => 'Bidang Perlindungan dan Jaminan Sosial mempunyai tugas melaksanakan perumusan dan pelaksanaan kebijakan di bidang perlindungan sosial dan jaminan sosial.',

                'deskripsi_2' => 'Bidang ini berperan dalam memastikan terpenuhinya hak-hak sosial masyarakat serta memberikan perlindungan kepada kelompok rentan agar dapat hidup lebih layak dan sejahtera.',

                'tugas' => [
                    'Perumusan kebijakan di bidang perlindungan dan jaminan sosial.',
                    'Pelaksanaan kebijakan di bidang perlindungan dan jaminan sosial.',
                    'Koordinasi dan sinkronisasi pelaksanaan kebijakan.',
                    'Pemantauan dan evaluasi pelaksanaan kebijakan.',
                    'Pelaporan pelaksanaan program perlindungan dan jaminan sosial.',
                ],

                'fungsi' => [
                    [
                        'icon' => 'bi-people',
                        'judul' => 'Perlindungan Sosial',
                        'deskripsi' => 'Perlindungan bagi PMKS dan kelompok rentan lainnya.'
                    ],
                    [
                        'icon' => 'bi-shield-plus',
                        'judul' => 'Jaminan Sosial',
                        'deskripsi' => 'Fasilitasi kepesertaan jaminan sosial masyarakat.'
                    ],
                    [
                        'icon' => 'bi-database',
                        'judul' => 'Data & Informasi',
                        'deskripsi' => 'Pengelolaan data dan informasi kesejahteraan sosial.'
                    ],
                    [
                        'icon' => 'bi-hand-thumbs-up',
                        'judul' => 'Kemitraan',
                        'deskripsi' => 'Kerja sama dengan lembaga dan pihak terkait.'
                    ],
                ],

                'program' => [
                    [
                        'judul' => 'Perlindungan Sosial',
                        'deskripsi' => 'Program perlindungan bagi kelompok masyarakat rentan.'
                    ],
                    [
                        'judul' => 'Jaminan Sosial',
                        'deskripsi' => 'Fasilitasi jaminan sosial bagi masyarakat.'
                    ],
                    [
                        'judul' => 'Pendataan Sosial',
                        'deskripsi' => 'Pengelolaan data penerima dan sasaran pelayanan sosial.'
                    ],
                ],
            ],


            // =====================================================
            // REHABSOS
            // =====================================================

            'rehabsos' => [
                'nama' => 'Bidang Rehabsos',

                'subjudul' => 'Rehabilitasi Sosial',

                'icon' => 'bi-heart-pulse',

                'deskripsi' => 'Bidang Rehabilitasi Sosial mempunyai tugas melaksanakan kebijakan di bidang rehabilitasi sosial bagi masyarakat yang membutuhkan pelayanan sosial.',

                'deskripsi_2' => 'Pelayanan rehabilitasi sosial diarahkan untuk membantu individu, keluarga, dan kelompok masyarakat agar dapat meningkatkan keberfungsian sosial serta kembali berperan secara optimal di lingkungan masyarakat.',

                'tugas' => [
                    'Perumusan kebijakan di bidang rehabilitasi sosial.',
                    'Pelaksanaan pelayanan rehabilitasi sosial.',
                    'Pemberian pendampingan kepada penerima manfaat.',
                    'Koordinasi dengan lembaga pelayanan sosial.',
                    'Pemantauan dan evaluasi pelaksanaan rehabilitasi sosial.',
                ],

                'fungsi' => [
                    [
                        'icon' => 'bi-person-hearts',
                        'judul' => 'Pelayanan Sosial',
                        'deskripsi' => 'Pemberian pelayanan kepada masyarakat yang membutuhkan.'
                    ],
                    [
                        'icon' => 'bi-heart',
                        'judul' => 'Pendampingan',
                        'deskripsi' => 'Pendampingan terhadap penerima manfaat.'
                    ],
                    [
                        'icon' => 'bi-house-heart',
                        'judul' => 'Rehabilitasi',
                        'deskripsi' => 'Pemulihan keberfungsian sosial masyarakat.'
                    ],
                    [
                        'icon' => 'bi-people',
                        'judul' => 'Kemitraan',
                        'deskripsi' => 'Koordinasi dengan lembaga pelayanan sosial.'
                    ],
                ],

                'program' => [
                    [
                        'judul' => 'Rehabilitasi Sosial',
                        'deskripsi' => 'Pelayanan rehabilitasi bagi masyarakat yang membutuhkan.'
                    ],
                    [
                        'judul' => 'Pendampingan Sosial',
                        'deskripsi' => 'Pendampingan untuk meningkatkan keberfungsian sosial.'
                    ],
                    [
                        'judul' => 'Pelayanan Penyandang Disabilitas',
                        'deskripsi' => 'Pelayanan sosial bagi penyandang disabilitas.'
                    ],
                ],
            ],


            // =====================================================
            // DAYASOS
            // =====================================================

            'dayasos' => [
                'nama' => 'Bidang Dayasos',

                'subjudul' => 'Pemberdayaan Sosial',

                'icon' => 'bi-people-fill',

                'deskripsi' => 'Bidang Pemberdayaan Sosial mempunyai tugas melaksanakan kebijakan di bidang pemberdayaan sosial dan pengembangan potensi masyarakat.',

                'deskripsi_2' => 'Pemberdayaan sosial dilakukan melalui peningkatan kapasitas masyarakat, penguatan kelembagaan sosial, serta pengembangan partisipasi masyarakat dalam penyelenggaraan kesejahteraan sosial.',

                'tugas' => [
                    'Perumusan kebijakan di bidang pemberdayaan sosial.',
                    'Pelaksanaan pemberdayaan masyarakat.',
                    'Pengembangan potensi dan sumber kesejahteraan sosial.',
                    'Pembinaan kelembagaan sosial masyarakat.',
                    'Pemantauan dan evaluasi kegiatan pemberdayaan sosial.',
                ],

                'fungsi' => [
                    [
                        'icon' => 'bi-people',
                        'judul' => 'Pemberdayaan',
                        'deskripsi' => 'Peningkatan kapasitas dan kemandirian masyarakat.'
                    ],
                    [
                        'icon' => 'bi-diagram-3',
                        'judul' => 'Kelembagaan',
                        'deskripsi' => 'Penguatan kelembagaan sosial masyarakat.'
                    ],
                    [
                        'icon' => 'bi-stars',
                        'judul' => 'Potensi Sosial',
                        'deskripsi' => 'Pengembangan potensi sumber kesejahteraan sosial.'
                    ],
                    [
                        'icon' => 'bi-megaphone',
                        'judul' => 'Partisipasi',
                        'deskripsi' => 'Peningkatan partisipasi masyarakat.'
                    ],
                ],

                'program' => [
                    [
                        'judul' => 'Pemberdayaan Masyarakat',
                        'deskripsi' => 'Program peningkatan kapasitas dan kemandirian masyarakat.'
                    ],
                    [
                        'judul' => 'Penguatan Kelembagaan Sosial',
                        'deskripsi' => 'Pengembangan kelembagaan sosial masyarakat.'
                    ],
                    [
                        'judul' => 'Pengembangan Potensi Sosial',
                        'deskripsi' => 'Pengembangan potensi dan sumber kesejahteraan sosial.'
                    ],
                ],
            ],


            // =====================================================
            // PPDKB
            // =====================================================

            'ppdkb' => [
                'nama' => 'Bidang PPDKB',

                'subjudul' => 'Pemberdayaan, Penanganan dan Perlindungan Sosial',

                'icon' => 'bi-diagram-3',

                'deskripsi' => 'Bidang PPDKB melaksanakan tugas yang berkaitan dengan pemberdayaan, penanganan serta perlindungan masyarakat dalam penyelenggaraan kesejahteraan sosial.',

                'deskripsi_2' => 'Bidang ini mendukung pelaksanaan berbagai kebijakan sosial melalui koordinasi, pemberdayaan masyarakat dan penanganan permasalahan sosial yang berkembang di masyarakat.',

                'tugas' => [
                    'Perumusan kebijakan sesuai bidang tugas.',
                    'Pelaksanaan program pemberdayaan masyarakat.',
                    'Penanganan permasalahan sosial.',
                    'Koordinasi dengan perangkat daerah dan lembaga terkait.',
                    'Pemantauan dan evaluasi pelaksanaan program.',
                ],

                'fungsi' => [
                    [
                        'icon' => 'bi-person-check',
                        'judul' => 'Pemberdayaan',
                        'deskripsi' => 'Peningkatan kemampuan dan kemandirian masyarakat.'
                    ],
                    [
                        'icon' => 'bi-life-preserver',
                        'judul' => 'Penanganan Sosial',
                        'deskripsi' => 'Penanganan permasalahan sosial masyarakat.'
                    ],
                    [
                        'icon' => 'bi-shield-check',
                        'judul' => 'Perlindungan',
                        'deskripsi' => 'Perlindungan terhadap masyarakat yang membutuhkan.'
                    ],
                    [
                        'icon' => 'bi-diagram-3',
                        'judul' => 'Koordinasi',
                        'deskripsi' => 'Koordinasi dengan berbagai pihak terkait.'
                    ],
                ],

                'program' => [
                    [
                        'judul' => 'Pemberdayaan Sosial',
                        'deskripsi' => 'Program pemberdayaan masyarakat dan kelembagaan sosial.'
                    ],
                    [
                        'judul' => 'Penanganan Permasalahan Sosial',
                        'deskripsi' => 'Pelayanan dan penanganan permasalahan sosial.'
                    ],
                    [
                        'judul' => 'Perlindungan Masyarakat',
                        'deskripsi' => 'Pelaksanaan perlindungan sosial bagi masyarakat.'
                    ],
                ],
            ],
        ];


        // =====================================================
        // CEK SLUG
        // =====================================================

        if (!isset($bidang[$slug])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        // =====================================================
        // DATA YANG DIKIRIM KE VIEW
        // =====================================================

        $data = [
            'bidang' => $bidang[$slug],
        ];


        return view('layout/header')
            . view('bidang/detail', $data)
            . view('layout/footer');
    }
}