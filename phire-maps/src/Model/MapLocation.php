<?php

namespace Phire\Maps\Model;

use Phire\Maps\Table;
use Phire\Model\AbstractModel;
use Pop\File\Dir;

class MapLocation extends AbstractModel
{

    /**
     * Get all map locations
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

            return Table\MapLocations::findAll([
                'offset' => $page,
                'limit'  => $limit,
                'order'  => $order
            ])->rows();
        } else {
            return Table\MapLocations::findAll([
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
        $map = Table\MapLocations::findById($id);
        if (isset($map->id)) {
            $this->data  = array_merge($this->data, $map->getColumns());
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
        $map = new Table\MapLocations([
            'map_id'    => $fields['map_id'],
            'title'     => $fields['title'],
            'uri'       => (!empty($fields['uri']) ? $fields['uri'] : null),
            'info'      => (!empty($fields['info']) ? $fields['info'] : null),
            'longitude' => $fields['longitude'],
            'latitude'  => $fields['latitude']
        ]);
        $map->save();

        $this->data = array_merge($this->data, $map->getColumns());
    }

    /**
     * Update an existing map location
     *
     * @param  array $fields
     * @return void
     */
    public function update(array $fields)
    {
        $map = Table\MapLocations::findById($fields['id']);
        if (isset($map->id)) {
            $map->map_id    = $fields['map_id'];
            $map->title     = $fields['title'];
            $map->uri       = (!empty($fields['uri']) ? $fields['uri'] : null);
            $map->info      = (!empty($fields['info']) ? $fields['info'] : null);
            $map->longitude = $fields['longitude'];
            $map->latitude  = $fields['latitude'];
            $map->save();

            $this->data = array_merge($this->data, $map->getColumns());
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
                $map = Table\MapLocations::findById((int)$id);
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
