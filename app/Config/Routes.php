<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ====================== ADMIN ======================
$routes->group('admin', function ($routes) {
    $routes->get('materi', 'Materi::index');
    $routes->get('materi/tambah', 'Materi::tambah');
    $routes->post('materi/simpan', 'Materi::simpan');
    $routes->get('materi/detail/(:num)', 'Materi::detail/$1');
    $routes->get('materi/edit/(:num)', 'Materi::edit/$1');
    $routes->post('materi/update/(:num)', 'Materi::update/$1');
    $routes->get('materi/hapus/(:num)', 'Materi::hapus/$1');
    $routes->get('logout', 'Auth::logout');
});

// ====================== USER ======================
$routes->group('user', function ($routes) {
    $routes->get('edukasi', 'Edukasi::index');
    $routes->get('edukasi/(:num)', 'Edukasi::detail/$1');

    $routes->get('chatbot', 'Chatbot::index'); // Rute GET
    $routes->post('chatbot/send', 'Chatbot::chat'); // Rute POST
});


// ====================== AUTH ======================
$routes->group('register', function($routes){
    $routes->get('/', 'RegisterController::index');
    $routes->post('/', 'RegisterController::store');
});

$routes->group('login', function($routes){
    $routes->get('/', 'LoginController::index');
    $routes->post('/', 'LoginController::login');
});

$routes->get('logout', 'LoginController::logout');

// ====================== LUPA PASSWORD ======================
$routes->group('lupapw', function($routes){
    $routes->get('/', 'LupapwController::index');
    $routes->post('/', 'LupapwController::sendResetLink');

    $routes->get('verifikasiotp', 'LupapwController::showOTPForm');
    $routes->post('verifikasiotp', 'LupapwController::verifyOTP');

    $routes->get('ubahpw', 'LupapwController::showPasswordForm');
    $routes->post('ubahpw', 'LupapwController::resetPassword');

    $routes->get('testEmail', 'LupapwController::testEmail');
});

// ====================== PROFIL ======================
$routes->group('profil', function($routes){
    $routes->get('/', 'ProfilController::index');
    $routes->get('editp', 'ProfilController::showEditForm');
    $routes->post('editp', 'ProfilController::updatep');
    $routes->post('hapusacc', 'ProfilController::hapusAkun');
});

// ====================== HALAMAN UTAMA ======================
$routes->get('/', 'Splash::index');
$routes->get('splash', 'Splash::index');

// ====================== DASHBOARD ======================
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/events', 'Dashboard::events');
$routes->post('dashboard/catat', 'Dashboard::catat');
$routes->post('catat-haid', 'Dashboard::catatHaid');
$routes->post('catat-haid-hari-ini', 'Dashboard::catatHaidHariIni');

// ====================== NOTE ======================
$routes->get('note', 'NoteController::index');
$routes->post('note/save', 'NoteController::save');

// ====================== KALENDER ======================
$routes->get('kalender', 'Kalender::index');
$routes->post('kalender/simpan', 'Kalender::simpan');

$routes->get('artikel/haid', 'Edukasi::haid');
$routes->get('artikel/hamil', 'Edukasi::hamil');
$routes->get('artikel/semua', 'Edukasi::index');
$routes->get('user/edukasi/(:num)', 'Edukasi::detail/$1');


// ====================== PENGATURAN UMUM ======================
$routes->setAutoRoute(false);