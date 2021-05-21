<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('GS_home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->resource('Apilogin');
$routes->resource('Apiposttest');
$routes->resource('Apipretest');
$routes->resource('Apiexperiment');
$routes->resource('Apigamefinish');
$routes->resource('Apigames');

//, ['filter' => 'Authfilter']
$routes->get('home', 'Home::index');
$routes->get('auth/login', 'Auth::index');
$routes->add('logout', 'Auth::logout');
$routes->add('auth/cek', 'Auth::ceklogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register/save', 'Auth::save_register');


$routes->group('users', function ($routes) {
	$routes->get('photo', 'Users::viewphoto');
	$routes->post('photo/add', 'Users::uploadphoto');
	$routes->get('identitas', 'Users::viewidentitas');
	$routes->get('identitas/view', 'Users::editview');
	$routes->post('identitas/add', 'Users::identitasupdate');
	$routes->get('kelas', 'Users::viewkelas');
	$routes->post('kelas/add', 'Users::addkelas');
	$routes->post('kelas/guru/add', 'Users::addkelasguru');
	$routes->get('kelas/guru/edit/(:num)', 'Users::editViewkelasguru/$1');
	$routes->post('simpankelas', 'Users::editkelasguru');
	/* registrasi tambahan untuk guru */
	$routes->get('sekolah/edit', 'Users::editViewSekolahguru');
	$routes->post('sekolah/add', 'Users::simpanSekolahguru');
	$routes->post('sekolah/update', 'Users::updateViewSekolahguru');
	$routes->get('guru', 'Users::aktifasiKelas');
	$routes->post('aktivasi/kelas', 'Users::addaktivasikelas');
	$routes->get('sekolah', 'Users::viewsekolah');
	$routes->post('posting', 'Users::postPosting');
	$routes->get('posting/hapus/(:any)', 'Users::hapusPosting/$1');
	$routes->post('komentar/(:num)', 'Users::postKomentar/$1');
	$routes->get('komentar/view/(:num)', 'Users::viewkomentar/$1');
	$routes->get('komentar/detail/(:num)', 'Users::detailkomentar/$1');
	$routes->get('komentar/orang/(:any)', 'Users::hapusKomentarOrang/$1');
	$routes->get('komentar/hapus/(:num)', 'Users::hapuskomentar/$1');
	$routes->get('komentar/pdf/(:num)', 'Users::viewkomentarpdf/$1');
});

$routes->group('praktikum', function ($routes) {
	$routes->get('nilai', 'Praktikum::viewNilaiSiswaPraktikum');
	$routes->get('siswa', 'Praktikum::getpraktikumkelas');
	$routes->get('detail/(:num)', 'Praktikum::praktikumdetail/$1');
	$routes->get('modul/unduh/(:num)', 'Praktikum::viewpdfpraktikum/$1');
	$routes->post('mulai', 'Praktikum::mulaipraktikum');
	$routes->get('guru/nilai', 'Praktikum::viewNilaiGuruPraktikum');
	$routes->get('penilaian/detail/(:num)', 'Praktikum::viewNilaiGuruPraktikumDetail/$1');
	$routes->get('guru/list', 'Praktikum::viewPraktikumList');
	$routes->get('guru/detail/(:num)', 'Praktikum::praktikumgurudetail/$1');
	$routes->get('guru/ubahview/(:num)', 'Praktikum::viewUpdatePraktikum/$1');
	$routes->post('tambah', 'Praktikum::praktikum_add');
	$routes->post('ubah', 'Praktikum::praktikum_update');
	$routes->get('hapus/(:num)', 'Praktikum::praktikum_delete/$1');
	$routes->get('sentkode/(:any)', 'Praktikum::praktikum_getkode/$1');
});

$routes->group('modul', function ($routes) {
	$routes->get('siswa', 'Modul::getmodulpraktikumsiswa');
	$routes->get('guru', 'Modul::getmodulpraktikumguru');
	$routes->get('file/guru', 'Modul::getfilemodulguru');
	$routes->get('myfile/guru', 'Modul::getmyfileguru');
	$routes->post('myfile/simpan', 'Modul::simpanFileGuru');
	$routes->get('file/siswa', 'Modul::getfilemodulguru');
	$routes->get('myfile/siswa', 'Modul::getmyfileguru');
	$routes->get('praktikum/unduh/(:any)', 'Modul::viewModulpdf/$1');
	$routes->get('file/unduh/(:any)', 'Modul::viewfilepdf/$1');
	$routes->get('myfile/hapus/(:any)', 'Modul::hapusfilepdf/$1');
	$routes->get('myfile/unduh/(:any)', 'Modul::viewmyfilepdf/$1');
});

/* dashboard */
$routes->get('dashboard', 'Dashboard::index');


$routes->get('kelas', 'Kelas::index');
$routes->get('murid', 'Kelas::showKelasSiswa');
$routes->get('sekolah', 'Sekolah::index');
/* aktifasi untuk guru */
$routes->get('kelas/aktivasi/(:num)', 'Kelas::aktivasikelas/$1');


$routes->group('identitas', function ($routes) {
	$routes->get('photo', 'Identitas::viewphoto');
	$routes->post('photo/add', 'Identitas::uploadphoto');
	$routes->get('identitas', 'Identitas::viewidentitas');
	$routes->get('identitas/view', 'Identitas::editview');
	$routes->post('identitas/add', 'Identitas::identitasupdate');
	$routes->get('kelas', 'Identitas::viewkelas');
	$routes->post('kelas/add', 'Identitas::addkelas');
	$routes->get('sekolah', 'Identitas::viewsekolah');
	$routes->get('pass/ubah', 'Identitas::ubahpassword');
	$routes->get('sekolah/edit', 'Users::editViewSekolahguru');
	$routes->post('sekolah/add', 'Users::simpanSekolahguru');
	$routes->post('sekolah/update', 'Users::updateViewSekolahguru');
	$routes->get('password', 'Identitas::viewPassword');
	$routes->post('password/update', 'Identitas::updatePassword');
});






/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


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
