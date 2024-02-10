<?php

namespace App\Helpers;

use DateTime;

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
                    case 'string':
                        $pattern = '/^[a-zA-Z0-9 ]+$/';
                        if (!preg_match($pattern, $value)) {
                            $errors[$field][] = "$field must be a valid string.";
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = "$field must be a valid email address.";
                        }
                        break;
                    case 'int':
                        if (!is_int($value)) {
                            $errors[$field][] = "$field must be an integer.";
                        }
                        break;
                    case 'password_match':
                        if (!empty($value) && $value !== $request->password) {
                            $errors[$field][] = "Passwords do not match.";
                        }
                        break;
                    case 'min':
                        if (strlen($value) < $rule) {
                            $errors[$field][] = "$field must be at least $rule characters long.";
                        }
                        break;
                    case 'max':
                        if (strlen($value) > $rule) {
                            $errors[$field][] = "$field must be no more than $rule characters long.";
                        }
                        break;
                    case 'birth_date':
                        $dateFormat = 'Y-m-d';
                        $minBirthDate = new DateTime('1900-01-01');
                        $maxBirthDate = new DateTime();
                        $maxBirthDate->setTime(0, 0, 0);
                        if (!DateTime::createFromFormat($dateFormat, $value)) {
                            $errors[$field][] = "$field must be a valid date format (yyyy-mm-dd).";
                        } elseif ($value < $minBirthDate->format($dateFormat)) {
                            $errors[$field][] = "$field must be on or after 01/01/1900.";
                        } elseif ($value > $maxBirthDate->format($dateFormat)) {
                            $errors[$field][] = "$field must be on or before today.";
                        }
                        break;
                }
            }
        }

        return $errors;
    }
}
