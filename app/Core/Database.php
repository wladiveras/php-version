<?php

namespace App\Core;

use App\Config\Setup;

class Database
{

    private static $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private static $conn;

    public static function connect()
    {
        if (!isset(self::$conn)) {

            $setup = new Setup();

            self::$conn = new \PDO('mysql:host=' . $setup->getDatabaseHost() . ';dbname=' . $setup->getDatabaseName(), $setup->getDatabaseUsername(), $setup->getDatabasePassword(), self::$options);

            if (self::$conn->errorCode() != 0) {
                die('Connection failed: ' . self::$conn->errorInfo());
            }
        }

        return self::$conn;
    }
}
