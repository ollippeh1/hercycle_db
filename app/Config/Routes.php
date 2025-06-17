<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman awal (landing page)
$routes->get('/', 'Home::index');

$routes->get('/', 'Kalender::index'); // Biar root juga buka kalender
$routes->get('kalender', 'Kalender::index');


$routes->get('/kalender', 'Kalender::index');
$routes->post('/kalender/simpan', 'Kalender::simpan');






