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
            'map_type' => [
                'type'  => 'select',
                'label' => 'Map Type',
                'value' => [
                    'ROADMAP'   => 'Road Map',
                    'SATELLITE' => 'Satellite',
                    'HYBRID'    => 'Hybrid',
                    'TERRAIN'   => 'Terrain'
                ]
            ],
            'zoom' => [
                'type'       => 'text',
                'label'      => 'Zoom Level',
                'attributes' => [
                    'size'  => 3,
                    'class' => 'order-field'
                ],
                'value'      => 10
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
                    'style' => 'width: 98%'
                ]
            ],
            'latitude' => [
                'type'       => 'text',
                'label'      => 'Latitude',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'longitude' => [
                'type'       => 'text',
                'label'      => 'Longitude',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'pin_icon' => [
                'type'       => 'text',
                'label'      => 'Pin Icon',
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'styles' => [
                'type'       => 'textarea',
                'label'      => 'Styles',
                'attributes' => [
                    'rows'  => 20,
                    'cols'  => 80,
                    'style' => 'width: 98.5%'
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
            'new_window' => [
                'type'  => 'radio',
                'label' => 'New Window?',
                'value' => [
                    '1' => 'Yes',
                    '0' => 'No'
                ],
                'marked' => 0
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
                    'style' => 'width: 98%'
                ]
            ],
            'latitude' => [
                'type'       => 'text',
                'label'      => 'Latitude',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'longitude' => [
                'type'       => 'text',
                'label'      => 'Longitude',
                'required'   => true,
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'uri' => [
                'type'       => 'text',
                'label'      => 'URI',
                'attributes' => [
                    'size'  => 60,
                    'style' => 'width: 98%'
                ]
            ],
            'info' => [
                'type'       => 'textarea',
                'label'      => 'Info',
                'attributes' => [
                    'rows'  => 8,
                    'cols'  => 80,
                    'style' => 'width: 98.5%'
                ]
            ]
        ]
    ]
];
