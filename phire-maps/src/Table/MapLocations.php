<?php

namespace Phire\Maps\Table;

use Pop\Db\Record;

class MapLocations extends Record
{

    /**
     * Table prefix
     * @var string
     */
    protected $prefix = DB_PREFIX;

    /**
     * Primary keys
     * @var array
     */
    protected $primaryKeys = ['id'];

}