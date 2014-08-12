<?php

namespace Jtl\Shop4\Backend;

use Silex\Application;
use Silex\ServiceProviderInterface;

use Jtl\Shop4\Backend\Provider\ControllerProvider;
use Jtl\Shop4\Backend\BackendService;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers configuration services on the given application
     * @param  Application $app The shop4 application
     * @return [type]           [description]
     */
    public function register(Application $app)
    {
        // TODO: Determine the backend path by configuration
        $app->mount('/admin', new ControllerProvider());

        $app['shop4.backend'] = $app->share(function() {
            return new BackendService();
        });
    }

    public function boot(Application $app)
    {

    }
}
