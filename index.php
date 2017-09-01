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

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * Displays or hides the errors caused by php TRUE | FALSE
 */
displayErrors(true);

use Joroot\Components\Bootstrap;

$bootstrap = new Bootstrap();
$bootstrap->setProjectDir('joroot-2/')->run();

