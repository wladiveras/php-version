<?php

namespace App\Models;

use App\Core\Database;
use DateTime;

class Stove
{
    private $database;
    protected $id;
    protected $burners;
    protected $lighters;
    protected $lighters_colors;
    protected $oven;
    protected $oven_lamp;
    protected $oven_lamp_color;
    protected $oven_color;
    protected $stove_color;
    protected $stove_width;
    protected $stove_height;
    protected $stove_depth;
    protected $glass_width;
    protected $glass_heigth;
    protected $glass_leight;
    protected $brand;
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

    // GET METHODS
    public function getId()
    {
        return $this->id;
    }

    public function getBurners()
    {
        return $this->burners;
    }

    public function getLighters()
    {
        return $this->lighters;
    }

    public function getLighersColors()
    {
        return $this->lighters_colors;
    }

    public function getOven()
    {
        return $this->oven;
    }

    public function getOvenLamp()
    {
        return $this->oven_lamp;
    }

    public function getOvenLampColor()
    {
        return $this->oven_lamp_color;
    }

    public function getOvenColor()
    {
        return $this->oven_color;
    }

    public function getStoveColor()
    {
        return $this->stove_color;
    }

    public function getStoveWidth()
    {
        return $this->stove_width;
    }

    public function getStoveHeight()
    {
        return $this->stove_height;
    }

    public function getStoveDepth()
    {
        return $this->stove_depth;
    }

    public function getGlassWidth()
    {
        return $this->glass_width;
    }

    public function getGlassHeight()
    {
        return $this->glass_heigth;
    }

    public function getGlassLeight()
    {
        return $this->glass_leight;
    }

    public function getBrand()
    {
        return $this->brand;
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

    public function setBurners($burners): void
    {
        $this->burners = $burners;
    }

    public function setLighters($lighters): void
    {
        $this->lighters = $lighters;
    }

    public function setLighersColors($lighters_colors): void
    {
        $this->lighters_colors = $lighters_colors;
    }

    public function setOven($oven): void
    {
        $this->oven = $oven;
    }

    public function setOvenLamp($oven_lamp): void
    {
        $this->oven_lamp = $oven_lamp;
    }

    public function setOvenLampColor($oven_lamp_color): void
    {
        $this->oven_lamp_color = $oven_lamp_color;
    }

    public function setOvenColor($oven_color): void
    {
        $this->oven_color = $oven_color;
    }

    public function setStoveColor($stove_color): void
    {
        $this->stove_color = $stove_color;
    }

    public function setStoveWidth($stove_width): void
    {
        $this->stove_width = $stove_width;
    }

    public function setStoveHeight($stove_height): void
    {
        $this->stove_height = $stove_height;
    }

    public function setStoveDepth($stove_depth): void
    {
        $this->stove_depth = $stove_depth;
    }

    public function setGlassWidth($glass_width): void
    {
        $this->glass_width = $glass_width;
    }

    public function setGlassHeight($glass_heigth): void
    {
        $this->glass_heigth = $glass_heigth;
    }

    public function setGlassLeight($glass_leight): void
    {
        $this->glass_leight = $glass_leight;
    }

    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    public function getAll(): array
    {

        return [
            "id" => $this->getId(),
            "burners" => $this->getBurners(),
            "lighters" => $this->getLighters(),
            "lighters_colors" => $this->getLighersColors(),
            "oven" => $this->getOven(),
            "oven_lamp" => $this->getOvenLamp(),
            "oven_lamp_color" => $this->getOvenLampColor(),
            "oven_color" => $this->getOvenColor(),
            "stove_color" => $this->getStoveColor(),
            "stove_width" => $this->getStoveWidth(),
            "stove_height" => $this->getStoveHeight(),
            "stove_depth" => $this->getStoveDepth(),
            "glass_width" => $this->getGlassWidth(),
            "glass_heigth" => $this->getGlassHeight(),
            "brand" => $this->getBrand(),
        ];
    }

    // Query Operation
    public function create(): bool
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("INSERT INTO stoves (burners, lighters, lighters_colors, oven, oven_lamp, oven_lamp_color, has_glass, oven_color, stove_color, stove_width, stove_height, glass_width, glass_heigth, glass_leight, brand, created_at, updated_at) VALUES ( :burners, :lighters, :lighters_colors, :oven, :oven_lamp, :oven_lamp_color, :has_glass, :oven_color, :stove_color, :stove_width, :stove_height, :glass_width, :glass_heigth, :brand, :glass_leight, :created_at, :updated_at)");

            $this->setCreatedAt($now->format('Y-m-d H:i:s'));
            $this->setUpdatedAt($now->format('Y-m-d H:i:s'));

            $query->bindParam(':burners', $this->burners);
            $query->bindParam(':lighters', $this->lighters);
            $query->bindParam(':lighters_colors', $this->lighters_colors);
            $query->bindParam(':oven', $this->oven);
            $query->bindParam(':oven_lamp', $this->oven_lamp);
            $query->bindParam(':oven_lamp_color', $this->oven_lamp_color);
            $query->bindParam(':oven_color', $this->oven_color);
            $query->bindParam(':stove_color', $this->stove_color);
            $query->bindParam(':stove_width', $this->stove_width);
            $query->bindParam(':stove_height', $this->stove_height);
            $query->bindParam(':stove_depth', $this->stove_depth);
            $query->bindParam(':glass_width', $this->glass_width);
            $query->bindParam(':glass_heigth', $this->glass_heigth);
            $query->bindParam(':glass_leight', $this->glass_leight);

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
            $query = $this->database->prepare('SELECT * FROM stoves WHERE id = :id');
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
            $query = $this->database->query('SELECT * FROM stoves');

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

        $this->setBurners($data['burners']);
        $this->setLighters($data['lighters']);
        $this->setLighersColors($data['lighters_colors']);
        $this->setOven($data['oven']);
        $this->setOvenLamp($data['oven_lamp']);
        $this->setOvenLampColor($data['oven_lamp_color']);
        $this->setOvenColor($data['oven_color']);
        $this->setStoveColor($data['stove_color']);
        $this->setStoveWidth($data['stove_width']);
        $this->setStoveHeight($data['stove_height']);
        $this->setStoveDepth($data['stove_depth']);
        $this->setGlassWidth($data['glass_width']);
        $this->setGlassHeight($data['glass_heigth']);
        $this->setGlassLeight($data['glass_leight']);

        $this->setCreatedAt($data['created_at']);
        $this->setUpdatedAt($data['updated_at']);

        return $data;
    }

