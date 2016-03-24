<?php

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
        ]
    ]
];
