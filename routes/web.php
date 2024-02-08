<?php

use App\Core\Router;
use App\Core\Request;
use App\Controllers\UsersController;


$router = new Router(new Request);


// UserController Routes
$router->get('/user', function (Request $request) {
    $controller = new UsersController();
    $controller->show($request);
});

$router->put('/user', function (Request $request) {
    $controller = new UsersController();
    $controller->update($request);
});

$router->post('/user', function (Request $request) {
    $controller = new UsersController();
    $controller->create($request);
});

$router->delete('/user', function (Request $request) {
    $controller = new UsersController();
    $controller->delete($request);
});
