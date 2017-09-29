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
        if($this->request->isGet()){
            echo 'GET';
        }

        $this->view->render('index.phtml', ['1' => 'teste', 'host' => 'lala']);

        //echo '<pre>';
        //printStop(Container::getAll());
    }

    public function createAll()
    {
        echo 'CREATE PRODUCTS ' . Container::getKey('action');
    }

}
