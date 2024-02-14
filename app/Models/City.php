<?php

namespace App\Models;

use App\Core\Database;
use DateTime;

class City
{
    private $database;
    private $state;
    protected $id;
    protected $state_code;
    protected $name;
    protected $is_capital;
    protected $created_at;
    protected $updated_at;


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
    public function getId(): int
    {
        return $this->id;
    }
    public function getStateCode(): string
    {
        return $this->state_code;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getIsCapital(): string
    {
        return $this->is_capital;
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

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setStateCode($state_code): void
    {
        $this->state_code = $state_code;
    }
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setIsCapital($is_capital): void
    {
        $this->is_capital = $is_capital;
    }

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "state" => $this->getState(),
            "is_capital" => $this->getIsCapital(),
        ];
    }

    // Relationship
    public function getState(): State | array
    {
        $this->state->read($this->getStateCode());
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
            $now = new DateTime();

            $query = $this->database->prepare("INSERT INTO cities (name, state_code, is_capital, created_at, updated_at) VALUES (:name, :state_code, :is_capital, :created_at, :updated_at)");

            $this->setCreatedAt($now->format('Y-m-d H:i:s'));
            $this->setUpdatedAt($now->format('Y-m-d H:i:s'));

            $query->bindParam(':name', $this->name);
            $query->bindParam(':state_code', $this->state_code);
            $query->bindParam(':is_capital', $this->is_capital);

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
            $query = $this->database->prepare('SELECT * FROM cities WHERE id = :id');
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
            $query = $this->database->query('SELECT * FROM cities');

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
        $this->setIsCapital($data['is_capital']);
        $this->setStateCode($data['state_id']);
        $this->setCreatedAt($data['create_at']);
        $this->setUpdatedAt($data['updated_at']);

        return $data;
    }

    public function update(int $id): bool
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("UPDATE states SET name = COALESCE(:name, name), state_code = COALESCE(:state_code, state_code), is_capital = COALESCE(:is_capital, is_capital),  updated_at = :updated_at  WHERE id = :id");

            $data = [
                ':id' => $id,

                ':name' => isset($this->name) ? $this->name : null,
                ':state_code' => isset($this->state_code) ? $this->state_code : null,
                ':is_capital' => isset($this->is_capital) ? $this->is_capital : null,

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
