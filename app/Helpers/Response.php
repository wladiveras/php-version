<?php

namespace App\Helpers;

class Response
{
    static public function json(mixed $data, int $code = 200)
    {
        header("Content-Type: application/json");

        $response = json_encode($data, JSON_PRETTY_PRINT) ?? json_encode(["jsonError" => json_last_error_msg()]);

        if ($response === false) {
            $response = '{"jsonError":"unknown"}';
        }

        $responseCode = $response === false ? 500 : $code;

        if ($responseCode) {
            http_response_code($responseCode);
        }

        echo $response;
    }
}
