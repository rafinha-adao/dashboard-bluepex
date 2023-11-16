<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->add('(:any)', 'Dashboard::catchAll');

$routes->get('/data', 'Data::index');

$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::destroy');
$routes->post('/login', 'Login::store', ['filter' => 'csrf']);

$routes->get('/users', 'User::index');
$routes->get('/users/add', 'User::create');
$routes->get('/users/(:num)/edit', 'User::edit/$1');
$routes->post('/users', 'User::store', ['filter' => 'csrf']);
$routes->put('/users/(:num)', 'User::update/$1', ['filter' => 'csrf']);
$routes->delete('/users/(:num)', 'User::destroy/$1', ['filter' => 'csrf']);
