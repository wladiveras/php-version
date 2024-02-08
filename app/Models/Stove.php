<?php

namespace App\Models;

use App\Config\Database;

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
        $this->database = new Database();
    }

    public function __destruct()
    {
        $this->database->close();
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

    // SET METHODS
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

    // CRUD OPERATIONS
    public function create(array $data)
    {
    }

    public function read(int $id)
    {
    }

    public function update(int $id, array $data)
    {
    }

    public function delete(int $id)
    {
    }
}
