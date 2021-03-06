<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/dashboard', 'Home::dashboard', ['filter'=>'auth']);

$routes->get('/', 'Home::index');
//$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/pesanan', 'PesananController::index');
$routes->get('/detail', 'DetailController::tampil');

$routes->get('/user', 'UserController::index');
$routes->add('user', 'UserController::create');
$routes->add('/user/edit/(:segment)', 'UserController::edit/$1');
$routes->get('/user/delete/(:segment)', 'UserController::delete/$1');

$routes->get('/menu', 'MenuController::index');
$routes->add('menu', 'MenuController::create');
$routes->add('/menu/edit/(:segment)', 'MenuController::edit/$1');
$routes->get('menu/delete/(:segment)', 'MenuController::delete/$1');

$routes->get('/pesanan', 'PesananController::index');
$routes->add('/pesanan', 'PesananController::addCart');
$routes->add('/pesanans', 'PesananController::simpan');
$routes->get('/pesanan/delete/(:segment)', 'PesananController::hapusCart/$1');

$routes->get('/detail', 'detailController::tampil');
//$routes->add('/details', 'detailController::create');
//$routes->get('detail/delete/(:segment', 'detailController: :deleteCart/s1');

$routes->get('/laporan', 'LaporanController::tampil');
$routes->get('laporan/delete/(:segment)', 'LaporanController::delete/$1');

$routes->get('/login', 'UserController::tlogin');
$routes->add('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
