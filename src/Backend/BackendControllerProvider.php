<?php

namespace Jtl\Shop4\Backend;

use Silex\Application;
use Silex\ControllerProviderInterface;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class BackendControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $app['shop4.backend.controllers.dashboard'] = new Controllers\DashboardController($app['backend.twig']);

        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'shop4.backend.controllers.dashboard:show');

        return $controllers;
    }   
}
