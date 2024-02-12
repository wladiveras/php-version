<?php

namespace App\Models;

use App\Core\Database;
use DateTime;

class Address
{
    private $database;
    private $city;
    protected $id;
    protected $user_id;
    protected $city_id;
    protected $number;
    protected $street;
    protected $complement;
    protected $neighbourhood;
    protected $country;
    protected $postal_code;
    protected $created_at;
    protected $updated_at;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->city = new City();
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

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getCityId(): int
    {
        return $this->city_id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function getNeighbourhood(): string
    {
        return $this->neighbourhood;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
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

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function SetCityId($city_id): void
    {
        $this->city_id = $city_id;
    }

    public function setNumber($number): void
    {
        $this->number = $number;
    }

    public function setStreet($street): void
    {
        $this->street = $street;
    }

    public function setComplement($complement): void
    {
        $this->complement = $complement;
    }

    public function setNeighbourhood(string $neighbourhood): void
    {
        $this->neighbourhood = $neighbourhood;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setPostalCode(string $postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "number" => $this->getNumber(),
            "street" => $this->getStreet(),
            "complement" => $this->getComplement(),
            "neighbourhood" => $this->getNeighbourhood(),
            "country" => $this->getCountry(),
            "postal_code" => $this->getPostalCode(),
            'city' => $this->getCity()
        ];
    }

    // Relationship
    public function getCity(): City | array
    {
        $this->city->read($this->getCityId());
        $this->setCity($this->city->getAll());

        return $this->city;
    }

    public function setCity($city): void
    {
        $this->city = $city;
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("INSERT INTO addresses (user_id, city_id, number, street, complement, neighbourhood, country, postal_code, created_at, updated_at) VALUES (:user_id, :city_id, :number, :street, :complement, :neighbourhood, :country, :postal_code, :created_at, :updated_at)");

            $this->setCreatedAt($now->format('Y-m-d H:i:s'));
            $this->setUpdatedAt($now->format('Y-m-d H:i:s'));

            $query->bindParam(':user_id', $this->user_id);
            $query->bindParam(':city_id', $this->city_id);
            $query->bindParam(':number', $this->number);
            $query->bindParam(':street', $this->street);
            $query->bindParam(':complement', $this->complement);
            $query->bindParam(':neighbourhood', $this->neighbourhood);
            $query->bindParam(':country', $this->country);
            $query->bindParam(':postal_code', $this->postal_code);

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

    public function read($id, $user_id = false): bool
    {
        try {
            if ($user_id) {
                $query = $this->database->prepare("SELECT * FROM addresses WHERE user_id = :id");
            } else {
                $query = $this->database->prepare("SELECT * FROM addresses WHERE id = :id");
            }

            $query->execute([':id' => $id]);

            $address = $query->fetch();

            if ($address) {
                $this->setId($address['id']);
                $this->setUserId($address['user_id']);
                $this->SetCityId($address['city_id']);
                $this->setNumber($address['number']);
                $this->setStreet($address['street']);
                $this->setComplement($address['complement']);
                $this->setNeighbourhood($address['neighbourhood']);
                $this->setCountry($address['country']);
                $this->setPostalCode($address['postal_code']);
                $this->setCreatedAt($address['created_at']);
                $this->setUpdatedAt($address['updated_at']);
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
            $now = new DateTime();

            $query = $this->database->prepare("UPDATE addresses SET user_id = COALESCE(:user_id, user_id), city_id = COALESCE(:city_id, city_id), number = COALESCE(:number, number), street = COALESCE(:street, street), complement = COALESCE(:complement, complement), neighbourhood = COALESCE(:neighbourhood, neighbourhood), country = COALESCE(:country, country),  postal_code = COALESCE(:postal_code, postal_code), created_at = COALESCE(:created_at, created_at),   updated_at = :updated_at WHERE id = :id");

            $data = [
                ':user_id' => $id,

                ':city_id' => isset($this->city_id) ? $this->city_id : null,
                ':number' => isset($this->number) ? $this->number : null,
                ':street' => isset($this->street) ? $this->street : null,
                ':complement' => isset($this->complement) ? $this->complement : null,
                ':neighbourhood' => isset($this->neighbourhood) ? $this->neighbourhood : null,
                ':country' => isset($this->country) ? $this->country : null,
                ':postal_code' => isset($this->postal_code) ? $this->postal_code : null,
                ':created_at' => isset($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,

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
            $query = $this->database->prepare("DELETE FROM addresses WHERE id = :id");

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
