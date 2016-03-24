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

            return Table\Maps::findAll([
                'offset' => $page,
                'limit'  => $limit,
                'order'  => $order
            ])->rows();
        } else {
            return Table\Maps::findAll([
                'order'  => $order
            ])->rows();
        }
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
     * @param  array $maps
     * @return void
     */
    public function save(array $maps)
    {
        $map = new Table\Maps([
            'name'           => $maps['name'],
            'locations'      => null
        ]);
        $map->save();

        $this->data = array_merge($this->data, $map->getColumns());
    }

    /**
     * Update an existing map
     *
     * @param  array $maps
     * @return void
     */
    public function update(array $maps)
    {
        $map = Table\Maps::findById($maps['id']);
        if (isset($map->id)) {
            $map->name      = $maps['name'];
            $map->locations = null;
            $map->save();

            $this->data = array_merge($this->data, $map->getColumns());
        }
    }

    /**
     * Remove a map
     *
     * @param  array $maps
     * @return void
     */
    public function remove(array $maps)
    {
        if (isset($maps['rm_maps'])) {
            foreach ($maps['rm_maps'] as $id) {
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
