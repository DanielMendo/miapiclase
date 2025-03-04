<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->resource('users', ['controller' => 'UserController']);
//$routes->get('users', 'User::index', ['filter' => 'cors']);

$routes->resource('users', ['controller' => 'User', 'filter' => 'cors']);

$routes->resource('posts', ['controller' => 'Post', 'filter' => 'cors']);

