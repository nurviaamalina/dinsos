<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');


/* Route Berita */
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');


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

});