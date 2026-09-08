<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();


// =====================================================
// AUTH
// =====================================================

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::prosesLogin');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::prosesRegister');

$routes->get('logout', 'Auth::logout');


// =====================================================
// FRONTEND
// =====================================================

// HOME
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');


// =====================================================
// BERITA
// =====================================================

$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');


// =====================================================
// PROFIL FRONTEND
// =====================================================

$routes->get('profil', 'Profil::index');


// =====================================================
// LAYANAN FRONTEND
// =====================================================

$routes->get('layanan', 'Layanan::index');
$routes->get('layanan/detail/(:num)', 'Layanan::detail/$1');


// =====================================================
// PENGADUAN FRONTEND
// =====================================================

$routes->get('pengaduan', 'Pengaduan::index');


// =====================================================
// KEGIATAN FRONTEND
// =====================================================

$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/tahun/(:num)', 'Kegiatan::tahun/$1');
$routes->get('kegiatan/(:segment)', 'Kegiatan::detail/$1');


// =====================================================
// BIDANG FRONTEND
// =====================================================
route_to('bidang', 'Bidang::index');
$routes->get('bidang/(:segment)', 'Bidang::detail/$1');


// =====================================================
// INSTAGRAM
// =====================================================

$routes->get('instagram', 'Instagram::index');


// =====================================================
// DOKUMEN FRONTEND
// =====================================================

$routes->get('dokumen', 'Dokumen::index');
$routes->get('dokumen/detail/(:num)', 'Dokumen::detail/$1');

//dashboard statistik frontend

$routes->get('statistik', 'Statistik::index');
// =====================================================
// ADMIN
// SEMUA ROUTE ADMIN WAJIB LOGIN
// =====================================================

$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    // =================================================
    // DASHBOARD
    // =================================================

    $routes->get('/', 'Admin\Dashboard::index');

    $routes->get(
        'dashboard','Admin\Dashboard::index'
    );


    // =================================================
    // DATA MASTER BIDANG
    // =================================================

    $routes->get(
        'bidang',
        'Admin\Bidang::index'
    );

    $routes->get(
        'bidang/create',
        'Admin\Bidang::create'
    );

    $routes->post(
        'bidang/store',
        'Admin\Bidang::store'
    );

    $routes->get(
        'bidang/edit/(:num)',
        'Admin\Bidang::edit/$1'
    );

    $routes->post(
        'bidang/update/(:num)',
        'Admin\Bidang::update/$1'
    );

    $routes->get(
        'bidang/delete/(:num)',
        'Admin\Bidang::delete/$1'
    );

