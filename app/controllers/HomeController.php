<?php

namespace App\Controllers;

use Joroot\Components\Container;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController
{
    /**
     * @param string $name
     */
    public function test($name)
    {
        //echo 'HOME CONTROLLER -> ' . $name;
        printStop(Container::getAll());
    }
}
