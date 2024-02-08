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
        $read = $user->read($request['id']);

        return Response::json([
            'sucess' => $read,
            'message' => $read ? null : 'something went wrong',
            'data' => $user->getId()
        ]);
    }
    public function show(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $read = $user->read($request['id']);

        return Response::json([
            'sucess' => $read,
            'message' => $read ? null : 'something went wrong',
            'data' => $user->getAll()
        ]);
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

        return Response::json([
            'sucess' => $create,
            'message' => $create ? null : 'something went wrong',
            'data' => $user->getId()
        ]);
    }

    public function update(Request $request)
    {
        $request = $request->getJson();

        $user = new User();

        $user->setName('Jane Doe');
        $user->setEmail('wladi@wladi.com');
        $user->setPassword('new_secret');
        $user->setBirthDate('1991-01-01');

        $update = $user->update($request['id']);

        return Response::json([
            'sucess' => $update,
            'message' => $update ? null : 'something went wrong',
            'data' => $request['id']
        ]);
    }

    public function delete(Request $request)
    {
        $request = $request->getJson();

        $user = new User();
        $delete = $user->delete($request['id']);

        return Response::json([
            'sucess' => $delete,
            'message' => $delete ? null : 'something went wrong',
            'data' => $request['id']
        ]);
    }
}
