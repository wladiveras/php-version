<?php

namespace App\Controllers;


use App\Models\User;
use App\Core\Request;
use App\Helpers\Response;
use App\Helpers\Parse;


class UsersController
{

    public function index(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $success = $user->read($request['id']);

        return Response::json(Parse::result($success, $user->getId()));
    }
    public function show(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $success = $user->read($request['id']);

        return Response::json(Parse::result($success, $user->getAll()));
    }

    public function create(Request $request)
    {

        $request = $request->getJson();

        $user = new User();

        $user->setName($request['name']);
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);
        $user->setBirthDate($request['birth_date']);

        $success = $user->create();

        return Response::json(Parse::result($success, $user->getId()));
    }

    public function update(Request $request)
    {
        $request = $request->getJson();

        $user = new User();

        $user->setName($request['name']);
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);
        $user->setBirthDate($request['birth_date']);

        $success = $user->update($request['id']);

        return Response::json(Parse::result($success, $user->getAll()));
    }

    public function delete(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $success = $user->delete($request['id']);

        return Response::json(Parse::result($success, $request['id']));
    }
}
