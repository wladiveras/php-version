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

    // Query Operation
    public function create(): bool
    {

        $query = $this->database->prepare(
            "INSERT INTO states ( name, code) VALUES (:name, :code)"
        );

        $query->bindParam(':name', $this->name);
        $query->bindParam(':code', $this->code);

        if ($query->execute()) {
            $this->setId($this->database->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    public function read(int $id): bool
    {
        $query = $this->database->prepare("SELECT * FROM states WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();

        $state = $query->fetch();

        if (!is_null($state)) {
            $this->setId($state['id']);
            $this->setName($state['user_id']);
            $this->setCode($state['number']);
            return true;
        } else {
            return false;
        }
    }

    public function update(int $id): bool
    {
        $query = $this->database->prepare("UPDATE states SET name = :name, code = :code WHERE id = :id");

        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':code', $this->code);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $query = $this->database->prepare("DELETE FROM states WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
