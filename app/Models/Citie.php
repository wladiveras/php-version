<?php

namespace App\Models;

use App\Core\Database;

class Citie
{
    private $database;
    protected $id;
    protected $state_id;
    protected $name;

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
    public function getStateId()
    {
        return $this->state_id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStateId($state_id)
    {
        $this->state_id = $state_id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }


    // Query Operation
    public function create(): bool
    {

        $query = $this->database->prepare("INSERT INTO cities ( name, state_id) VALUES (:name, :state_id)");

        $query->bindParam(':name', $this->name);
        $query->bindParam(':state_id', $this->state_id);

        if ($query->execute()) {
            $this->setId($this->database->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    public function read(int $id): bool
    {
        $query = $this->database->prepare("SELECT * FROM cities WHERE id = :id");

        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();

        $citie = $query->fetch();

        if (!is_null($citie)) {
            $this->setId($citie['id']);
            $this->setName($citie['name']);
            $this->setStateId($citie['state_id']);
            return true;
        } else {
            return false;
        }
    }

    public function update(int $id): bool
    {
        $query = $this->database->prepare("UPDATE cities SET name = :name, state_id = :state_id WHERE id = :id");

        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':state_id', $this->state_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $query = $this->database->prepare("DELETE FROM cities WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
