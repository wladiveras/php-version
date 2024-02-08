<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $database;
    protected $id;
    protected $name;
    protected $password;
    protected $birth_date;

    public function __construct()
    {
        $this->database = Database::connect();
    }

    public function __destruct()
    {
        $this->database = null;
    }

    // Getters
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


    // Setters
    public function setId(string $id)
    {
        $this->id = $id;
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
    public function create()
    {
        $query = $this->database->prepare("INSERT INTO users (name, password, birth_date) VALUES (:name, :password, :birth_date)");

        $query->bindParam(':name', $this->name);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':birth_date', $this->birth_date);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read(int $id): bool
    {
        $query = $this->database->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([':id' => $id]);
        $user = $query->fetch();

        if (!is_null($user)) {

            $this->setId($user['id']);
            $this->setName($user['name']);
            $this->setPassword($user['password']);
            $this->setBirthDate($user['birth_date']);

            return true;
        } else {
            return false;
        }
    }

    public function update(int $id)
    {
        $query = $this->database->prepare("UPDATE users SET name = :name, password = :password, birth_date = :birth_date WHERE id = :id");

        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':birth_date', $this->birth_date);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id)
    {
        $query = $this->database->prepare("DELETE FROM users WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
