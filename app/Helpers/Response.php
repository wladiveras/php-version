<?php

namespace App\Helpers;

class Response
{
    static public function json($data)
    {
        header("Content-Type: application/json");

        $response = json_encode($data, JSON_PRETTY_PRINT) ?? json_encode(["jsonError" => json_last_error_msg()]);

        if ($response === false) {
            $response = '{"jsonError":"unknown"}';
        }

        http_response_code(($response === false) ? 500 : 200);

        echo $response;
    }
}
