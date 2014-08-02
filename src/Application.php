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
    }
}
