<?php

namespace Phire\Maps\Event;

use Phire\Maps\Model;
use Phire\Controller\AbstractController;
use Pop\Application;

class Maps
{

    /**
     * Init maps model
     *
     * @param  AbstractController $controller
     * @param  Application        $application
     * @return void
     */
    public static function init(AbstractController $controller, Application $application)
    {
        if ((!$_POST) && ($controller->hasView()) && (($controller instanceof \Phire\Content\Controller\IndexController) || ($controller instanceof \Phire\Categories\Controller\IndexController))) {
            $controller->view()->phire->maps = new Model\Maps();
        }
    }

    /**
     * Parse maps navigation
     *
     * @param  AbstractController $controller
     * @param  Application        $application
     * @return void
     */
    public static function parse(AbstractController $controller, Application $application)
    {
        if (($controller->hasView()) && (($controller instanceof \Phire\Content\Controller\IndexController) || ($controller instanceof \Phire\Categories\Controller\IndexController))) {

        }
    }

}
