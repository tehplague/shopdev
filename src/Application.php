<?php

namespace Jtl\Shop4;

use Silex\Application as SilexApplication;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class Application extends SilexApplication
{
    /**
     * Instantiate a new Shop4 application. Objects and parameters can be passed as argument to the constructor
     * @param array $values The parameters or objects.
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        // Enable Silex debugging for the purpose of development
        $this['debug'] = true;

        // Initialize Shop4 configuration services
        $this->registerConfigServices();

        // Initialize database
        $this->registerDatabaseService();

        // Initialize Shop4 backend services
        $this->registerBackendServices();
    }

    private function registerConfigServices()
    {
        $this->register(new \Jtl\Shop4\Config\ServiceProvider());
    }

    private function registerDatabaseService()
    {
        $this->register(new \Jtl\Shop4\Database\ServiceProvider());
    }

    private function registerBackendServices()
    {
        $this['backend.auth'] = new \Jtl\Shop4\Backend\Services\BackendAuthService($this['orm.em']);
    }
}
