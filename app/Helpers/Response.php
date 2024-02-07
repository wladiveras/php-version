<?php

namespace App\Helpers;

class Response
{
    static public function json($data)
    {
        $response = [];

        if (is_array($data) && !empty($data)) {
            $response = json_encode($data);
        }

        return $response;
    }
}
