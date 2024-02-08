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
    public function show(Request $request, int $id)
    {
        $user = new User();
        $user->setId($id);
        $user->read();
        $user->getName();

        return Response::json(['action' => 'show', 'id' => $id, 'request' => $request]);
    }

    public function create(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $user->setName('John Doe');
        $user->setPassword('secret');
        $user->setBirthDate('1990-01-01');
        $user->create();

        return Response::json(['action' => 'store', 'request' => $request]);
    }

    public function update(Request $request)
    {
        $user = new User();
        $user->setName('Jane Doe');
        $user->setPassword('new_secret');
        $user->setBirthDate('1991-01-01');
        $user->update();

        return Response::json(['action' => 'update', 'request' => $request]);
    }

    public function delete(int $id)
    {
        $user = new User();
        $user->setId(1);
        $user->delete();
        return Response::json(['action' => 'delete', 'id' => $id]);
    }
}
