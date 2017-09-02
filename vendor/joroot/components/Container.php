<?php

namespace Joroot\Components;

/**
 * Class Container
 * @package Joroot
 */
class Container
{
    /**
     * @var array
     */
    private static $scope = [];

    /**
     * @param array $scope
     */
    public static function add(array $scope = [])
    {
        self::$scope = array_merge(self::getConfig(), self::$scope, $scope);
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        $file = sprintf('%sapp%sconfig.php', BASE_PATH, DIRECTORY_SEPARATOR);
        if (!file_exists($file)) {
            self::error('File app/config.php not found.');
        }
        return require "{$file}";
    }

    /**
     * @return array
     */
    public static function getScope()
    {
        return array_diff_key(self::getAll(), self::getConfig());
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return self::$scope;
    }

    /**
     * @param null | string $message
     */
    public static function error($message = null)
    {
        $config = self::getConfig();
        if (isset($config['customErrorMessage']) && $config['customErrorMessage']) {
            $message = $config['customErrorMessage'];
        }

        $file = sprintf('%sjoroot%sviews%serror.phtml', VENDOR_PATH, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
        die(require "{$file}");
    }
}