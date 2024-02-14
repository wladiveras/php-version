<?php

namespace App\Controllers;


use App\Core\Request;
use App\Models\Stove;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Helpers\Parse;
use DateTime;

class StoveController
{

    public function index(Request $request)
    {
        $request = $request->getQuery();

        $stove = new Stove();
        $stoves = $stove->readAll();

        if (!$stoves) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find any data."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $stoves, action: 200),
            code: 200
        );
    }

    public function show(Request $request)
    {
        $request = $request->getQuery();

        $stove = new Stove();
        $action = $stove->read($request->id);

        if (!$action) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find this state, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $stove->getAll(), action: $action),
            code: 200
        );
    }
    public function create(Request $request)
    {
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
