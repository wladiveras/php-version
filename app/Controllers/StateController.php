<?php

namespace App\Controllers;


use App\Core\Request;
use App\Models\State;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Helpers\Parse;
use DateTime;

class StateController
{

    public function index(Request $request)
    {
        $request = $request->getQuery();

        $state = new State();
        $states = $state->readAll();

        if (!$states) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find any data."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $states, action: 200),
            code: 200
        );
    }

    public function show(Request $request)
    {
        $request = $request->getQuery();

        $state = new State();
        $action = $state->read($request->id);

        if (!$action) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find this state, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $state->getAll(), action: $action),
            code: 200
        );
    }
}
