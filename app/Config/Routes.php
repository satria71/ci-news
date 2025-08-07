<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//login
$routes->get('auth', 'Auth::index');
$routes->get('login', 'Auth::login');
$routes->post('auth/loginProcess', 'Auth::loginProcess');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('/', 'Home::index');
// $routes->addRedirect('/', 'home');
$routes->get('masteratk', 'MasterAtk::index');
//read
$routes->get('masteratk/add', 'MasterAtk::create');
//create
$routes->post('masteratk', 'MasterAtk::store');
//update
$routes->get('masteratk/edit/(:any)', 'MasterAtk::edit/$1');
$routes->put('masteratk/(:any)', 'MasterAtk::update/$1');
//delete
$routes->delete('masteratk/(:any)', 'MasterAtk::delete/$1');

//ATK Datang
$routes->get('atk/datang', 'AtkDatang::index');


