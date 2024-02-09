<?php

namespace App\Controllers;


use App\Core\Request;
use App\Models\User;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Helpers\Parse;


class UsersController
{

    public function show(Request $request)
    {
        $request = $request->getQuery();

        $user = new User();
        $action = $user->read($request->id);

        if (!$action) {
            return Response::json(
                data: Parse::result(errors: ["message" => "cannot find this user, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            data: Parse::result(result: $user->getAll(), action: $action),
            code: 200
        );
    }

    public function create(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'birth_date' => ['required'],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {
            $user = new User();

            $user->setName($request->name);
            $user->setEmail($request->email);
            $user->setPassword($request->password);
            $user->setBirthDate($request->birth_date);

            $action = $user->create();

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "A user already exist with this email."]),
                    code: 409
                );
            }

            return Response::json(
                data: Parse::result(result: $user->getAll(), action: $action),
                code: 201
            );
        }
    }

    public function update(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'birth_date' => ['required'],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {
            $user = new User();

            $user->setName($request->name);
            $user->setEmail($request->email);
            $user->setPassword($request->password);
            $user->setBirthDate($request->birth_date);

            $action = $user->update($request->id);

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "cannot update user account at this moment, try again later."]),
                    code: 400
                );
            }

            return Response::json(
                data: Parse::result(result: $user->getAll(), action: $action),
                code: 200
            );
        }
    }

    public function delete(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'id' => ['required'],
        ]);

        if (!empty($errors)) {
            return Response::json(
                data: Parse::result(errors: $errors),
                code: 400
            );
        } else {
            $id = $request->getJson('id');

            $user = new User();
            $action = $user->delete($id);

            if (!$action) {
                return Response::json(
                    data: Parse::result(errors: ["message" => "cannot delete this user account at this moment, try again later."]),
                    code: 400
                );
            }

            return Response::json(
                data: Parse::result(result: ['user_id' => $id], action: $action),
                code: 200
            );
        }
    }
}
