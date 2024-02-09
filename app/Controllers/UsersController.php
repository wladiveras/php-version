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
        $request = $request->getQueryParameters();

        $user = new User();
        $action = $user->read($request->id);

        if (!$action) {
            return Response::json(
                Parse::result(action: $action, errors: ["message" => "cannot find this user, try a different id."]),
                code: 404
            );
        }

        return Response::json(
            Parse::result(result: $user->getAll(), action: $action),
        );
    }

    public function create(Request $request)
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
            return Response::json(Parse::result(errors: $errors));
        } else {
            $user = new User();

            $user->setName($request->name);
            $user->setEmail($request->email);
            $user->setPassword($request->password);
            $user->setBirthDate($request->birth_date);

            $action = $user->create();
            $ErrorMessage = ["create" => "cannot create a user account at this moment, try again later."];

            return Response::json(Parse::result($action, $user->getId(), $ErrorMessage));
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
            return Response::json(Parse::result(errors: $errors));
        } else {
            $user = new User();

            $user->setName($request->name);
            $user->setEmail($request->email);
            $user->setPassword($request->password);
            $user->setBirthDate($request->birth_date);

            $action = $user->update($request->id);
            $ErrorMessage = ["create" => "cannot create a user account at this moment, try again later."];

            return Response::json(Parse::result($user->getAll(), $action, $ErrorMessage));
        }
    }

    public function delete(Request $request)
    {
        $request = $request->getBody();

        $errors = Validator::validate($request, [
            'id' => ['required'],
        ]);

        if (!empty($errors)) {
            return Response::json(Parse::result(errors: $errors));
        } else {
            $id = $request->getJson('id');
            $ErrorMessage = "Connot update user at this moment, try again later.";

            if ($id) {
                $user = new User();
                $action = $user->delete($id);
            }

            return Response::json(Parse::result($id, $action, $ErrorMessage));
        }
    }
}
