<?php

namespace Phire\Maps\Controller;

use Phire\Maps\Model;
use Phire\Maps\Form;
use Phire\Maps\Table;
use Phire\Controller\AbstractController;
use Pop\Paginator\Paginator;

class IndexController extends AbstractController
{

    /**
     * Index action method
     *
     * @return void
     */
    public function index()
    {
        $map = new Model\Map();

        if ($map->hasPages($this->config->pagination)) {
            $limit = $this->config->pagination;
            $pages = new Paginator($map->getCount(), $limit);
            $pages->useInput(true);
        } else {
            $limit = null;
            $pages = null;
        }

        $this->prepareView('maps/index.phtml');
        $this->view->title  = 'Maps';
        $this->view->pages  = $pages;
        $this->view->maps = $map->getAll(
            $limit, $this->request->getQuery('page'), $this->request->getQuery('sort')
        );

        $this->send();
    }

    /**
     * Add action method
     *
     * @return void
     */
    public function add()
    {
        $this->prepareView('maps/add.phtml');
        $this->view->title = 'Maps : Add';

        $fields = $this->application->config()['forms']['Phire\Maps\Form\Map'];

        $this->view->form = new Form\Map($fields);

        if ($this->request->isPost()) {
            $this->view->form->addFilter('htmlentities', [ENT_QUOTES, 'UTF-8'])
                 ->setFieldValues($this->request->getPost());

            if ($this->view->form->isValid()) {
                $this->view->form->clearFilters()
                     ->addFilter('html_entity_decode', [ENT_QUOTES, 'UTF-8'])
                     ->filter();
                $map = new Model\Map();
                $map->save($this->view->form->getFields());
                $this->view->id = $map->id;
                $this->sess->setRequestValue('saved', true);
                $this->redirect(BASE_PATH . APP_URI . '/maps/edit/' . $map->id);
            }
        }

        $this->send();
    }

    /**
     * Edit action method
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->prepareView('maps/edit.phtml');
        $this->view->title = 'Maps : Edit';

        $map = new Model\Map();
        $map->getById($id);

        $fields = $this->application->config()['forms']['Phire\Maps\Form\Map'];
        $fields[1]['name']['attributes']['onkeyup'] = 'phire.changeTitle(this.value);';

        $this->view->map_name = $map->name;

        $this->view->form = new Form\Map($fields);
        $this->view->form->addFilter('htmlentities', [ENT_QUOTES, 'UTF-8'])
             ->setFieldValues($map->toArray());

        if ($this->request->isPost()) {
            $this->view->form->setFieldValues($this->request->getPost());

            if ($this->view->form->isValid()) {
                $this->view->form->clearFilters()
                     ->addFilter('html_entity_decode', [ENT_QUOTES, 'UTF-8'])
                     ->filter();
                $map = new Model\Map();
                $map->update($this->view->form->getFields());
                $this->view->id = $map->id;
                $this->sess->setRequestValue('saved', true);
                $this->redirect(BASE_PATH . APP_URI . '/maps/edit/' . $map->id);
            }
        }

        $this->send();
    }

    /**
     * Remove action method
     *
     * @return void
     */
    public function remove()
    {
        if ($this->request->isPost()) {
            $map = new Model\Map();
            $map->remove($this->request->getPost());
        }
        $this->sess->setRequestValue('removed', true);
        $this->redirect(BASE_PATH . APP_URI . '/maps');
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
