<?php

namespace Jtl\Shop4;

use Silex\Application as SilexApplication;

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

        // Load Silex ServiceControllerServiceProvider to support the colon-separated controller notation
        $this->register(new \Silex\Provider\ServiceControllerServiceProvider());

        // Register Shop4 backend
        $this->registerBackendServices();
    }

    private function registerConfigServices()
    {
        $this->register(new \Jtl\Shop4\Config\ServiceProvider());
    }

    private function registerBackendServices()
    {
        $this->mount('/admin', new \Jtl\Shop4\Backend\Provider\ControllerProvider());
    }
}
