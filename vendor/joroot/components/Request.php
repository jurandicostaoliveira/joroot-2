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

    /**
     * @param array $data
     * @return array
     */
    private function recursive(array $data = [])
    {
        array_walk_recursive($data, function (&$value) {
            $value = trim(addslashes($value));
        });

        return $data;
    }

    /**
     * @return array
     */
    private function uriParams()
    {
        $data = [];
        $url = parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'));
        if (isset($url['query'])) {
            $query = explode('&', $url['query']);
            foreach ($query as $row) {
                $value = explode('=', $row);
                $data[$value[0]] = $value[1];
            }
        }

        return $this->recursive($data);
    }

    /**
     * @param bool $isFile
     * @return array
     */
    private function inputs($isFile = false)
    {
        $data = ($isFile) ? filter_var_array($_FILES) : filter_input_array(INPUT_POST);
        if (!$data) {
            return [];
        }

        return $this->recursive($data);
    }

    /**
     * @return string
     */
    public function getController()
    {
        return Container::getKey('controller');
    }

    /**
     * @return string
     */
    public function getControllerRoute()
    {
        return Container::getKey('controllerRoute');
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return Container::getKey('action');
    }

    /**
     * @return string
     */
    public function getActionRoute()
    {
        return Container::getKey('actionRoute');
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this->recursive(Container::getKey('parameters'));
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_merge($this->uriParams(), $this->inputs(), $this->inputs(true));
    }

    /**
     * @param string $key
     * @return string | null
     */
    public function get($key)
    {
        $data = $this->all();
        if (isset($data[$key])) {
            return $data[$key];
        }

        return null;
    }

}