<?php

use App\Core\Router;
use App\Core\Request;

use App\Controllers\UserController;
use App\Controllers\AddressController;
use App\Controllers\CityController;
use App\Controllers\StateController;
use App\Controllers\StoveController;

$router = new Router(new Request);

// UserController Routes
$router->get('/user/all', function (Request $request) {
    $controller = new UserController();
    $controller->index($request);
});

$router->get('/user', function (Request $request) {
    $controller = new UserController();
    $controller->show($request);
});

$router->put('/user', function (Request $request) {
    $controller = new UserController();
    $controller->update($request);
});

$router->post('/user', function (Request $request) {
    $controller = new UserController();
    $controller->create($request);
});

$router->delete('/user', function (Request $request) {
    $controller = new UserController();
    $controller->delete($request);
});

// StoveController Routes
$router->get('/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->index($request);
});

$router->get('/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->show($request);
});

$router->put('/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->update($request);
});

$router->post('/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->create($request);
});

$router->delete('/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->delete($request);
});

// AddressController Routes
$router->get('/address', function (Request $request) {
    $controller = new AddressController();
    $controller->index($request);
});

$router->get('/address', function (Request $request) {
    $controller = new AddressController();
    $controller->show($request);
});

// CityController Routes
$router->get('/city', function (Request $request) {
    $controller = new CityController();
    $controller->index($request);
});

$router->get('/city', function (Request $request) {
    $controller = new CityController();
    $controller->show($request);
});


// AddressController Routes
$router->get('/state', function (Request $request) {
    $controller = new StateController();
    $controller->index($request);
});

$router->get('/state', function (Request $request) {
    $controller = new StateController();
    $controller->show($request);
});
