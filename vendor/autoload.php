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

define('VENDOR_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

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
            $path .= sprintf('%s%s', lcfirst($row), DIRECTORY_SEPARATOR);
        }

        $path .= $fileName;
        if (file_exists(VENDOR_DIR . $path)) {
            $file = VENDOR_DIR . $path;
        } elseif (file_exists(APP_DIR . $path)) {
            $file = APP_DIR . $path;
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

function test($name)
{
    die($name);
}

spl_autoload_register('autoload');
