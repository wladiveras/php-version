<?php

namespace App\Config;


class Database
{
    private static $host = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $database = 'xxxx';
    private static $conn;

    public static function connect()
    {
        if (!isset(self::$conn)) {
            self::$conn = new \mysqli(self::$host, self::$username, self::$password, self::$database);

            if (self::$conn->connect_error) {
                die('Connection failed: ' . self::$conn->connect_error);
            }
        }

        return self::$conn;
    }
}
