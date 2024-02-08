<?php

namespace App\Models;

use App\Core\Database;

class State
{
    private $database;
    protected $id;
    protected $name;
    protected $code;

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

    public function getCode()
    {
        return $this->code;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "code" => $this->getCode(),
        ];
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $query = $this->database->prepare("INSERT INTO states ( name, code) VALUES (:name, :code)");
            $query->bindParam(':name', $this->name);
            $query->bindParam(':code', $this->code);

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

    public function read($id): bool
    {
        try {
            $query = $this->database->prepare("SELECT * FROM states WHERE id = :id");
            $query->execute([':id' => $id]);

            $state = $query->fetch();

            if ($state) {
                $this->setId($state['id']);
                $this->setName($state['name']);
                $this->setCode($state['code']);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update(int $id): bool
    {
        try {
            $query = $this->database->prepare("UPDATE states SET name = :name, code = :code WHERE id = :id");
            $query->bindParam(':name', $this->name);
            $query->bindParam(':code', $this->code);

            if ($query->execute([':id' => $id])) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $query = $this->database->prepare("DELETE FROM states WHERE id = :id");

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
