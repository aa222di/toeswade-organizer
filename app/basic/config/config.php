<?php
/**
 * Config-file for Organizer
 *
 */
return [

    /**
     * Settings for Which theme to use, theme directory is found by path.
     *
     */
    'theme' => [
        'path' => dirname(__DIR__),
        'name' => 'basic',
    ],

    /**
     * Database settings
     *
     */
    'database' => [
        'host'      => 'localhost',
        'dbname'    => 'toeswade',
        'user'      => 'root',
        'password'  => 'root',
    ],

    /**
     * Navigation
     * 
     */
    'navigation' => [
        'main'      => [
            
            'start'         => [
                'text'          => 'Dashboard',
                'url'           => '',
                'controller'    => 'CDashboard',
            ],

            'projects'          => [
                'text'          => 'Befintliga projekt',
                'url'           => 'projects',
                'controller'    => 'CProject',
            ],
        ],

        'sub'      => [],
    ],

];

