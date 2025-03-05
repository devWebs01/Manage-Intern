<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', [Home::class, 'dashboard']);


   // Routes untuk Users
$routes->resource('users', [
    'controller' => 'UserController',
    'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
]);

// Routes untuk Participants
$routes->resource('participants', [
    'controller' => 'ParticipantsController',
    'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
]);

$routes->resource('logbooks', [
    'controller' => 'LogbooksController',
    'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
]);

$routes->resource('presences', [
    'controller' => 'PresencesController',
    'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
]);
    
});