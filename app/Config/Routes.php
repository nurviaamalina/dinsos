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

// =====================================================
// BIDANG
// =====================================================

$routes->get('bidang', 'Bidang::index');

/* ROUTE ADMINN */
$routes->group('admin', function ($routes) {

    $routes->get( 'dashboard','Admin\Dashboard::index');


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
| ANGGOTA PROFIL
|--------------------------------------------------------------------------
*/

    $routes->get('profil/anggota/create','Admin\Profil::anggotaCreate');

    $routes->post('profil/anggota/store','Admin\Profil::anggotaStore');
    $routes->get('profil/anggota/edit/(:num)','Admin\Profil::anggotaEdit/$1');

    $routes->post('profil/anggota/update/(:num)','Admin\Profil::anggotaUpdate/$1');
});