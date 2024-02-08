<?php

namespace App\Core;

class Database
{
    private static $dsn = 'mysql:host=localhost;dbname=fire';
    private static $username = 'root';
    private static $password = 'secret';
    private static $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private static $conn;

    public static function connect()
    {
        if (!isset(self::$conn)) {
            self::$conn = new \PDO(self::$dsn, self::$username, self::$password, self::$options);

            if (self::$conn->errorCode() != 0) {
                die('Connection failed: ' . self::$conn->errorInfo());
            }
        }

        return self::$conn;
    }
}
