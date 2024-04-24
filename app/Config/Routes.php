<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('access', 'Home::access_data');
$routes->get('test', 'Home::test');

//save guest route
$routes->post('save-guest', 'Home::save_guest');
