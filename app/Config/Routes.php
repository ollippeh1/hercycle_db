<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

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

$routes->group('user', function ($routes) {
    $routes->get('edukasi', 'Edukasi::index');
    $routes->get('edukasi/(:num)', 'Edukasi::detail/$1');
    $routes->get('chatbot', 'Chatbot::index');
    $routes->post('chatbot/generate', 'Chatbot::generateContent');

    $routes->get('chatbot', 'User\ChatbotController::index');
    $routes->post('chatbot/send', 'User\ChatbotController::chat');
});


$routes->group('register', function($routes){
    $routes->get('/', 'RegisterController::index');
    $routes->post('/', 'RegisterController::store');
});

$routes->group('login', function($routes){
    $routes->get('/', 'LoginController::index');
    $routes->post('/', 'LoginController::login');
});

$routes->get('logout', 'LoginController::logout');

$routes->group('lupapw', function($routes){
    $routes->get('/', 'LupapwController::index'); // form email
    $routes->post('/', 'LupapwController::sendResetLink'); // kirim OTP

    $routes->get('verifikasiotp', 'LupapwController::showOTPForm'); // form OTP
    $routes->post('verifikasiotp', 'LupapwController::verifyOTP'); // verifikasi OTP

    $routes->get('ubahpw', 'LupapwController::showPasswordForm'); // form ubah password
    $routes->post('ubahpw', 'LupapwController::resetPassword'); // submit password baru

    $routes->get('testEmail', 'LupapwController::testEmail');
});

$routes->group('profil', function($routes){
    $routes->get('/', 'profilController::index');
    $routes->get('editp', 'profilController::showEditForm');
    $routes->post('editp', 'profilController::updatep');
    $routes->post('hapusacc', 'ProfilController::hapusAkun');

});

// Rute default
$routes->get('/', 'Splash::index');

// Rute untuk controller Splash
$routes->get('splash', 'Splash::index'); // Ini sudah benar

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/events', 'Dashboard::events');
$routes->get('/note', 'Note::index');
$routes->post('dashboard/catat', 'Dashboard::catat');
$routes->post('/catat-haid', 'Dashboard::catatHaid');
$routes->post('/catat-haid-hari-ini', 'Dashboard::catatHaidHariIni');



$routes->setAutoRoute(false);

$routes->get('/', 'Kalender::index'); // Biar root juga buka kalender
$routes->get('kalender', 'Kalender::index');


$routes->get('/kalender', 'Kalender::index');
$routes->post('/kalender/simpan', 'Kalender::simpan');