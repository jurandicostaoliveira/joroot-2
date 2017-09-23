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

    protected $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }
}
