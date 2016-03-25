<?php

namespace Phire\Maps\Controller;

use Phire\Maps\Model;
use Phire\Maps\Form;
use Phire\Maps\Table;
use Phire\Controller\AbstractController;
use Pop\Paginator\Paginator;

class LocationsController extends AbstractController
{

    /**
     * Index action method
     *
     * @param  int $mid
     * @return void
     */
    public function index($mid)
    {
        $map = new Model\Map();
        $map->getById($mid);

        $location = new Model\MapLocation();

        if ($location->hasPages($this->config->pagination)) {
            $limit = $this->config->pagination;
            $pages = new Paginator($location->getCount(), $limit);
            $pages->useInput(true);
        } else {
            $limit = null;
            $pages = null;
        }

        $this->prepareView('maps/locations/index.phtml');
        $this->view->title  = 'Maps : ' . $map->name . ' : Locations';
        $this->view->pages  = $pages;
        $this->view->mid    = $mid;
        $this->view->locations = $location->getAll(
            $limit, $this->request->getQuery('page'), $this->request->getQuery('sort')
        );

        $this->send();
    }

    /**
     * Add action method
     *
     * @param  int $mid
     * @return void
     */
    public function add($mid)
    {
        $map = new Model\Map();
        $map->getById($mid);

        $this->prepareView('maps/locations/add.phtml');
        $this->view->title = 'Maps : ' . $map->name . ' : Locations : Add';
        $this->view->mid   = $mid;

        $fields = $this->application->config()['forms']['Phire\Maps\Form\MapLocation'];
        $fields[0]['map_id']['value'] = $mid;
        $this->view->form = new Form\MapLocation($fields);

        if ($this->request->isPost()) {
            $this->view->form->addFilter('htmlentities', [ENT_QUOTES, 'UTF-8'])
                 ->setFieldValues($this->request->getPost());

            if ($this->view->form->isValid()) {
                $this->view->form->clearFilters()
                     ->addFilter('html_entity_decode', [ENT_QUOTES, 'UTF-8'])
                     ->filter();
                $location = new Model\MapLocation();
                $location->save($this->view->form->getFields());
                $this->view->id = $location->id;
                $this->sess->setRequestValue('saved', true);
                $this->redirect(BASE_PATH . APP_URI . '/maps/locations/edit/' . $mid . '/' . $location->id);
            }
        }

        $this->send();
    }

    /**
     * Edit action method
     *
     * @param  int $mid
     * @param  int $id
     * @return void
     */
    public function edit($mid, $id)
    {
        $map = new Model\Map();
        $map->getById($mid);

        $this->prepareView('maps/locations/edit.phtml');
        $this->view->title = 'Maps : ' . $map->name;
        $this->view->mid   = $mid;

        $location = new Model\MapLocation();
        $location->getById($id);

        $fields = $this->application->config()['forms']['Phire\Maps\Form\MapLocation'];
        $fields[0]['map_id']['value'] = $mid;
        $fields[1]['title']['attributes']['onkeyup'] = 'phire.changeTitle(this.value);';

        $this->view->location_name = $location->title;

        $this->view->form = new Form\MapLocation($fields);
        $this->view->form->addFilter('htmlentities', [ENT_QUOTES, 'UTF-8'])
             ->setFieldValues($location->toArray());

        if ($this->request->isPost()) {
            $this->view->form->setFieldValues($this->request->getPost());

            if ($this->view->form->isValid()) {
                $this->view->form->clearFilters()
                     ->addFilter('html_entity_decode', [ENT_QUOTES, 'UTF-8'])
                     ->filter();
                $location = new Model\MapLocation();
                $location->update($this->view->form->getFields());
                $this->view->id = $location->id;
                $this->sess->setRequestValue('saved', true);
                $this->redirect(BASE_PATH . APP_URI . '/maps/locations/edit/' . $mid . '/' . $location->id);
            }
        }

        $this->send();
    }

    /**
     * Remove action method
     *
     * @param  int $mid
     * @return void
     */
    public function remove($mid)
    {
        if ($this->request->isPost()) {
            $map = new Model\MapLocation();
            $map->remove($this->request->getPost());
        }
        $this->sess->setRequestValue('removed', true);
        $this->redirect(BASE_PATH . APP_URI . '/maps/locations/' . $mid);
    }

    /**
     * Prepare view
     *
     * @param  string $template
     * @return void
     */
    protected function prepareView($template)
    {
        $this->viewPath = __DIR__ . '/../../view';
        parent::prepareView($template);
    }

}
