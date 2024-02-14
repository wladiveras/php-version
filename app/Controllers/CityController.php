<?php

namespace App\Controllers;


use App\Core\Request;
use App\Models\City;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Helpers\Parse;
use DateTime;

class CityController
{

    public function index(Request $request)
    {
        $request = $request->getQuery();

        $city = new City();
        $cities = $city->readAll();

        if (!$cities) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find any data."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $cities, action: 200),
            code: 200
        );
    }

    public function show(Request $request)
    {
        $request = $request->getQuery();

        $city = new City();
        $action = $city->read($request->id);

        if (!$action) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find this city, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $city->getAll(), action: $action),
            code: 200
        );
    }
}
