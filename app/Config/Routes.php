<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->presenter('mahasiswa');
$routes->presenter('dosen');
$routes->presenter('matakuliah');

$routes->get('perkuliahan', 'Perkuliahan::index');
$routes->get('perkuliahan/new', 'Perkuliahan::new');
$routes->post('perkuliahan/create', 'Perkuliahan::create');
$routes->get('perkuliahan/edit/(:segment)/(:segment)', 'Perkuliahan::edit/$1/$2');
$routes->post('perkuliahan/update/(:segment)/(:segment)', 'Perkuliahan::update/$1/$2');
$routes->get('perkuliahan/delete/(:segment)/(:segment)', 'Perkuliahan::delete/$1/$2');
