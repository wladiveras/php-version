<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $database;
    protected $id;
    protected $name;
    protected $email;
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

    public function getEmail()
    {
        return $this->email;
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

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getName(),
            "birth_date" => $this->getBirthDate(),
        ];
    }

    // Query Operation
    public function create()
    {
        try {
            $query = $this->database->prepare("INSERT INTO users (name, email, password, birth_date) VALUES (:name, :email, :password, :birth_date)");

            $query->bindParam(':name', $this->name);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':password', $this->password);
            $query->bindParam(':birth_date', $this->birth_date);

            if ($query->execute()) {
                $this->setId($this->database->lastInsertId());
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function read(int $id): bool
    {
        try {
            $query = $this->database->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute([':id' => $id]);

            $user = $query->fetch();

            if ($user) {
                $this->setId($user['id']);
                $this->setName($user['name']);
                $this->setEmail($user['email']);
                $this->setPassword($user['password']);
                $this->setBirthDate($user['birth_date']);

                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update(int $id)
    {
        try {
            $query = $this->database->prepare("UPDATE users SET name = :name, email = :email, password = :password, birth_date = :birth_date WHERE id = :id");
            $query->bindParam(':name', $this->name);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':password', $this->password);
            $query->bindParam(':birth_date', $this->birth_date);

            if ($query->execute([':id' => $id])) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete(int $id)
    {
        try {
            $query = $this->database->prepare("DELETE FROM users WHERE id = :id");

            if ($query->execute([':id' => $id])) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
}
