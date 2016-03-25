<?php

return [
    'Phire\Maps\Form\Map' => [
        [
            'submit' => [
                'type'       => 'submit',
                'value'      => 'Save',
                'attributes' => [
                    'class'  => 'save-btn wide'
                ]
            ],
            'id' => [
                'type'  => 'hidden',
                'value' => 0
            ]
        ],
        [
            'name' => [
                'type'       => 'text',
                'label'      => 'Name',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 99.5%'
                ]
            ]
        ]
    ],
    'Phire\Maps\Form\MapLocation' => [
        [
            'submit' => [
                'type'       => 'submit',
                'value'      => 'Save',
                'attributes' => [
                    'class'  => 'save-btn wide'
                ]
            ],
            'map_id' => [
                'type'  => 'hidden',
                'value' => 0
            ],
            'id' => [
                'type'  => 'hidden',
                'value' => 0
            ]
        ],
        [
            'title' => [
                'type'       => 'text',
                'label'      => 'Title',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 99.5%'
                ]
            ]
        ]
    ]
];
