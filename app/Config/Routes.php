<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->get('/data', 'Data::index');

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::store');
$routes->post('/logout', 'Login::destroy');

$routes->get('/users', 'User::index');
$routes->get('/users/add', 'User::create');
$routes->post('/users', 'User::store');
$routes->get('/users/{id}/edit', 'User::edit');
$routes->put('/users/{id}', 'User::update');
$routes->delete('/users/{id}', 'User::destoy');
