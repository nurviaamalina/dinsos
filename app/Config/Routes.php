<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');


/* Route Berita */
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');

//route profil
$routes->get('profil', 'Profil::index');

//layanan
$routes->get('layanan', 'Layanan::index');
$routes->get('layanan/detail/(:num)', 'Layanan::detail/$1');

//pengaduan
$routes->get('pengaduan', 'Pengaduan::index');

// =====================================================
// KEGIATAN FRONTEND
// =====================================================

$routes->get('kegiatan','Kegiatan::index');

$routes->get('kegiatan/tahun/(:num)','Kegiatan::tahun/$1'
);

$routes->get('kegiatan/(:segment)','Kegiatan::detail/$1'
);

// =====================================================
// BIDANG
// =====================================================

$routes->get('bidang/(:segment)', 'Bidang::detail/$1');

// =====================================================
// ISNTAGRAM
// =====================================================

$routes->get('instagram', 'Instagram::index');

/* ROUTE ADMINN */
$routes->group('admin', function ($routes) {

    $routes->get( 'dashboard','Admin\Dashboard::index');

 /*
    |--------------------------------------------------------------------------
    | DATA MASTER BIDANG
    |--------------------------------------------------------------------------
    */
    $routes->get('bidang','Admin\Bidang::index');
    $routes->get('bidang/create','Admin\Bidang::create');
    $routes->post('bidang/store','Admin\Bidang::store');
    $routes->get('bidang/edit/(:num)','Admin\Bidang::edit/$1' );
     $routes->post('bidang/update/(:num)', 'Admin\Bidang::update/$1');
     $routes->get('bidang/delete/(:num)', 'Admin\Bidang::delete/$1');
      $routes->get('bidang/detail/(:num)', 'Admin\Bidang::detail/$1');

       // Detail Bidang
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
 /*
    |--------------------------------------------------------------------------
    | DATA MASTER KECAMATAN
    |--------------------------------------------------------------------------
    */
     $routes->get('kecamatan','Admin\Kecamatan::index');
    $routes->get('kecamatan/create','Admin\Kecamatan::create');
    $routes->post('kecamatan/store','Admin\Kecamatan::store');
    $routes->get('kecamatan/edit/(:num)','Admin\Kecamatan::edit/$1');
    $routes->post('kecamatan/update/(:num)','Admin\Kecamatan::update/$1');
    $routes->get('kecamatan/delete/(:num)','Admin\Kecamatan::delete/$1');
      /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */
     $routes->get('berita', 'Admin\AdminBerita::index');
    $routes->get('berita/create', 'Admin\AdminBerita::create');
    $routes->post('berita/store', 'Admin\AdminBerita::store');
    $routes->get( 'berita/edit/(:num)','Admin\AdminBerita::edit/$1');
    $routes->post('berita/update/(:num)','Admin\AdminBerita::update/$1');
    $routes->get('berita/import', 'Admin\AdminBerita::import');
    $routes->post('berita/import', 'Admin\AdminBerita::importProcess');

    //PROFIL
    $routes->get('profil', 'Admin\Profil::index');
    $routes->get('profil/create', 'Admin\Profil::create');
    $routes->post('profil/store','Admin\Profil::store');


 /*
    |--------------------------------------------------------------------------
    | KEGIATAN
    |--------------------------------------------------------------------------
    */
    $routes->get('kegiatan', 'Admin\AdminKegiatan::index');

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
    /*
|--------------------------------------------------------------------------
| ANGGOTA PROFIL
|--------------------------------------------------------------------------
*/

    $routes->get('profil/anggota/create','Admin\Profil::anggotaCreate');

    $routes->post('profil/anggota/store','Admin\Profil::anggotaStore');
    $routes->get('profil/anggota/edit/(:num)','Admin\Profil::anggotaEdit/$1');

    $routes->post('profil/anggota/update/(:num)','Admin\Profil::anggotaUpdate/$1');

    /*
    |--------------------------------------------------------------------------
    | LAYANAN (TAMBAHAN BARU)
    |--------------------------------------------------------------------------
    */
    $routes->get('layanan', 'Admin\Layanan::index');
    $routes->get('layanan/create', 'Admin\Layanan::create');
    $routes->post('layanan/store', 'Admin\Layanan::store');
    $routes->get('layanan/edit/(:num)', 'Admin\Layanan::edit/$1');
    $routes->post('layanan/update/(:num)', 'Admin\Layanan::update/$1');
    $routes->get('layanan/delete/(:num)', 'Admin\Layanan::delete/$1');
    $routes->post('layanan/toggle-status/(:num)', 'Admin\Layanan::toggleStatus/$1');

    /*
    |--------------------------------------------------------------------------
    | DATALAYANAN
    |--------------------------------------------------------------------------
    */
    $routes->get('datalayanan', 'Admin\Datalayanan::index');
    $routes->get('datalayanan/create', 'Admin\Datalayanan::create');
    $routes->post('datalayanan/store', 'Admin\Datalayanan::store');
    $routes->get('datalayanan/edit/(:num)', 'Admin\Datalayanan::edit/$1');
    $routes->post('datalayanan/update/(:num)', 'Admin\Datalayanan::update/$1');
    $routes->get('datalayanan/delete/(:num)', 'Admin\Datalayanan::delete/$1');
    $routes->get('datalayanan/export', 'Admin\Datalayanan::export');
    $routes->get('datalayanan/import', 'Admin\Datalayanan::import');
    $routes->post('datalayanan/import', 'Admin\Datalayanan::importProcess');
});