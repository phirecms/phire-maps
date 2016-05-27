<?php
/**
 * phire-maps routes
 */
return [
    APP_URI => [
        '/maps[/]' => [
            'controller' => 'Phire\Maps\Controller\IndexController',
            'action'     => 'index',
            'acl'        => [
                'resource'   => 'maps',
                'permission' => 'index'
            ]
        ],
        '/maps/add' => [
            'controller' => 'Phire\Maps\Controller\IndexController',
            'action'     => 'add',
            'acl'        => [
                'resource'   => 'maps',
                'permission' => 'add'
            ]
        ],
        '/maps/edit/:id' => [
            'controller' => 'Phire\Maps\Controller\IndexController',
            'action'     => 'edit',
            'acl'        => [
                'resource'   => 'maps',
                'permission' => 'edit'
            ]
        ],
        '/maps/remove' => [
            'controller' => 'Phire\Maps\Controller\IndexController',
            'action'     => 'remove',
            'acl'        => [
                'resource'   => 'maps',
                'permission' => 'remove'
            ]
        ],
        '/maps/locations/:mid' => [
            'controller' => 'Phire\Maps\Controller\LocationsController',
            'action'     => 'index',
            'acl'        => [
                'resource'   => 'map-locations',
                'permission' => 'index'
            ]
        ],
        '/maps/locations/add/:mid' => [
            'controller' => 'Phire\Maps\Controller\LocationsController',
            'action'     => 'add',
            'acl'        => [
                'resource'   => 'map-locations',
                'permission' => 'add'
            ]
        ],
        '/maps/locations/edit/:mid/:id' => [
            'controller' => 'Phire\Maps\Controller\LocationsController',
            'action'     => 'edit',
            'acl'        => [
                'resource'   => 'map-locations',
                'permission' => 'edit'
            ]
        ],
        '/maps/locations/remove/:mid' => [
            'controller' => 'Phire\Maps\Controller\LocationsController',
            'action'     => 'remove',
            'acl'        => [
                'resource'   => 'map-locations',
                'permission' => 'remove'
            ]
        ]
    ]
];
