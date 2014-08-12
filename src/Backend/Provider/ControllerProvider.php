<?php

namespace Jtl\Shop4\Backend\Provider;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
{
    /**
     * Registers Backend controllers and routes at the application
     * @param  Application $app The Shop4 application
     * @return ControllerCollection           A collection of controllers that make up the Shop4 backend
     */
    public function connect(Application $app)
    {
        $app['shop4.backend.controllers'] = $app['controllers_factory'];

        // Register backend controllers as services
        $this->registerControllers($app);

        // Register backend routes
        $app['shop4.backend.controllers']->get('/login', 'shop4.backend.controllers.auth.login:showLogin');
        $app['shop4.backend.controllers']->post('/login', 'shop4.backend.controllers.auth.login:processLogin');

        return $app['shop4.backend.controllers'];
    }

    /**
     * Register backend controllers
     * @param  Application $app The Shop4 application
     * @return [type]           [description]
     */
    private function registerControllers(Application $app)
    {
        $app['shop4.backend.controllers.auth.login'] = $app->share(function() use ($app) {
            return new \Jtl\Shop4\Backend\Controller\Auth\LoginController();
        });
    }

    private function registerRoutes(ControllerCollection $controllers)
    {
    }
}

