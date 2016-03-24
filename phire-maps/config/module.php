<?php
/**
 * Module Name: phire-maps
 * Author: Nick Sagona
 * Description: This is the maps module for Phire CMS 2
 * Version: 1.0
 */
return [
    'phire-maps' => [
        'prefix'     => 'Phire\Maps\\',
        'src'        => __DIR__ . '/../src',
        'routes'     => include 'routes.php',
        'resources'  => include 'resources.php',
        'forms'      => include 'forms.php',
        'nav.phire'  => [
            'fields' => [
                'name' => 'Maps',
                'href' => '/maps',
                'acl' => [
                    'resource'   => 'maps',
                    'permission' => 'index'
                ],
                'attributes' => [
                    'class' => 'maps-nav-icon'
                ]
            ]
        ],
        'events' => [
            [
                'name'     => 'app.send.pre',
                'action'   => 'Phire\Maps\Event\Maps::init',
                'priority' => 1000
            ],
            [
                'name'     => 'app.send.post',
                'action'   => 'Phire\Maps\Event\Maps::parse',
                'priority' => 1000
            ]
        ]
    ]
];
