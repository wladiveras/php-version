<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();

$url = constant('URL_SUBFOLDER');

// Stoves
$routes->add(
    'stove',
    new Route("{$url}/stove/{id}", ['controller' => 'StoveController', 'method' => 'show'], ['id' => '[0-9]+'])
);

// Users
$routes->add(
    'homepage',
    new Route("{$url}/", ['controller' => 'UsersController', 'method' => 'index'], [])
);
