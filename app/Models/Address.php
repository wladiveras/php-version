<?php

namespace App\Models;

use App\Config\Database;

class Address
{
    private $database;
    protected $id;
    protected $user_id;
    protected $number;
    protected $street;
    protected $region;
    protected $neighbourhood;
    protected $country;
    protected $country_code;
    protected $postal_code;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function __destruct()
    {
        $this->database->close();
    }
}
