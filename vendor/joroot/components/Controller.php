<?php

namespace Joroot\Components;

/**
 * Class Controller
 * @package Joroot\Components
 */
abstract class Controller
{
    protected $request;

    protected $response;

    protected $redirect;

    protected $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->redirect = new Redirect();
        $this->view = new View();
    }
}
