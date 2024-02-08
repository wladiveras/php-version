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
        $this->database =  Database::connect();
    }

    public function __destruct()
    {
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getAdressid()
    {
        return $this->address_id;
    }
    public function getName()
    {
        return $this->name;
    }


    public function getBirthDate()
    {
        return $this->birth_date;
    }


    // Setters
    public function setId(string $id)
    {
        $this->id = $id;
    }
    public function setAdressid(string $address_id)
    {
        $this->address_id = $address_id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }

    // Query Operation
    public function create()
    {
        $query = "INSERT INTO users (name, password, birth_date) VALUES (?, ?, ?)";
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bind_param("sss", $this->name, $this->password, $this->birth_date);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->address_id = $row['address_id'];
                $this->name = $row['name'];
                $this->password = $row['password'];
                $this->birth_date = $row['birth_date'];
            }
        } else {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE users SET name = ?, password = ?, birth_date = ? WHERE id = ?";
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bind_param("sssi", $this->name, $this->password, $this->birth_date, $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bind_param("i", $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
