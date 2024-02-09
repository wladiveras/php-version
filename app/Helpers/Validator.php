<?php

namespace App\Helpers;

class Validator
{
    public static function validate($data, $rules)
    {
        $data = json_encode($data, true);
        $errors = [];

        foreach ($rules as $field => $ruleset) {
            $value = $data[$field] ?? '';
            foreach ($ruleset as $rule) {
                switch ($rule) {
                    case 'required':
                        if (empty($value)) {
                            $errors[$field][] = "The $field field is required.";
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = "The $field field must be a valid email.";
                        }
                        break;
                }
            }
        }

        return $errors;
    }
}
