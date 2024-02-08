<?php

namespace App\Models;

use App\Core\Database;

class City
{
    private $database;
    private $state;
    protected $id;
    protected $state_id;
    protected $name;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->state = new State();
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

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "state_id" => $this->getStateId(),
            "name" => $this->getName(),
            "state" => $this->getState(),
        ];
    }

    // Relationship
    public function getState(): State | array
    {
        $this->state->read($this->getStateId());
        $this->setState($this->state->getAll());

        return $this->state;
    }

    public function setState($state): void
    {
        $this->state = $state;
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $query = $this->database->prepare("INSERT INTO cities ( name, state_id) VALUES (:name, :state_id)");
            $query->bindParam(':name', $this->name);
            $query->bindParam(':state_id', $this->state_id);

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

    public function read(int $id, $state_id = false): bool
    {
        try {
            if ($state_id) {
                $query = $this->database->prepare("SELECT * FROM cities WHERE state_id = :id");
            } else {
                $query = $this->database->prepare("SELECT * FROM cities WHERE id = :id");
            }

            $query->execute([':id' => $id]);

            $citie = $query->fetch();

            if ($citie) {
                $this->setId($citie['id']);
                $this->setName($citie['name']);
                $this->setStateId($citie['state_id']);
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
            $query = $this->database->prepare("UPDATE cities SET name = :name, state_id = :state_id WHERE id = :id");

            $query->bindParam(':id', $id, \PDO::PARAM_INT);
            $query->bindParam(':name', $this->name);
            $query->bindParam(':state_id', $this->state_id);

            if ($query->execute()) {
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
            $query = $this->database->prepare("DELETE FROM cities WHERE id = :id");

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
