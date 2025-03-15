<?php

use App\Controllers\Admin\CompanyProfileController;
use App\Controllers\Mentor\ParticipantAssessmentsController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);
$routes->get('/test', [Home::class, 'test']);

$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', [Home::class, 'dashboard']);


    // Routes untuk Users
    $routes->resource('users', [
        'controller' => 'UserController',
        'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
    ]);

    // Routes untuk Mentors
    $routes->resource('mentors', [
        'controller' => 'MentorsController',
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

    $routes->resource('assessment-indicators', [
        'controller' => 'AssessmentIndicatorsController',
        'only' => ['index', 'new', 'create', 'edit', 'update', 'delete']
    ]);

    $routes->resource('internships', [
        'controller' => 'InternshipsController',
        'only' => ['index', 'show']
    ]);

    $routes->get('/participant-assessments', [ParticipantAssessmentsController::class, 'index']);
    $routes->get('/participant-assessments/(:num)/new', [ParticipantAssessmentsController::class, 'new']);
    $routes->post('/participant-assessments', [ParticipantAssessmentsController::class, 'create']);
    $routes->get('/participant-assessments/(:num)/edit', [ParticipantAssessmentsController::class, 'edit']);
    $routes->put('/participant-assessments/(:num)', [ParticipantAssessmentsController::class, 'update']);


    $routes->get('/profiles/(:num)/show', [Home::class, 'show']);
    $routes->put('/profiles/(:num)', [Home::class, 'update']);

    $routes->get('/company-profile/show', [CompanyProfileController::class, 'show']);
    $routes->put('/company-profile/update', [CompanyProfileController::class, 'update']);

});