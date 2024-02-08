<?php

namespace App\Controllers;


use App\Models\User;
use App\Core\Request;
use App\Helpers\Response;


class UsersController
{

    public function index(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $user->getName();

        return Response::json(['status' => 'index', 'request' => $request]);
    }
    public function show(Request $request)
    {
        $request = $request->getJson();

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
        $user->setName($request['name']);
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);
        $user->setBirthDate($request['birth_date']);

        $create = $user->create();

        return Response::json(['sucess' => $create, 'user_id' => $user->getId()]);
    }

    public function update(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $user->setName('Jane Doe');
        $user->setEmail('wladi@wladi.com');
        $user->setPassword('new_secret');
        $user->setBirthDate('1991-01-01');
        $user->update(1);

        return Response::json(['action' => 'update', 'request' => $request]);
    }

    public function delete(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $user->setId(1);
        $user->delete(1);
        return Response::json(['action' => 'delete', 'request' => $request]);
    }
}
