<?php

namespace App\Models;

use App\Core\Database;

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
        $this->database = Database::connect();
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
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }

    // Query Operation
    public function create(int $id)
    {
        $query = "INSERT INTO users (name, password, birth_date) VALUES (:name, :password, :birth_date)";
        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':birth_date', $this->birth_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read(int $id): bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->database->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $this->id = $row['id'];
            $this->address_id = $row['address_id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            $this->birth_date = $row['birth_date'];
            return true;
        } else {
            return false;
        }
    }

    public function update(int $id)
    {
        $query = "UPDATE users SET name = :name, password = :password, birth_date = :birth_date WHERE id = :id";
        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':birth_date', $this->birth_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
