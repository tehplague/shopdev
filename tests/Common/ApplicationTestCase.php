<?php

namespace Jtl\Shop4\Tests\Common;

use Silex\WebTestCase;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
abstract class ApplicationTestCase extends WebTestCase
{
    /**
     * Creates a Shop4 application object and enables debugging facilities
     * @return Jtl\Shop4\Application A new Shop4 application object
     */
    public function createApplication()
    {
        $app = require(APP_ROOT . '/app/bootstrap.php');

        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }
}
