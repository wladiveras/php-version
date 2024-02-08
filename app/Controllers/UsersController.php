<?php

namespace App\Controllers;


use App\Models\User;
use App\Core\Request;
use App\Helpers\Response;


class UsersController
{

    public function index(Request $request)
    {
        $user = new User();
        $user->getName();

        return Response::json(['action' => 'index', 'request' => $request]);
    }
    public function show(Request $request)
    {
        $user = new User();
        $user->setId(1);
        $user->read(1);
        $user->getName();

        return Response::json(['action' => 'show', 'request' => $request]);
    }

    public function create(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $user->setName('John Doe');
        $user->setPassword('secret');
        $user->setBirthDate('1990-01-01');
        $user->create(1);

        return Response::json(['action' => 'store', 'request' => $request]);
    }

    public function update(Request $request)
    {
        $user = new User();
        $user->setName('Jane Doe');
        $user->setPassword('new_secret');
        $user->setBirthDate('1991-01-01');
        $user->update(1);

        return Response::json(['action' => 'update', 'request' => $request]);
    }

    public function delete(Request $request)
    {
        $user = new User();
        $user->setId(1);
        $user->delete(1);
        return Response::json(['action' => 'delete', 'request' => $request]);
    }
}
