<?php

namespace App\Helpers;

class Validator
{
    static public function validate($request, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $ruleSet) {
            $value = $request->{$field};

            foreach ($ruleSet as $rule) {
                switch ($rule) {
                    case 'required':
                        if (empty($value)) {
                            $errors[$field][] = "$field is required.";
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = "$field must be a valid email address.";
                        }
                        break;
                        // Add more validation rules here
                }
            }
        }

        return $errors;
    }
}
