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
use Pop\View\View;

/**
 * Map Model class
 *
 * @category   Phire\Maps
 * @package    Phire\Maps
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 * @version    1.0.0
 */
class Map extends AbstractModel
{

    /**
     * Get all maps
     *
     * @param  int    $limit
     * @param  int    $page
     * @param  string $sort
     * @return array
     */
    public function getAll($limit = null, $page = null, $sort = null)
    {
        $order = $this->getSortOrder($sort, $page);

        if (null !== $limit) {
            $page = ((null !== $page) && ((int)$page > 1)) ?
                ($page * $limit) - $limit : null;

            $rows = Table\Maps::findAll([
                'offset' => $page,
                'limit'  => $limit,
                'order'  => $order
            ])->rows();
        } else {
            $rows = Table\Maps::findAll([
                'order'  => $order
            ])->rows();
        }

        foreach ($rows as $i => $row) {
            $rows[$i]->num_of_locations = Table\MapLocations::findBy(['map_id' => $row->id])->count();
        }

        return $rows;
    }

    /**
     * Get map by ID
     *
     * @param  int $id
     * @return void
     */
    public function getById($id)
    {
        $map = Table\Maps::findById($id);
        if (isset($map->id)) {
            $this->data = array_merge($this->data, $map->getColumns());
        }
    }

    /**
     * Get map with locations
     *
     * @param  int $id
     * @return string
     */
    public function getMap($id)
    {
        $map = Table\Maps::findById($id);
        if (isset($map->id)) {
            $mapData = $map->getColumns();
            $mapData['map_id']    = 'phire-map-' . $id;
            $mapData['map_class'] = 'phire-map-div';
            $mapData['locations'] = Table\MapLocations::findBy(['map_id' => $id])->rows();
            $view = new View(__DIR__ . '/../../view/maps-public/map.phtml', $mapData);
            return $view->render();
        } else {
            return '';
        }
    }

    /**
     * Save new map
     *
     * @param  array $fields
     * @return void
     */
    public function save(array $fields)
    {
        $map = new Table\Maps([
            'name'      => $fields['name'],
            'latitude'  => $fields['latitude'],
            'longitude' => $fields['longitude'],
            'pin_icon'  => (!empty($fields['pin_icon']) ? $fields['pin_icon'] : null),
            'styles'    => (!empty($fields['styles']) ? $fields['styles'] : null),
            'zoom'      => (!empty($fields['zoom']) ? (int)$fields['zoom'] : 10),
            'scroll'    => (!empty($fields['scroll']) ? (int)$fields['scroll'] : 0),
            'map_type'  => $fields['map_type']
        ]);
        $map->save();

        $this->data = array_merge($this->data, $map->getColumns());
    }

    /**
     * Update an existing map
     *
     * @param  array $fields
     * @return void
     */
    public function update(array $fields)
    {
        $map = Table\Maps::findById($fields['id']);
        if (isset($map->id)) {
            $map->name = $fields['name'];
            $map->latitude  = $fields['latitude'];
            $map->longitude = $fields['longitude'];
            $map->pin_icon  = (!empty($fields['pin_icon']) ? $fields['pin_icon'] : null);
            $map->styles    = (!empty($fields['styles']) ? $fields['styles'] : null);
            $map->zoom      = (!empty($fields['zoom']) ? (int)$fields['zoom'] : 10);
            $map->scroll    = (!empty($fields['scroll']) ? (int)$fields['scroll'] : 0);
            $map->map_type  = $fields['map_type'];
            $map->save();

            $this->data = array_merge($this->data, $map->getColumns());
        }
    }

    /**
     * Remove a map
     *
     * @param  array $fields
     * @return void
     */
    public function remove(array $fields)
    {
        if (isset($fields['rm_maps'])) {
            foreach ($fields['rm_maps'] as $id) {
                $map = Table\Maps::findById((int)$id);
                if (isset($map->id)) {
                    $map->delete();
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
        return (Table\Maps::findAll()->count() > $limit);
    }

    /**
     * Get count of maps
     *
     * @return int
     */
    public function getCount()
    {
        return Table\Maps::findAll()->count();
    }

}
