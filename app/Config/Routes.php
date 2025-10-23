<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/users', 'UserController::index');

// Showing pages
$routes->get('/auth', 'Auth_controller::index');
$routes->get('/content-management', 'Project_controller::page');
$routes->get('/profile', 'Profile_controller::index');
$routes->get('/settings', 'Setting_controller::page');

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

$routes->group('settings-test', function($routes) {
    $routes->get('/', 'Setting_controller::index');
    $routes->get('(:num)', 'Setting_controller::show/$1');
});

// Settings CRUD
$routes->post('/settings/user', 'Setting_controller::updateUserBasics');

// What I Do
$routes->post('/settings/what-i-do', 'Setting_controller::storeWhatIDo');
$routes->post('/settings/what-i-do/(:num)', 'Setting_controller::updateWhatIDo/$1');
$routes->post('/settings/what-i-do/(:num)/delete', 'Setting_controller::deleteWhatIDo/$1');

// Social Links
$routes->post('/settings/social-links', 'Setting_controller::storeSocialLink');
$routes->post('/settings/social-links/(:num)', 'Setting_controller::updateSocialLink/$1');
$routes->post('/settings/social-links/(:num)/delete', 'Setting_controller::deleteSocialLink/$1');

// Skills
$routes->post('/settings/skills', 'Setting_controller::storeSkill');
$routes->post('/settings/skills/(:num)', 'Setting_controller::updateSkill/$1');
$routes->post('/settings/skills/(:num)/delete', 'Setting_controller::deleteSkill/$1');

// Project CRUD
$routes->post('/projects', 'Project_controller::store');
$routes->post('/projects/(:num)', 'Project_controller::update/$1');
$routes->post('/projects/(:num)/delete', 'Project_controller::delete/$1');

$routes->group('projects-test', function($routes) {
    $routes->get('/', 'Project_controller::index');
    $routes->get('(:num)', 'Project_controller::show/$1');
});