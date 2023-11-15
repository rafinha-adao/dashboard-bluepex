<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->add('(:any)', 'Dashboard::catchAll');

$routes->get('/data', 'Data::index');

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::store');
$routes->get('/logout', 'Login::destroy');

$routes->get('/users', 'User::index');
$routes->get('/users/add', 'User::create');
$routes->post('/users', 'User::store');
$routes->get('/users/(:num)/edit', 'User::edit/$1');
$routes->put('/users/(:num)', 'User::update/$1');
$routes->delete('/users/(:num)', 'User::destoy/$1');
