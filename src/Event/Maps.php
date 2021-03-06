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
namespace Phire\Maps\Event;

use Phire\Maps\Model;
use Phire\Controller\AbstractController;
use Pop\Application;

/**
 * Maps Event class
 *
 * @category   Phire\Maps
 * @package    Phire\Maps
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 * @version    1.0.0
 */
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
            $controller->view()->phire->map = new Model\Map();
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
        if (($controller->hasView()) &&
            (($controller instanceof \Phire\Content\Controller\IndexController) ||
                ($controller instanceof \Phire\Categories\Controller\IndexController))) {
            $body = $controller->response()->getBody();
            if (strpos($body, '[{map_') !== false) {
                $ids = self::parseMapIds($body);
                if (count($ids) > 0) {
                    $map = new Model\Map();
                    foreach ($ids as $id) {
                        $body = str_replace('[{map_' . $id . '}]', $map->getMap($id), $body);
                    }
                }

                $controller->response()->setBody($body);
            }
        }
    }


    /**
     * Parse map IDs from template
     *
     * @param  string $template
     * @return array
     */
    protected static function parseMapIds($template)
    {
        $ids  = [];
        $maps = [];

        preg_match_all('/\[\{map_.*\}\]/', $template, $maps);

        if (isset($maps[0]) && isset($maps[0][0])) {
            foreach ($maps[0] as $map) {
                $ids[] = str_replace('}]', '', substr($map, (strpos($map, '_') + 1)));
            }
        }

        return $ids;
    }

}
