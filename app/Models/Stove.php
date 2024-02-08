<?php

namespace App\Models;

use App\Core\Database;

class Stove
{
    private $database;
    protected $id;
    protected $burners; // Bocas limit = 4
    protected $oven; // Forno limit = 1 
    protected $lighters; // Acesendedores. 
    protected $lamp; // Lampada
    protected $lamp_color; // cor da lampada
    protected $stove_color; // cor do forno
    protected $has_glass; // se tem vidro
    protected $glass_x; // Dimensoes do vidro
    protected $glass_y; // Dimensao do vidro.

    public function __construct()
    {
        $this->database = Database::connect();
    }

    public function __destruct()
    {
    }

    // GET METHODS
    public function getId()
    {
        return $this->id;
    }

    public function getBurners()
    {
        return $this->burners;
    }

    public function getOven()
    {
        return $this->oven;
    }

    public function getLighters()
    {
        return $this->lighters;
    }

    public function getLamp()
    {
        return $this->lamp;
    }

    public function getLampColor()
    {
        return $this->lamp_color;
    }

    public function getStoveColor()
    {
        return $this->stove_color;
    }

    public function hasGlass()
    {
        return $this->has_glass;
    }

    public function getGlassY()
    {
        return $this->glass_y;
    }

    public function getGlassX()
    {
        return $this->glass_x;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setBurners(string $burners)
    {
        $this->burners = $burners;
    }

    public function setOven(string $oven)
    {
        $this->oven = $oven;
    }

    public function setLighters(string $lighters)
    {
        $this->lighters = $lighters;
    }

    public function setLamp(string $lamp)
    {
        $this->lamp = $lamp;
    }

    public function setLampColor(string $lamp_color)
    {
        $this->lamp_color = $lamp_color;
    }

    public function setStoveColor(string $stove_color)
    {
        $this->stove_color = $stove_color;
    }

    public function setHasGlass(string $has_glass)
    {
        $this->has_glass = $has_glass;
    }

    public function setGlassX(string $glass_x)
    {
        $this->glass_x = $glass_x;
    }

    public function setGlassY(string $glass_y)
    {
        $this->glass_y = $glass_y;
    }

    // Query Operation
    public function create()
    {
        $query = "INSERT INTO stoves (burners, oven, lighters, lamp, lamp_color, stove_color, has_glass, glass_x, glass_y) VALUES (:burners, :oven, :lighters, :lamp, :lamp_color, :stove_color, :has_glass, :glass_x, :glass_y)";

        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':burners', $this->burners);
        $stmt->bindParam(':oven', $this->oven);
        $stmt->bindParam(':lighters', $this->lighters);
        $stmt->bindParam(':lamp', $this->lamp);
        $stmt->bindParam(':lamp_color', $this->lamp_color);
        $stmt->bindParam(':stove_color', $this->stove_color);
        $stmt->bindParam(':has_glass', $this->has_glass);
        $stmt->bindParam(':glass_x', $this->glass_x);
        $stmt->bindParam(':glass_y', $this->glass_y);

        if ($stmt->execute()) {
            $this->id = $this->database->connect()->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function read(int $id)
    {
        $query = "SELECT * FROM stoves WHERE id = ?";

        $stmt = $this->database->prepare($query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->setId($row['id']);
            $this->setBurners($row['burners']);
            $this->setOven($row['oven']);
            $this->setLighters($row['lighters']);
            $this->setLamp($row['lamp']);
            $this->setLampColor($row['lamp_color']);
            $this->setStoveColor($row['stove_color']);
            $this->setHasGlass($row['has_glass']);
            $this->setGlassX($row['glass_x']);
            $this->setGlassY($row['glass_y']);

            return true;
        } else {
            return false;
        }
    }

    public function update(int $id)
    {
        $query = "UPDATE stoves SET burners = :burners, oven = :oven, lighters = :lighters, lamp = :lamp, lamp_color = :lamp_color, stove_color = :stove_color, has_glass = :has_glass, glass_x = :glass_x, glass_y = :glass_y WHERE id = :id";

        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->bindParam(':burners', $this->burners);
        $stmt->bindParam(':oven', $this->oven);
        $stmt->bindParam(':lighters', $this->lighters);
        $stmt->bindParam(':lamp', $this->lamp);
        $stmt->bindParam(':lamp_color', $this->lamp_color);
        $stmt->bindParam(':stove_color', $this->stove_color);
        $stmt->bindParam(':has_glass', $this->has_glass);
        $stmt->bindParam(':glass_x', $this->glass_x);
        $stmt->bindParam(':glass_y', $this->glass_y);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM stoves WHERE id = :id";
        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
