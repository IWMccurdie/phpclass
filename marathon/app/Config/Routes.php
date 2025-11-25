<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->post('/create', 'Home::create');

//admin routes
$routes->get('/admin', 'Admin::index');
$routes->get('/marathon', 'Admin::manage_marathon');
$routes->get('/add', 'Admin::add_marathon');
$routes->get('/runners', 'Admin::manage_runners');
$routes->get('/registration', 'Admin::registration_form');

//race routes
$routes->post('/add_race', 'Admin::add_race');
$routes->post('/edit_race', 'Admin::edit_race');
$routes->get('/update_race/(:any)', 'Admin::update_race/$1');
$routes->get('/delete_race/(:any)', 'Admin::delete_race/$1');



