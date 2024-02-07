<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;
use App\Models\User;
use App\Helpers\Response;

class UsersController
{

    public function index(int $id, RouteCollection $routes)
    {
        return Response::json([]);
    }
    public function show(int $id, RouteCollection $routes)
    {

        $user = [
            "id" => 1,
            "name" => 'wladi',
        ];

        return Response::json($user);
    }

    public function store(int $id, RouteCollection $routes)
    {
        return Response::json([]);
    }

    public function update(int $id, RouteCollection $routes)
    {
        return Response::json([]);
    }

    public function delete(int $id, RouteCollection $routes)
    {
        return Response::json([]);
    }
}
