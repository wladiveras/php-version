<?php

namespace App\Helpers;

class Parse
{
    static public function result(mixed $result = [], bool $action = false, array $errors = ['generic' => 'something went wrong']): array
    {

        $response = [
            'success' => $action,
            'errors' => $action ?  [] : $errors,
            'data' => $action ? $result : [],
        ];

        return $response;
    }
}
