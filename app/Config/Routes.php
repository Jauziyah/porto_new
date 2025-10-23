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
$routes->get('/profile', 'Profile_controller::index');
$routes->get('/settings', 'Auth_controller::settings');

// endpoint for authentication
$routes->post('/login', 'Auth_controller::login');
$routes->get('/logout', 'Auth_controller::logout');


// Profile Management (alias)
$routes->get('/profile/manage', 'Profile_controller::index');

// Categories CRUD
$routes->post('/profile/categories', 'Profile_controller::storeCategory');
$routes->post('/profile/categories/(:num)', 'Profile_controller::updateCategory/$1');
$routes->post('/profile/categories/(:num)/delete', 'Profile_controller::deleteCategory/$1');

// Tech Stack CRUD
$routes->post('/profile/tech', 'Profile_controller::storeTech');
$routes->post('/profile/tech/(:num)', 'Profile_controller::updateTech/$1');
$routes->post('/profile/tech/(:num)/delete', 'Profile_controller::deleteTech/$1');

// Image upload routes for tech stack
$routes->get('/tech_stack/(:any)', 'Profile_controller::serveImage/$1');