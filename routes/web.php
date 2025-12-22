<?php
// Web Routes

// PUBLIC ROUTES
$router->get('/', 'HomeController@index');
$router->get('/kuota', 'HomeController@kuota');
$router->get('/kuota/{id}', 'HomeController@detail');
$router->get('/jadwal', 'HomeController@jadwal');
$router->get('/persyaratan', 'HomeController@persyaratan');

// AUTH ROUTES
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');

// SISWA ROUTES (requires login)
$router->get('/dashboard', 'SiswaController@dashboard');
$router->get('/daftar/zonasi', 'SiswaController@formZonasi');
$router->post('/daftar/zonasi', 'SiswaController@submitZonasi');
$router->get('/daftar/afirmasi', 'SiswaController@formAfirmasi');
$router->post('/daftar/afirmasi', 'SiswaController@submitAfirmasi');
$router->get('/daftar/prestasi', 'SiswaController@formPrestasi');
$router->post('/daftar/prestasi', 'SiswaController@submitPrestasi');
$router->get('/daftar/mutasi', 'SiswaController@formMutasi');
$router->post('/daftar/mutasi', 'SiswaController@submitMutasi');
$router->get('/cetak/pendaftaran', 'SiswaController@cetakPendaftaran');
$router->get('/cetak/diterima', 'SiswaController@cetakDiterima');
$router->get('/cetak/daftar-ulang', 'SiswaController@cetakDaftarUlang');

// ADMIN ROUTES
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/login', 'AdminController@showLogin');
$router->post('/admin/login', 'AdminController@login');
$router->get('/admin/sekolah', 'AdminController@sekolah');
$router->get('/admin/sekolah/tambah', 'AdminController@tambahSekolah');
$router->post('/admin/sekolah/tambah', 'AdminController@storeSekolah');
$router->get('/admin/sekolah/edit/{id}', 'AdminController@editSekolah');
$router->post('/admin/sekolah/update/{id}', 'AdminController@updateSekolah');
$router->get('/admin/sekolah/hapus/{id}', 'AdminController@hapusSekolah');

// 404 Not Found
$router->notFound(function() {
    http_response_code(404);
    view('errors.404');
});
