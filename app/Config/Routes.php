<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


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
