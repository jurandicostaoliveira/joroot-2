<?php

return [

    /**
     * Force the domain
     */
    //'domain' => 'http://my-site.com.br',

    /**
     * Project root directory
     */
    'projectPath' => '/joroot-2/',

    /**
     * Route that will be initially loaded
     */
    'defaultRoute' => 'home',

    /**
     * Essential for date functions
     */
    'timezone' => 'America/Sao_Paulo',

    /**
     * Customize error message
     * Example : Do not panic, it may just be a route error, check the URL entered.
     */
    'customErrorMessage' => null,

    /**
     * Configuring the pdo driver for database
     */
    'pdo' => [
        'db1' => [
            'driver' => 'mysql',
            'port' => 3306,
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => null,
            'persistent' => true
        ]
    ]

];
