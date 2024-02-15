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
    public function store(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'burners' => ['required', 'max' => 10],
            'lighters' => ['required', 'max' => 10],
            'oven' => ['required', 'max' => 10],
            'oven_lamp' => ['required', 'max' => 10],
            'lighters_colors' => ['required', 'max' => 100],
            'oven_lamp_color' => ['required', 'max' => 100],
            'oven_color' => ['required', 'max' => 100],
            'stove_color' => ['required', 'max' => 100],
            'stove_width' => ['required', 'max' => 100],
            'stove_heigh' => ['required', 'max' => 100],
            'stove_depth' => ['required', 'max' => 100],
            'glass_width' => ['required', 'max' => 100],
            'glass_heigth' => ['required', 'max' => 100],
            'glass_length' => ['required', 'max' => 100],
            'brand' => ['required', 'string', 'max' => 100],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {

            $stove = new Stove();

            $stove->setBurners($request->burners);
            $stove->setLighters($request->lighters);
            $stove->setLighersColors($request->lighters_colors);
            $stove->setOven($request->oven);
            $stove->setOvenLamp($request->oven_lamp);
            $stove->setOvenLampColor($request->oven_lamp_color);
            $stove->setOvenColor($request->oven_color);
            $stove->setStoveColor($request->stove_color);
            $stove->setStoveWidth($request->stove_width);
            $stove->setStoveHeight($request->stove_height);
            $stove->setStoveDepth($request->stove_depth);
            $stove->setGlassWidth($request->glass_width);
            $stove->setGlassHeight($request->glass_height);
            $stove->setGlassLeight($request->glass_leight);

            $action = $stove->create();

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "has a problem to create a stove."]),
                    code: 409
                );
            }

            return Response::json(
                data: Parse::result(result: $stove->getAll(), action: $action),
                code: 201
            );
        }
    }

    public function update(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'burners' => ['required', 'max' => 10],
            'lighters' => ['required', 'max' => 10],
            'oven' => ['required', 'max' => 10],
            'oven_lamp' => ['required', 'max' => 10],
            'lighters_colors' => ['required', 'max' => 100],
            'oven_lamp_color' => ['required', 'max' => 100],
            'oven_color' => ['required', 'max' => 100],
            'stove_color' => ['required', 'max' => 100],
            'stove_width' => ['required', 'max' => 100],
            'stove_heigh' => ['required', 'max' => 100],
            'stove_depth' => ['required', 'max' => 100],
            'glass_width' => ['required', 'max' => 100],
            'glass_heigth' => ['required', 'max' => 100],
            'glass_length' => ['required', 'max' => 100],
            'brand' => ['required', 'string', 'max' => 100],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {
            $stove = new Stove();

            $stove->setBurners($request->burners);
            $stove->setLighters($request->lighters);
            $stove->setLighersColors($request->lighters_colors);
            $stove->setOven($request->oven);
            $stove->setOvenLamp($request->oven_lamp);
            $stove->setOvenLampColor($request->oven_lamp_color);
            $stove->setOvenColor($request->oven_color);
            $stove->setStoveColor($request->stove_color);
            $stove->setStoveWidth($request->stove_width);
            $stove->setStoveHeight($request->stove_height);
            $stove->setStoveDepth($request->stove_depth);
            $stove->setGlassWidth($request->glass_width);
            $stove->setGlassHeight($request->glass_heigth);
            $stove->setGlassLeight($request->glass_leight);

            $action = $stove->update($request->id);

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "cannot update stove at this moment, try again later."]),
                    code: 400
                );
            }

            $stove->read($request->id);

            return Response::json(
                data: Parse::result(result: $stove->getAll(), action: $action),
                code: 200
            );
        }
    }

    public function destroy(Request $request)
    {
        $errors = Validator::validate($request->getBody(), [
            'id' => ['required', 'int'],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {
            $id = $request->getJson('id');

            $stove = new Stove();

            $action = $stove->read($id);

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "cannot find this stove, try a different id."]),
                    code: 404
                );
            }

            $action = $stove->delete($id);

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "cannot delete this stove at this moment, try again later."]),
                    code: 400
                );
            }

            return Response::json(
                data: Parse::result(result: $id, action: $action),
                code: 200
            );
        }
    }
}
