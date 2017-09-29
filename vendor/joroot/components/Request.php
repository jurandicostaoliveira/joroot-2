<?php

namespace Joroot\Components;

/**
 * Class Request
 * @package Joroot\Components
 */
class Request
{

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtoupper(filter_input(INPUT_SERVER, 'REQUEST_METHOD'));
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return ($this->getMethod() === 'GET');
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return ($this->getMethod() === 'POST');
    }

}