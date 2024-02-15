<?php

namespace App\Models;

use App\Core\Database;
use App\Models\Address;
use DateTime;

class User
{
    private $database;
    private $address;
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $remember_token;
    protected $email_verified_at;
    protected $created_at;
    protected $updated_at;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->address = new Address();
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
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

    private function setId(int $id)
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

    public function setEmailVerifiedAt(string $email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getRememberToken(): string
    {
        return $this->remember_token;
    }



    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "email_verified" => $this->getEmailVerifiedAt() ? true : false,
            "address" => $this->getAddress()
        ];
    }

    // Relationship
    public function getAddress(): Address | array
    {

        if ($this->getId()) {
            $this->address->read($this->getId(), true);
        }

        $this->setAddress($this->address->getAll());

        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

    // Query Operation
    public function create()
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("INSERT INTO users (name, email, email_verified_at, password, created_at, updated_at) VALUES (:name, :email, :email_verified_at, :password, :created_at, :updated_at)");

            $this->setCreatedAt($now->format('Y-m-d H:i:s'));
            $this->setUpdatedAt($now->format('Y-m-d H:i:s'));

            $query->bindParam(':name', $this->name);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':email_verified_at', $this->email_verified_at);
            $query->bindParam(':password', $this->password);
            $query->bindParam(':created_at', $this->created_at);
            $query->bindParam(':updated_at', $this->updated_at);

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
            $query = $this->database->query('SELECT * FROM users');

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
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
        $this->setEmailVerifiedAt($data['email_verified_at']);

        $this->setCreatedAt($data['created_at']);
        $this->setUpdatedAt($data['updated_at']);

        return $data;
    }

    public function update(int $id): bool
    {

        try {
            $now = new DateTime();

            $query = $this->database->prepare("UPDATE users SET name = COALESCE(:name, name), email = COALESCE(:email, email), email_verified_at = COALESCE(:email_verified_at, email_verified_at), password = COALESCE(:password, password) WHERE id = :id");

            $this->setUpdatedAt(new DateTime());

            $data = [
                ':id' => $id,

                ':name' => isset($this->name) ? $this->name : null,
                ':email' => isset($this->email) ? $this->email : null,
                ':email_verified_at' => isset($this->email_verified_at) ? $this->email_verified_at : null,
                ':password' => isset($this->password) ? $this->password : null,

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
