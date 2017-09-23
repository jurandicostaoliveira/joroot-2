<?php

namespace Joroot\Components;

/**
 * Class View
 * @package Joroot\Components
 */
class View
{

    private $directory;

    /**
     * @param $directory
     * @return $this
     */
    public function inDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    protected function directory()
    {
        $dir = BASE_PATH . $this->directory;
        if ($this->directory && is_dir($dir)) {
            return $dir;
        }

        return sprintf('%sapp/views/', BASE_PATH);
    }

    /**
     * @param string $template
     * @param array $data
     */
    public function render($template, array $data = [])
    {
        try {
            $filename = $this->directory() . $template;
            if (!file_exists($filename)) {
                throw new \Exception(sprintf('File %s was not found.', $filename));
            }

            printStop($this->getPath() . $template);

        } catch (\Exception $e) {
            Container::error($e->getMessage());
        }
    }
}
