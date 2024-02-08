<?php

namespace App\Helpers;

class Parse
{
    static public function result($success, $result, $message = 'Something went wrong'): array
    {
        return [
            'sucess' => $success,
            'message' => $success ?  '' : $message,
            'data' => $success ? $result : []
        ];
    }
}
