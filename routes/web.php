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
$router->get('/api/user/all', function (Request $request) {
    $controller = new UserController();
    $controller->index($request);
});

$router->get('/api/user', function (Request $request) {
    $controller = new UserController();
    $controller->show($request);
});

$router->put('/api/user', function (Request $request) {
    $controller = new UserController();
    $controller->update($request);
});

$router->post('/api/user', function (Request $request) {
    $controller = new UserController();
    $controller->store($request);
});

$router->delete('/api/user', function (Request $request) {
    $controller = new UserController();
    $controller->destroy($request);
});

// StoveController Routes
$router->get('/api/stove/all', function (Request $request) {
    $controller = new StoveController();
    $controller->index($request);
});

$router->get('/api/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->show($request);
});

$router->put('/api/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->update($request);
});

$router->post('/api/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->store($request);
});

$router->delete('/api/stove', function (Request $request) {
    $controller = new StoveController();
    $controller->destroy($request);
});

// AddressController Routes
$router->get('/api/address/all', function (Request $request) {
    $controller = new AddressController();
    $controller->index($request);
});

$router->get('/api/address', function (Request $request) {
    $controller = new AddressController();
    $controller->show($request);
});

$router->put('/api/address', function (Request $request) {
    $controller = new AddressController();
    $controller->update($request);
});

// CityController Routes
$router->get('/api/city/all', function (Request $request) {
    $controller = new CityController();
    $controller->index($request);
});

$router->get('/api/city', function (Request $request) {
    $controller = new CityController();
    $controller->show($request);
});


// AddressController Routes
$router->get('/api/state/all', function (Request $request) {
    $controller = new StateController();
    $controller->index($request);
});

$router->get('/api/state', function (Request $request) {
    $controller = new StateController();
    $controller->show($request);
});
