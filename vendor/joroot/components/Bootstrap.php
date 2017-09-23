<?php

namespace Joroot\Components;

/**
 * Class Bootstrap
 * @package Joroot\Components
 */
class Bootstrap extends Container
{
    /**
     * @var array
     */
    private $url = [];

    /**
     * @var array
     */
    private $config = [];

    /**
     * Bootstrap constructor.
     */
    public function __construct()
    {
        if ($this->phpVersion() < parent::JOROOT_SUPORT_PHP_VERSION) {
            parent::error('Support only, for versions, equal to or greater than 5.6.0.');
        }

        $this->url = explode('/', filter_input(INPUT_GET, 'url'));
        $this->config = parent::getConfig();
    }

    /**
     * @return string
     */
    private function domain()
    {
        if (isset($this->config['domain'])) {
            return $this->config['domain'];
        }

        $protocol = filter_input(INPUT_SERVER, 'HTTPS') ? 'https' : 'http';
        return sprintf('%s://%s', $protocol, filter_input(INPUT_SERVER, 'HTTP_HOST'));
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
     * @return int
     */
    private function phpVersion()
    {
        return (int)str_replace('.', '', substr(PHP_VERSION, 0, 3));
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function projectHost()
    {
        if (!isset($this->config['projectPath'])) {
            throw new \Exception('Project path has not been configured');
        }

        return sprintf('%s%s', $this->domain(), $this->config['projectPath']);
    }

    /**
     * @return string
     */
    private function controllerRoute()
    {
        $defaultRoute = (isset($this->config['defaultRoute'])) ? $this->config['defaultRoute'] : null;
        return (isset($this->url[0]) && $this->url[0]) ? $this->url[0] : $defaultRoute;
    }

    /**
     * @return string
     */
    private function actionRoute()
    {
        return (isset($this->url[1]) && $this->url[1]) ? $this->url[1] : 'index';
    }

    /**
     * @return array
     */
    private function parameters()
    {
        return array_values(array_diff_key($this->url, [0, 1]));
    }

    /**
     * @param $name
     * @return string
     * @throws \Exception
     */
    private function controller($name)
    {
        $controller = sprintf('%sController', $this->camelize($name, true));
        $file = sprintf('%sapp%scontrollers%s%s.php', BASE_PATH, DS, DS, $controller);
        if (!file_exists($file)) {
            throw new \Exception(sprintf('File %s was not found.', $file));
        }

        return $controller;
    }

    /**
     * @param $name
     * @return string
     */
    private function action($name)
    {
        return $this->camelize($name);
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function scope()
    {
        $scope = [
            'host' => $this->projectHost(),
            'controllerRoute' => $this->controllerRoute(),
            'actionRoute' => $this->actionRoute(),
            'parameters' => $this->parameters()
        ];
        $scope['controller'] = $this->controller($scope['controllerRoute']);
        $scope['action'] = $this->action($scope['actionRoute']);

        return $scope;
    }

    /**
     * @param array $scope
     * @throws \Exception
     */
    private function dispatch($scope)
    {
        $strController = 'App\\Controllers\\' . $scope['controller'];
        $controller = new $strController();
        $method = $scope['action'];

        if (!class_exists($strController)) {
            throw new \Exception(
                sprintf('The class %s was not found in the file %s', $scope['controller'], $strController)
            );
        }

        if (!method_exists($strController, $method)) {
            throw new \Exception(
                sprintf('The method %s was not found in the class %s', $method, $strController)
            );
        };

        $controller->$method();
    }

    /**
     * Run all features
     */
    public function run()
    {
        try {
            ob_start();
            session_start();
            if (isset($this->config['timezone']) && $this->config['timezone']) {
                date_default_timezone_set($this->config['timezone']);
            }

            $scope = $this->scope();
            parent::add($scope);
            $this->dispatch($scope);
            ob_end_flush();
        } catch (\Exception $e) {
            parent::error($e->getMessage());
        }
    }
}
