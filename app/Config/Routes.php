<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes (no authentication required)
$routes->get('/', 'Porto_controller::index');
$routes->get('/auth', 'Auth_controller::index');
$routes->post('/login', 'Auth_controller::login');

// Public image serving
$routes->get('/tech_stack/(:any)', 'Profile_controller::serveImage/$1');

// Public portfolio pages (display only)
$routes->get('/content-management', 'Project_controller::page');
$routes->get('/profile', 'Profile_controller::index');
$routes->get('/settings', 'Setting_controller::page');

// Public API endpoints for portfolio data (cleaner API structure)
$routes->get('/api/categories', 'Profile_controller::getCategories');
$routes->get('/api/tech-stack', 'Profile_controller::getTechStack');        
$routes->get('/api/what-i-do', 'Setting_controller::getWhatIDo');
$routes->get('/api/social-links', 'Setting_controller::getSocialLinks');
$routes->get('/api/skills', 'Setting_controller::getSkills');
$routes->get('/api/projects', 'Project_controller::getProjects');
$routes->get('/api/projects/(:num)', 'Project_controller::show/$1');

// Test routes (public) - optional, can be removed in production
$routes->get('settings-test', 'Setting_controller::index');
$routes->get('settings-test/(:num)', 'Setting_controller::show/$1');
$routes->get('projects-test', 'Project_controller::index');
$routes->get('projects-test/(:num)', 'Project_controller::show/$1');

// PROTECTED ROUTES (authentication required)
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Authentication
    $routes->get('/logout', 'Auth_controller::logout');

    // Admin management pages
    $routes->get('/profile/manage', 'Profile_controller::index');

    // Categories CRUD (Write operations only)
    $routes->post('/profile/categories', 'Profile_controller::storeCategory');
    $routes->post('/profile/categories/(:num)', 'Profile_controller::updateCategory/$1');
    $routes->post('/profile/categories/(:num)/delete', 'Profile_controller::deleteCategory/$1');

    // Tech Stack CRUD (Write operations only)
    $routes->post('/profile/tech', 'Profile_controller::storeTech');
    $routes->post('/profile/tech/(:num)', 'Profile_controller::updateTech/$1');
    $routes->post('/profile/tech/(:num)/delete', 'Profile_controller::deleteTech/$1');

    // Settings CRUD (Write operations only)
    $routes->post('/settings/user', 'Setting_controller::updateUserBasics');

    // What I Do CRUD (Write operations only)
    $routes->post('/settings/what-i-do', 'Setting_controller::storeWhatIDo');
    $routes->post('/settings/what-i-do/(:num)', 'Setting_controller::updateWhatIDo/$1');
    $routes->post('/settings/what-i-do/(:num)/delete', 'Setting_controller::deleteWhatIDo/$1');

    // Social Links CRUD (Write operations only)
    $routes->post('/settings/social-links', 'Setting_controller::storeSocialLink');
    $routes->post('/settings/social-links/(:num)', 'Setting_controller::updateSocialLink/$1');
    $routes->post('/settings/social-links/(:num)/delete', 'Setting_controller::deleteSocialLink/$1');

    // Skills CRUD (Write operations only)
    $routes->post('/settings/skills', 'Setting_controller::storeSkill');
    $routes->post('/settings/skills/(:num)', 'Setting_controller::updateSkill/$1');
    $routes->post('/settings/skills/(:num)/delete', 'Setting_controller::deleteSkill/$1');

    // Project CRUD (Write operations only)
    $routes->post('/projects', 'Project_controller::store');
    $routes->post('/projects/(:num)', 'Project_controller::update/$1');
    $routes->post('/projects/(:num)/delete', 'Project_controller::delete/$1');
});