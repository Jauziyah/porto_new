<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/users', 'UserController::index');

// Showing pages
$routes->get('/auth', 'Auth_controller::index');
$routes->get('/content-management', 'Auth_controller::contentManagement');
$routes->get('/profile', 'Auth_controller::profile');
$routes->get('/settings', 'Auth_controller::settings');

// endpoint for authentication
$routes->post('/login', 'Auth_controller::login');
$routes->get('/logout', to: 'Auth_controller::logout');

