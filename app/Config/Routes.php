<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

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
