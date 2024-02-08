<?php

namespace App\Models;

use App\Core\Database;

class Address
{
    private $database;
    protected $id;
    protected $user_id;
    protected $city_id;
    protected $number;
    protected $street;
    protected $region;
    protected $neighbourhood;
    protected $country;
    protected $country_code;

    protected $postal_code;

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

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getNeighbourhood()
    {
        return $this->neighbourhood;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCountryCode()
    {
        return $this->country_code;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function setNeighbourhood($neighbourhood)
    {
        $this->neighbourhood = $neighbourhood;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "user_id" => $this->getUserId(),
            "city_id" => $this->getCityId(),
            "number" => $this->getNumber(),
            "street" => $this->getStreet(),
            "region" => $this->getRegion(),
            "neighbourhood" => $this->getNeighbourhood(),
            "country" => $this->getCountry(),
            "postal_code" => $this->getPostalCode(),
        ];
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $query = $this->database->prepare("INSERT INTO addresses (user_id, number, street, region, neighbourhood, country, country_code, postal_code) VALUES (:user_id, :number, :street, :region, :neighbourhood, :country, :country_code, :postal_code)");

            $query->bindParam(':user_id', $this->user_id);
            $query->bindParam(':number', $this->number);
            $query->bindParam(':street', $this->street);
            $query->bindParam(':region', $this->region);
            $query->bindParam(':neighbourhood', $this->neighbourhood);
            $query->bindParam(':country', $this->country);
            $query->bindParam(':country_code', $this->country_code);
            $query->bindParam(':postal_code', $this->postal_code);

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
            $query = $this->database->prepare("SELECT * FROM addresses WHERE id = :id");
            $query->execute([':id' => $id]);

            $address = $query->fetch();

            if ($address) {
                $this->setId($address['id']);
                $this->setUserId($address['user_id']);
                $this->setNumber($address['number']);
                $this->setStreet($address['street']);
                $this->setRegion($address['region']);
                $this->setNeighbourhood($address['neighbourhood']);
                $this->setCountry($address['country']);
                $this->setCountryCode($address['country_code']);
                $this->setPostalCode($address['postal_code']);
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
            $query = $this->database->prepare("UPDATE addresses SET user_id = :user_id, number = :number, street = :street, region = :region, neighbourhood = :neighbourhood, country = :country, country_code = :country_code, postal_code = :postal_code WHERE id = :id");
            $query->bindParam(':user_id', $this->user_id);
            $query->bindParam(':number', $this->number);
            $query->bindParam(':street', $this->street);
            $query->bindParam(':region', $this->region);
            $query->bindParam(':neighbourhood', $this->neighbourhood);
            $query->bindParam(':country', $this->country);
            $query->bindParam(':country_code', $this->country_code);
            $query->bindParam(':postal_code', $this->postal_code);

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
