<?php

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class UsersController
{
    // Show the product attributes based on the id.
    public function showAction(int $id, RouteCollection $routes)
    {
        $product = new User();
        $product->read($id);

        require_once APP_ROOT . '/views/product.php';
    }
    public function read(int $id)
    {
        $this->title = 'My first Product';
        $this->description = 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum ';
        $this->price = 2.56;
        $this->sku = 'MVC-SP-PHP-01';
        $this->image = 'https://via.placeholder.com/150';

        return $this;
    }
}
