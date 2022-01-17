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
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::index');

$routes->get('login', 'Login::index');
$routes->post('login', 'Login::auth');
$routes->add('logout', 'Login::logout');

/*Anggota*/
$routes->add('daftar_anggota', 'Anggota::index');
$routes->add('daftar_anggota/modal/add', 'Anggota::modal_add');
$routes->add('daftar_anggota/modal/edit', 'Anggota::modal_edit');
$routes->add('daftar_anggota/save', 'Anggota::save');
$routes->add('daftar_anggota/update', 'Anggota::update');
$routes->add('daftar_anggota/delete', 'Anggota::delete');

/*asaet pemuda*/
$routes->get('aset-pemuda', 'Aset::index');

$routes->get('aset-pemuda/modal/add', 'Aset::modal_add');
$routes->get('aset-pemuda/modal/view', 'Aset::modal_view');
$routes->get('aset-pemuda/modal/edit/(:any)', 'Aset::modal_edit/$1');
$routes->post('aset-pemuda/update', 'Aset::update');
$routes->post('aset-pemuda/save', 'Aset::save');
$routes->add('aset-pemuda/delete/(:any)', 'Aset::delete/$1');

$routes->get('aset-pemuda/modal/history/add', 'Aset::modal_add_history');
$routes->get('aset-pemuda/modal/history/edit/(:any)', 'Aset::modal_edit_history/$1');
$routes->post('aset-pemuda/modal/history/save', 'Aset::save_history');
$routes->post('aset-pemuda/modal/history/update', 'Aset::update_history');
$routes->add('aset-pemuda/modal/history/delete/(:any)', 'Aset::delete_history/$1');

/*uang Kas*/
$routes->add('uang_kas', 'UangKas::index');
$routes->add('uang_kas/modal/add', 'UangKas::modal_add');
$routes->add('uang_kas/modal/edit', 'UangKas::modal_edit');
$routes->add('uang_kas/save', 'UangKas::save');
$routes->add('uang_kas/update', 'UangKas::update');
$routes->add('uang_kas/delete', 'UangKas::delete');


/*Akun*/
$routes->add('akun/modal/add', 'Akun::modal_add');
$routes->add('akun/modal/edit', 'Akun::modal_edit');

/*Event*/
$routes->add('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/lihat/(:any)', 'Kegiatan::lihat/$1');
$routes->get('kegiatan/edit/(:any)', 'Kegiatan::edit/$1');
$routes->post('kegiatan/add', 'Kegiatan::add');
$routes->post('kegiatan/update', 'Kegiatan::update');
$routes->post('kegiatan/tambah/saran', 'Kegiatan::tambah_saran');
$routes->post('kegiatan/tambah/foto', 'Kegiatan::tambah_foto');
$routes->get('kegiatan/delete/kegiatan/(:any)', 'Kegiatan::delete/$1');
$routes->get('kegiatan/ajax/peserta', 'Kegiatan::json_peserta_kegiatan');
$routes->post('kegiatan/delete/image', 'Kegiatan::delete_image');
$routes->post('kegiatan/delete/saran', 'Kegiatan::delete_saran');
$routes->post('kegiatan/presensi', 'Kegiatan::presensi');
$routes->post('kegiatan/approve/presensi', 'Kegiatan::approve_presensi');
$routes->get('kegiatan/aktifkan/(:any)', 'Kegiatan::aktifkan_kegiatan/$1');
$routes->get('kegiatan/nonaktifkan/(:any)', 'Kegiatan::nonaktifkan_kegiatan/$1');

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
