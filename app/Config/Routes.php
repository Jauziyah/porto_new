<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UserController::index');


$routes->get('/auth', 'Auth_controller::index');
$routes->post('/login', 'Auth_controller::login');
$routes->get('/dashboard', 'Auth_controller::dashboard');