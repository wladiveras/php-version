<?php

namespace App\Controllers;


use App\Models\User;
use App\Core\Request;
use App\Helpers\Response;


class UsersController
{

    public function index(Request $request)
    {

        return Response::json(['action' => 'index', 'request' => $request]);
    }
    public function show(Request $request, int $id)
    {
        return Response::json(['action' => 'show', 'id' => $id, 'request' => $request]);
    }

    public function create(Request $request)
    {
        $request = $request->getJson();

        return Response::json(['action' => 'store', 'request' => $request]);
    }

    public function update(Request $request)
    {
        return Response::json(['action' => 'update', 'request' => $request]);
    }

    public function delete(int $id)
    {
        return Response::json(['action' => 'delete', 'id' => $id]);
    }
}
