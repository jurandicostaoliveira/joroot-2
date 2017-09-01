<?php

namespace App\Controllers;

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
        echo 'HOME CONTROLLER -> ' . $name;
    }
}
