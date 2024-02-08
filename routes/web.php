<?php

use App\Core\Router;
use App\Core\Request;
use App\Controllers\UsersController;


$router = new Router(new Request);


$router->get('/', function () {
    return 'Hello Worldinelson';
});

$router->post('/some/route', function ($id, Request $request) {

    //$body = $request->getBody();

    $controller = new UsersController();
    return $controller->update($request, $id);
});