//dashboard statistik
$routes->get('statistik', 'Admin\Statistik::index');
    // =================================================
    // DETAIL BIDANG
    // =================================================

    $routes->get(
        'bidang/detail/(:num)',
        'Admin\BidangDetail::index/$1'
    );

    $routes->get(
        'bidang/detail/(:num)/create',
        'Admin\BidangDetail::create/$1'
    );

    $routes->post(
        'bidang/detail/(:num)/store',
        'Admin\BidangDetail::store/$1'
    );

    $routes->get(
        'bidang/detail/edit/(:num)',
        'Admin\BidangDetail::edit/$1'
    );

    $routes->post(
        'bidang/detail/update/(:num)',
        'Admin\BidangDetail::update/$1'
    );

    $routes->get(
        'bidang/detail/delete/(:num)',
        'Admin\BidangDetail::delete/$1'
    );


    // =================================================
    // DATA MASTER KECAMATAN
    // =================================================

    $routes->get(
        'kecamatan',
        'Admin\Kecamatan::index'
    );

    $routes->get(
        'kecamatan/create',
        'Admin\Kecamatan::create'
    );

    $routes->post(
        'kecamatan/store',
        'Admin\Kecamatan::store'
    );

    $routes->get(
        'kecamatan/edit/(:num)',
        'Admin\Kecamatan::edit/$1'
    );

    $routes->post(
        'kecamatan/update/(:num)',
        'Admin\Kecamatan::update/$1'
    );

    $routes->get(
        'kecamatan/delete/(:num)',
        'Admin\Kecamatan::delete/$1'
    );


    // =================================================
    // BERITA ADMIN
    // =================================================

    $routes->get(
        'berita',
        'Admin\AdminBerita::index'
    );

    $routes->get(
        'berita/create',
        'Admin\AdminBerita::create'
    );

    $routes->post(
        'berita/store',
        'Admin\AdminBerita::store'
    );

    $routes->get(
        'berita/edit/(:num)',
        'Admin\AdminBerita::edit/$1'
    );

    $routes->post(
        'berita/update/(:num)',
        'Admin\AdminBerita::update/$1'
    );

    $routes->get(
        'berita/import',
        'Admin\AdminBerita::import'
    );

    $routes->post(
        'berita/import',
        'Admin\AdminBerita::importProcess'
    );


    // =================================================
    // DOKUMEN ADMIN
    // =================================================

    $routes->get(
        'dokumen',
        'Admin\AdminDokumen::index'
    );

    $routes->get(
        'dokumen/create',
        'Admin\AdminDokumen::create'
    );

    $routes->post(
        'dokumen/store',
        'Admin\AdminDokumen::store'
    );

    $routes->get(
        'dokumen/edit/(:num)',
        'Admin\AdminDokumen::edit/$1'
    );

    $routes->post(
        'dokumen/update/(:num)',
        'Admin\AdminDokumen::update/$1'
    );

    $routes->get(
        'dokumen/delete/(:num)',
        'Admin\AdminDokumen::delete/$1'
    );

    $routes->get(
        'dokumen/download/(:num)',
        'Admin\AdminDokumen::download/$1'
    );


    // =================================================
    // KATEGORI DOKUMEN
    // =================================================

    $routes->get(
        'kategori-dokumen',
        'Admin\KategoriDokumen::index'
    );

    $routes->get(
        'kategori-dokumen/create',
        'Admin\KategoriDokumen::create'
    );

    $routes->post(
        'kategori-dokumen/store',
        'Admin\KategoriDokumen::store'
    );

    $routes->get(
        'kategori-dokumen/delete/(:num)',
        'Admin\KategoriDokumen::delete/$1'
    );


    // =================================================
    // PROFIL ADMIN
    // =================================================

    $routes->get(
        'profil',
        'Admin\Profil::index'
    );

    $routes->get(
        'profil/create',
        'Admin\Profil::create'
    );

    $routes->post(
        'profil/store',
        'Admin\Profil::store'
    );
     $routes->get('profil/anggota/delete/(:num)', 'Admin\Profil::anggotaDelete/$1');


    // =================================================
    // ANGGOTA PROFIL
    // =================================================

    $routes->get(
        'profil/anggota/create',
        'Admin\Profil::anggotaCreate'
    );

    $routes->post(
        'profil/anggota/store',
        'Admin\Profil::anggotaStore'
    );

    $routes->get(
        'profil/anggota/edit/(:num)',
        'Admin\Profil::anggotaEdit/$1'
    );

    $routes->post(
        'profil/anggota/update/(:num)',
        'Admin\Profil::anggotaUpdate/$1'
    );


    // =================================================
    // KEGIATAN ADMIN
    // =================================================

    $routes->get(
        'kegiatan',
        'Admin\AdminKegiatan::index'
    );

    $routes->get(
        'kegiatan/create',
        'Admin\AdminKegiatan::create'
    );

    $routes->post(
        'kegiatan/store',
        'Admin\AdminKegiatan::store'
    );

    $routes->get(
        'kegiatan/edit/(:num)',
        'Admin\AdminKegiatan::edit/$1'
    );

    $routes->post(
        'kegiatan/update/(:num)',
        'Admin\AdminKegiatan::update/$1'
    );

    $routes->get(
        'kegiatan/delete/(:num)',
        'Admin\AdminKegiatan::delete/$1'
    );

    $routes->get(
        'kegiatan/delete-foto/(:num)',
        'Admin\AdminKegiatan::deleteFoto/$1'
    );

    $routes->get(
        'kegiatan/import',
        'Admin\AdminKegiatan::import'
    );

    $routes->post(
        'kegiatan/import',
        'Admin\AdminKegiatan::importProcess'
    );


    // =================================================
    // LAYANAN ADMIN
    // =================================================

    $routes->get(
        'layanan',
        'Admin\Layanan::index'
    );

    $routes->get(
        'layanan/create',
        'Admin\Layanan::create'
    );

    $routes->post(
        'layanan/store',
        'Admin\Layanan::store'
    );

    $routes->get(
        'layanan/edit/(:num)',
        'Admin\Layanan::edit/$1'
    );

    $routes->post(
        'layanan/update/(:num)',
        'Admin\Layanan::update/$1'
    );

    $routes->get(
        'layanan/delete/(:num)',
        'Admin\Layanan::delete/$1'
    );

    $routes->post(
        'layanan/toggle-status/(:num)',
        'Admin\Layanan::toggleStatus/$1'
    );


    // =================================================
    // DATA LAYANAN ADMIN
    // =================================================

    $routes->get(
        'datalayanan',
        'Admin\Datalayanan::index'
    );

    $routes->get(
        'datalayanan/create',
        'Admin\Datalayanan::create'
    );

    $routes->post(
        'datalayanan/store',
        'Admin\Datalayanan::store'
    );

    $routes->get(
        'datalayanan/edit/(:num)',
        'Admin\Datalayanan::edit/$1'
    );

    $routes->post(
        'datalayanan/update/(:num)',
        'Admin\Datalayanan::update/$1'
    );

    $routes->get(
        'datalayanan/delete/(:num)',
        'Admin\Datalayanan::delete/$1'
    );

    $routes->get(
        'datalayanan/export',
        'Admin\Datalayanan::export'
    );

    // IMPORT DATA
    $routes->get(
        'datalayanan/import',
        'Admin\Datalayanan::import'
    );

    $routes->post(
    'datalayanan/import/process',
    'Admin\Datalayanan::importProcess'
);

     // =====================================================
    // PENERIMA MANFAAT
    // =====================================================

    $routes->get(
        'penerima-manfaat',
        'Admin\PenerimaManfaat::index'
    );

    $routes->get(
        'penerima-manfaat/create',
        'Admin\PenerimaManfaat::create'
    );

    $routes->post(
        'penerima-manfaat/store',
        'Admin\PenerimaManfaat::store'
    );

    $routes->get(
        'penerima-manfaat/edit/(:num)',
        'Admin\PenerimaManfaat::edit/$1'
    );

    $routes->post(
        'penerima-manfaat/update/(:num)',
        'Admin\PenerimaManfaat::update/$1'
    );

    $routes->get(
        'penerima-manfaat/delete/(:num)',
        'Admin\PenerimaManfaat::delete/$1'
    );

    $routes->get(
    'penerima-manfaat/import',
    'Admin\PenerimaManfaat::import'
);

$routes->post(
    'penerima-manfaat/importProcess',
    'Admin\PenerimaManfaat::importProcess'
);


// DATA SKM
    $routes->get(
        'hasil-skm',
        'Admin\HasilSKM::index'
    );

    // HALAMAN IMPORT
    $routes->get(
        'hasil-skm/import',
        'Admin\HasilSKM::import'
    );

    // UPLOAD EXCEL
    $routes->post(
        'hasil-skm/import/process',
        'Admin\HasilSKM::importProcess'
    );

    // SIMPAN MAPPING
    $routes->post(
        'hasil-skm/import/save',
        'Admin\HasilSKM::importSave'
    );

    // DELETE
    $routes->get(
        'hasil-skm/delete/(:num)',
        'Admin\HasilSKM::delete/$1'
    );


});