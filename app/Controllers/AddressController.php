<?php

namespace App\Controllers;


use App\Core\Request;
use App\Models\Address;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Helpers\Parse;
use DateTime;

class AddressController
{

    public function index(Request $request)
    {
        $request = $request->getQuery();

        $address = new Address();
        $addresses = $address->readAll();

        if (!$addresses) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find any data."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $addresses, action: 200),
            code: 200
        );
    }

    public function show(Request $request)
    {
        $request = $request->getQuery();

        $address = new Address();
        $action = $address->read($request->id);

        if (!$action) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find this address, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $address->getAll(), action: $action),
            code: 200
        );
    }
}
