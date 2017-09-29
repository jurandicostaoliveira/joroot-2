<?php

namespace Joroot\Components;

/**
 * Class View
 * @package Joroot\Components
 */
class View
{

    /**
     * @param string $template
     * @param array $data
     */
    public function render($template, array $data = [])
    {
        try {
            $filename = sprintf('%sapp/views/%s', BASE_PATH, $template);
            if (!file_exists($filename)) {
                throw new \Exception(sprintf('File %s was not found.', $filename));
            }

            $scope = array_merge($data, Container::getScope());
            extract($scope);
            require_once "{$filename}";
        } catch (\Exception $e) {
            Container::error($e->getMessage());
        }
    }

    /**
     * @param array $data
     */
    public function json($data)
    {
        if (!is_array($data) || !is_object($data)) {
            $data = (array)$data;
        }

        echo json_encode($data);
    }

}
