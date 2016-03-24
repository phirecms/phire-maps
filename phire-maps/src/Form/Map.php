<?php

namespace Phire\Maps\Form;

use Pop\Form\Form;
use Pop\Validator;

class Map extends Form
{

    /**
     * Constructor
     *
     * Instantiate the form object
     *
     * @param  array  $fields
     * @param  string $action
     * @param  string $method
     * @return Map
     */
    public function __construct(array $fields = null, $action = null, $method = 'post')
    {
        parent::__construct($fields, $action, $method);
        $this->setAttribute('id', 'map-form');
        $this->setIndent('    ');
    }

}