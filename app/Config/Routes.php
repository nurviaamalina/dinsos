<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */


// =====================================================
// FRONTEND
// =====================================================

// Home
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');


// Berita
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');


// FRONTEND DOKUMEN
$routes->get('dokumen', 'Dokumen::index');
$routes->get('dokumen/detail/(:num)', 'Dokumen::detail/$1');


// =====================================================
// ADMIN
// =====================================================

$routes->group('admin', function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');


    /*
    |--------------------------------------------------------------------------
    | BERITA ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get('berita', 'Admin\AdminBerita::index');

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


    /*
|--------------------------------------------------------------------------
| DOKUMEN ADMIN
|--------------------------------------------------------------------------
*/
    $routes->get('dokumen', 'Admin\AdminDokumen::index');

    $routes->get('dokumen/create', 'Admin\AdminDokumen::create');

    $routes->post('dokumen/store', 'Admin\AdminDokumen::store');

    $routes->get('dokumen/edit/(:num)', 'Admin\AdminDokumen::edit/$1');

    $routes->post('dokumen/update/(:num)', 'Admin\AdminDokumen::update/$1');

    $routes->get('dokumen/delete/(:num)', 'Admin\AdminDokumen::delete/$1');

    $routes->get('dokumen/download/(:num)', 'Admin\AdminDokumen::download/$1');


    // ==============================
        // KATEGORI DOKUMEN
        // ==============================

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

    }
);



