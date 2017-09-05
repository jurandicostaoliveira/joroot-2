<?php

namespace App\Controllers;

use Joroot\Components\Container;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController
{

    public function index()
    {
        echo '<pre>';
        printStop(Container::getAll());
    }

    public function createAll()
    {
        echo 'CREATE PRODUCTS ' . Container::getKey('action');
    }

}
