<?php

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
});

$routes->group('user', function($routes) {
    $routes->get('chatbot', 'User\ChatbotController::index');
    $routes->post('chatbot/send', 'User\ChatbotController::chat');
});