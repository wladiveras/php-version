<?php

namespace App\Models;

use App\Config\Database;

class User
{
    private $database;
    protected $id;
    protected $address_id;
    protected $name;
    protected $password;
    protected $birth_date;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function __destruct()
    {
        $this->database->close();
    }

    // GET METHODS
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }


    public function getBirthDate()
    {
        return $this->birth_date;
    }


    // SET METHODS
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }



    // CRUD OPERATIONS
    public function create(array $data)
    {
    }

    public function read(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->database->query($sql);
        return $result->fetch_assoc();
    }

    public function update(int $id, array $data)
    {
    }

    public function delete(int $id)
    {
    }
}
