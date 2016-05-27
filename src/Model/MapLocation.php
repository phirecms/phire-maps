<?php
/**
 * Phire Maps Module
 *
 * @link       https://github.com/phirecms/phire-maps
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Phire\Maps\Model;

use Phire\Maps\Table;
use Phire\Model\AbstractModel;
use Pop\File\Dir;

/**
 * Map Location Model class
 *
 * @category   Phire\Maps
 * @package    Phire\Maps
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 * @version    1.0.0
 */
class MapLocation extends AbstractModel
{

    /**
     * Get all map locations
     *
     * @param  int    $mid
     * @param  int    $limit
     * @param  int    $page
     * @param  string $sort
     * @return array
     */
    public function getAll($mid, $limit = null, $page = null, $sort = null)
    {
        $order = $this->getSortOrder($sort, $page);

        if (null !== $limit) {
            $page = ((null !== $page) && ((int)$page > 1)) ?
                ($page * $limit) - $limit : null;

            return Table\MapLocations::findBy(['map_id' => $mid], [
                'offset' => $page,
                'limit'  => $limit,
                'order'  => $order
            ])->rows();
        } else {
            return Table\MapLocations::findBy(['map_id' => $mid], [
                'order'  => $order
            ])->rows();
        }
    }

    /**
     * Get map location by ID
     *
     * @param  int $id
     * @return void
     */
    public function getById($id)
    {
        $location = Table\MapLocations::findById($id);
        if (isset($location->id)) {
            $this->data  = array_merge($this->data, $location->getColumns());
        }
    }

    /**
     * Save new map location
     *
     * @param  array $fields
     * @return void
     */
    public function save(array $fields)
    {
        $location = new Table\MapLocations([
            'map_id'     => $fields['map_id'],
            'title'      => $fields['title'],
            'uri'        => (!empty($fields['uri']) ? $fields['uri'] : null),
            'info'       => (!empty($fields['info']) ? $fields['info'] : null),
            'latitude'   => $fields['latitude'],
            'longitude'  => $fields['longitude'],
            'new_window' => (!empty($fields['new_window']) ? (int)$fields['new_window'] : 0),
        ]);
        $location->save();

        $this->data = array_merge($this->data, $location->getColumns());
    }

    /**
     * Update an existing map location
     *
     * @param  array $fields
     * @return void
     */
    public function update(array $fields)
    {
        $location = Table\MapLocations::findById($fields['id']);
        if (isset($location->id)) {
            $location->map_id     = $fields['map_id'];
            $location->title      = $fields['title'];
            $location->uri        = (!empty($fields['uri']) ? $fields['uri'] : null);
            $location->info       = (!empty($fields['info']) ? $fields['info'] : null);
            $location->latitude   = $fields['latitude'];
            $location->longitude  = $fields['longitude'];
            $location->longitude  = $fields['longitude'];
            $location->new_window = (!empty($fields['new_window']) ? (int)$fields['new_window'] : 0);
            $location->save();

            $this->data = array_merge($this->data, $location->getColumns());
        }
    }

    /**
     * Remove a map location
     *
     * @param  array $fields
     * @return void
     */
    public function remove(array $fields)
    {
        if (isset($fields['rm_map_locations'])) {
            foreach ($fields['rm_map_locations'] as $id) {
                $location = Table\MapLocations::findById((int)$id);
                if (isset($location->id)) {
                    $location->delete();
                }
            }
        }
    }

    /**
     * Determine if list of maps has pages
     *
     * @param  int $limit
     * @return boolean
     */
    public function hasPages($limit)
    {
        return (Table\MapLocations::findAll()->count() > $limit);
    }

    /**
     * Get count of maps
     *
     * @return int
     */
    public function getCount()
    {
        return Table\MapLocations::findAll()->count();
    }

}
