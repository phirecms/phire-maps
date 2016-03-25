<?php

namespace Phire\Maps\Model;

use Phire\Maps\Table;
use Phire\Model\AbstractModel;
use Pop\File\Dir;

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
            $this->data  = array_merge($this->data, $map->getColumns());
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
            'longitude' => $fields['longitude'],
            'latitude'  => $fields['latitude'],
            'pin_icon'  => (!empty($fields['pin_icon']) ? $fields['pin_icon'] : null),
            'zoom'      => (!empty($fields['zoom']) ? (int)$fields['zoom'] : 7),
            'satellite' => (!empty($fields['satellite']) ? (int)$fields['satellite'] : 0)
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
            $map->longitude = $fields['longitude'];
            $map->latitude  = $fields['latitude'];
            $map->pin_icon  = (!empty($fields['pin_icon']) ? $fields['pin_icon'] : null);
            $map->zoom      = (!empty($fields['zoom']) ? (int)$fields['zoom'] : 7);
            $map->satellite = (!empty($fields['satellite']) ? (int)$fields['satellite'] : 0);
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
