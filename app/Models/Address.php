<?php

namespace App\Models;

use App\Config\Database;

class Address
{
    private $database;
    protected $id;
    protected $user_id;
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

    // Query Operation
    public function create()
    {
        $query = "INSERT INTO addresses (user_id, number, street, region, neighbourhood, country, country_code, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);

        $stmt->bind_param("isssssss", $this->user_id, $this->number, $this->street, $this->region, $this->neighbourhood, $this->country, $this->country_code, $this->postal_code);

        $result = $stmt->execute();

        if ($result) {
            $this->id = $stmt->insert_id;
            return true;
        } else {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM addresses WHERE id = ?";

        $stmt = $this->database->prepare($query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->setId($row['id']);
            $this->setUserId($row['user_id']);
            $this->setNumber($row['number']);
            $this->setStreet($row['street']);
            $this->setRegion($row['region']);
            $this->setNeighbourhood($row['neighbourhood']);
            $this->setCountry($row['country']);
            $this->setCountryCode($row['country_code']);
            $this->setPostalCode($row['postal_code']);
            return true;
        } else {
            return false;
        }
    }

    public function update($id)
    {
        $query = "UPDATE addresses SET user_id = ?, number = ?, street = ?, region = ?, neighbourhood = ?, country = ?, country_code = ?, postal_code = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);

        $stmt->bind_param("isssssssi", $this->user_id, $this->number, $this->street, $this->region, $this->neighbourhood, $this->country, $this->country_code, $this->postal_code, $id);

        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM addresses WHERE id = ?";

        $stmt = $this->database->prepare($query);

        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
