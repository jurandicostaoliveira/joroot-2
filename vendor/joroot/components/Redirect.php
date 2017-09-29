<?php

namespace Joroot\Components;

/**
 * Class Redirect
 * @package Joroot\Components
 */
class Redirect
{
    /**
     * @param null | string $url
     */
    public function to($url = null)
    {
        if ($url) {
            header(sprintf('Location: %s', $url));
            exit(0);
        }
    }

}
