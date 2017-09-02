<?php
/**
 * Joroot Framework(PHP) 2
 *
 * @author      Jurandi C. Oliveira (jurandi@jurandioliveira.com.br)
 * @link        https://github.com/jurandicostaoliveira/joroot-2
 * @since       2011
 * @version     2.0.1
 * @license     Free for study, development and contribution
 */

define('DS', DIRECTORY_SEPARATOR);

/**
 * @param null | string $dirName
 * @return string
 */
function forcePath($dirName = null)
{
    return realpath(__DIR__ . DS . '..' . DS . $dirName) . DS;
}

define('BASE_PATH', forcePath());
define('VENDOR_PATH', forcePath('vendor'));

/**
 * @param string $using
 */
function autoload($using)
{
    try {
        $split = explode('\\', $using);
        $fileName = sprintf('%s.php', ucfirst(end($split)));
        array_pop($split);
        $path = '';
        $file = '';

        foreach ($split as $row) {
            $path .= sprintf('%s%s', lcfirst($row), DS);
        }

        $path .= $fileName;
        if (file_exists(VENDOR_PATH . $path)) {
            $file = VENDOR_PATH . $path;
        } elseif (file_exists(BASE_PATH . $path)) {
            $file = BASE_PATH . $path;
        } else {
            throw new Exception(sprintf('The file %s was not found.', $path));
        }

        require_once "{$file}";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param boolean $enable
 */
function displayErrors($enable = false)
{
    if ($enable) {
        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    }
}

/**
 * @param mixed $data
 */
function printStop($data)
{
    print_r($data);
    exit(0);
}

spl_autoload_register('autoload');
