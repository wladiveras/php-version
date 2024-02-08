<?php

use App\Core\Router;
use App\Core\Request;
use App\Controllers\UsersController;


$router = new Router(new Request);


$router->get('/', function () {
    return 'Hello Worldinelson';
});

$router->put('/', function () {
    return 'Hello put';
});

$router->delete('/', function () {
    return 'Hello deletre';
});



$router->post('/', function (Request $request) {

    $controller = new UsersController();
    $controller->update($request);
});
