<?php

namespace App\Controllers;

use Joroot\Components\Container;
use Joroot\Components\Controller;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller
{

    public function index()
    {
        $this->view
            ->inDirectory('public/css/')
            ->render('index.phtml', ['1' => 'teste']);

        echo '<pre>';
        printStop(Container::getAll());
    }

    public function createAll()
    {
        echo 'CREATE PRODUCTS ' . Container::getKey('action');
    }

}