    public function update(int $id): bool
    {
        try {
            $now = new DateTime();

            $query = $this->database->prepare("UPDATE stoves SET burners = COALESCE(:burners, burners), lighters = COALESCE(:lighters, lighters), lighters_colors = COALESCE(:lighters_colors, lighters_colors), oven = COALESCE(:oven, oven), oven_lamp = COALESCE(:oven_lamp, oven_lamp), oven_lamp_color = COALESCE(:oven_lamp_color, oven_lamp_color), oven_color = COALESCE(:oven_color, oven_color), stove_color = COALESCE(:stove_color, stove_color), stove_width = COALESCE(:stove_width, stove_width), stove_height = COALESCE(:stove_height, stove_height), stove_depth = COALESCE(:stove_depth, stove_depth), glass_width = COALESCE(:glass_width, glass_width), glass_heigth = COALESCE(:glass_heigth, glass_heigth), glass_leight = COALESCE(:glass_leight, glass_leight), oven = COALESCE(:oven, oven), updated_at = :updated_at WHERE id = :id");

            $data = [
                ':id' => $id,

                ':burners' => isset($this->burners) ? $this->burners : null,
                ':lighters' => isset($this->lighters) ? $this->lighters : null,
                ':lighters_colors' => isset($this->lighters_colors) ? $this->lighters_colors : null,
                ':oven' => isset($this->oven) ? $this->oven : null,
                ':oven_lamp' => isset($this->oven_lamp) ? $this->oven_lamp : null,
                ':oven_lamp_color' => isset($this->oven_lamp_color) ? $this->oven_lamp_color : null,
                ':oven_color' => isset($this->oven_color) ? $this->oven_color : null,
                ':stove_color' => isset($this->stove_color) ? $this->stove_color : null,
                ':stove_width' => isset($this->stove_width) ? $this->stove_width : null,
                ':stove_height' => isset($this->stove_height) ? $this->stove_height : null,
                ':stove_depth' => isset($this->stove_depth) ? $this->stove_depth : null,
                ':glass_width' => isset($this->glass_width) ? $this->glass_width : null,
                ':glass_heigth' => isset($this->glass_heigth) ? $this->glass_heigth : null,
                ':glass_leight' => isset($this->glass_leight) ? $this->glass_leight : null,

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
