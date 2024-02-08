<?php

namespace App\Config;

class Setup
{
    public $database_host = 'localhost';
    public $database_name = 'fire';
    public $database_username = 'root';
    public $database_password = 'Wladi@121';


    public function getDatabaseHost(): string
    {
        return $this->database_host;
    }
    public function getDatabaseName(): string
    {
        return $this->database_name;
    }
    public function getDatabaseUsername(): string
    {
        return $this->database_username;
    }
    public function getDatabasePassword(): string
    {
        return $this->database_password;
    }
}
