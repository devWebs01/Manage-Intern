<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', [Home::class, 'dashboard']);


    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    $routes->get('participants', 'ParticipantsController::index');
    $routes->get('participants/create', 'ParticipantsController::create');
    $routes->post('participants/store', 'ParticipantsController::store');
    $routes->get('participants/edit/(:num)', 'ParticipantsController::edit/$1');
    $routes->post('participants/update/(:num)', 'ParticipantsController::update/$1');
    $routes->get('participants/delete/(:num)', 'ParticipantsController::delete/$1');
    
});