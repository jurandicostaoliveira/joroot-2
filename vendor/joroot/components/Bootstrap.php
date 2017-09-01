<?php

namespace Joroot\Components;

/**
 * Class Bootstrap
 * @components Joroot
 */
class Bootstrap
{
    private $url = [];

    private $projectDir = '/';

    public function __construct()
    {
        $this->url = explode('/', filter_input(INPUT_GET, 'url'));
    }

    /**
     * @param string $projectDir
     * @return $this
     */
    public function setProjectDir($projectDir = '/')
    {
        $this->projectDir = (string)$projectDir;
        return $this;
    }

    /**
     * @param string $string
     * @param bool $toFirstUpper
     * @return string
     */
    private function camelize($string, $toFirstUpper = false)
    {
        $str = preg_replace_callback('/[-_](.)/', function ($matches) {
            return strtoupper($matches[1]);
        }, $string);

        return ($toFirstUpper) ? ucfirst($str) : lcfirst($str);
    }

    /**
     * @return string
     */
    private function action()
    {
        return isset($this->url[1]) && (!empty($this->url[1])) ? $this->url[1] : 'index';
    }

    /**
     * @return string
     * @throws Exception
     */
    private function controller()
    {
        define('CONTROLLERS', '');
        $controller = $this->camelize($this->url[0], true);
        $file = sprintf('%s%sController.php', CONTROLLERS, $controller);

        if (!file_exists($file)) {
            throw new Exception(sprintf('O arquivo %s n&atilde;o foi encontrado.', $file));
        }

        return $controller;
    }

    public function run()
    {
        try {

        } catch (\Exception $e) {

        }
    }
}
