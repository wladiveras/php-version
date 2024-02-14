<?php

namespace App\Models;

use App\Core\Database;
use DateTime;

class State
{
    private $database;
    protected $id;
    protected $name;
    protected $code;
    protected $created_at;
    protected $updated_at;

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
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    // Setters
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

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
            $now = new DateTime();

            $query = $this->database->prepare("INSERT INTO states ( name, code, created_at, updated_at) VALUES (:name, :code, :created_at, :updated_at)");

            $this->setCreatedAt($now->format('Y-m-d H:i:s'));
            $this->setUpdatedAt($now->format('Y-m-d H:i:s'));

            $query->bindParam(':name', $this->name);
            $query->bindParam(':code', $this->code);

            if ($query->execute([':created_at' => $this->created_at, ':updated_at' => $this->updated_at])) {
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
            $query = $this->database->prepare('SELECT * FROM states WHERE id = :id');
            $query->execute([':id' => $id]);

            $data = $query->fetch();

            if ($data) {
                $this->createObject($data);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function readAll(): array
    {
        try {
            $query = $this->database->query('SELECT * FROM states');

            $query = $query->fetchAll();

            $response = [];
            foreach ($query as $data) {
                $response[] = $this->createObject($data);
            }

            return $response;
        } catch (\PDOException $e) {
            throw new \Exception("Failed to get all public data: " . $e->getMessage());
        }
    }

    private function createObject(array $data): array
    {

        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setCode($data['code']);
        $this->setCreatedAt($data['created_at']);
        $this->setUpdatedAt($data['updated_at']);

        return $data;
    }

    public function update(int $id): bool
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("UPDATE states SET name = COALESCE(:name, name), code = COALESCE(:code, code),  updated_at = :updated_at  WHERE id = :id");

            $data = [
                ':id' => $id,

                ':name' => isset($this->name) ? $this->name : null,
                ':code' => isset($this->code) ? $this->code : null,

                ':updated_at' => $now->format('Y-m-d H:i:s'),
            ];

            if ($query->execute($data)) {
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
