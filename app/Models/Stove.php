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
        $this->database = null;
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

    public function getAll(): array
    {
        return [
            "id" => $this->getId(),
            "burners" => $this->getBurners(),
            "oven" => $this->getOven(),
            "lighters" => $this->getLighters(),
            "lamp" => $this->getLamp(),
            "lamp_color" => $this->getLampColor(),
            "stove_color" => $this->getStoveColor(),
            "has_glass" => $this->hasGlass(),
            "glass_x" => $this->getGlassX(),
            "glass_y" => $this->getGlassY(),
        ];
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $query = $this->database->prepare("INSERT INTO stoves (burners, oven, lighters, lamp, lamp_color, stove_color, has_glass, glass_x, glass_y) VALUES (:burners, :oven, :lighters, :lamp, :lamp_color, :stove_color, :has_glass, :glass_x, :glass_y)");
            $query->bindParam(':burners', $this->burners);
            $query->bindParam(':oven', $this->oven);
            $query->bindParam(':lighters', $this->lighters);
            $query->bindParam(':lamp', $this->lamp);
            $query->bindParam(':lamp_color', $this->lamp_color);
            $query->bindParam(':stove_color', $this->stove_color);
            $query->bindParam(':has_glass', $this->has_glass);
            $query->bindParam(':glass_x', $this->glass_x);
            $query->bindParam(':glass_y', $this->glass_y);

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

    public function read($id): bool
    {
        try {
            $query = $this->database->prepare("SELECT * FROM stoves WHERE id = :id");
            $query->execute([':id' => $id]);

            $stove = $query->fetch();

            if ($stove) {
                $this->setId($stove['id']);
                $this->setBurners($stove['burners']);
                $this->setOven($stove['oven']);
                $this->setLighters($stove['lighters']);
                $this->setLamp($stove['lamp']);
                $this->setLampColor($stove['lamp_color']);
                $this->setStoveColor($stove['stove_color']);
                $this->setHasGlass($stove['has_glass']);
                $this->setGlassX($stove['glass_x']);
                $this->setGlassY($stove['glass_y']);

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
            $query = $this->database->prepare("UPDATE stoves SET burners = :burners, oven = :oven, lighters = :lighters, lamp = :lamp, lamp_color = :lamp_color, stove_color = :stove_color, has_glass = :has_glass, glass_x = :glass_x, glass_y = :glass_y WHERE id = :id");
            $query->bindParam(':burners', $this->burners);
            $query->bindParam(':oven', $this->oven);
            $query->bindParam(':lighters', $this->lighters);
            $query->bindParam(':lamp', $this->lamp);
            $query->bindParam(':lamp_color', $this->lamp_color);
            $query->bindParam(':stove_color', $this->stove_color);
            $query->bindParam(':has_glass', $this->has_glass);
            $query->bindParam(':glass_x', $this->glass_x);
            $query->bindParam(':glass_y', $this->glass_y);

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
            $query = $this->database->prepare("DELETE FROM stoves WHERE id = :id");

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
