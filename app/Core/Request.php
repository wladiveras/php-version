<?php

namespace App\Core;



class Request
{
    public $requestMethod;
    function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }



    public function getBody($associative = true, $depth = 512, $options = 0)
    {
        $json = file_get_contents('php://input');

        if ($json === false) {
            return null;
        }

        return (object) json_decode($json, $associative, $depth, $options);
    }

    function getQuery()
    {
        $queryString = $_SERVER['QUERY_STRING'] ?? '';
        $queryParameters = [];

        parse_str($queryString, $queryParameters);

        return (object) $queryParameters;
    }

    public function getString($name, $default = null)
    {
        if (isset($_GET[$name])) {
            return filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $default;
    }

    public function getJson($name, $default = null, $associative = true, $depth = 512, $options = 0)
    {
        $json = file_get_contents('php://input');

        if ($json === false) {
            return null;
        }

        $data = json_decode($json, $associative, $depth, JSON_THROW_ON_ERROR | $options);

        return $this->extractProperty($data, explode('.', $name)) ?? $default;
    }

    private function extractProperty($data, $keys)
    {
        if (empty($keys)) {
            return $data;
        }

        $key = array_shift($keys);

        if (is_array($data) && array_key_exists($key, $data)) {
            return $this->extractProperty($data[$key], $keys);
        }

        if (is_object($data) && property_exists($data, $key)) {
            return $this->extractProperty($data->$key, $keys);
        }

        return null;
    }
}
