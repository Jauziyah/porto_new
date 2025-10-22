<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/users', 'UserController::index');

// Showing pages
$routes->get('/auth', 'Auth_controller::index');

// endpoint for authentication
$routes->post('/login', 'Auth_controller::login');
$routes->get('/dashboard', 'Auth_controller::dashboard');
$routes->get('/content-management', 'Auth_controller::contentManagement');
$routes->get('/logout', 'Auth_controller::logout');

