<?php

namespace Jtl\Shop4\Tests\Application;

use Jtl\Shop4\Tests\Common\TestCase;

class ContainerTest extends TestCase
{
    public function testInstantiation()
    {
        $app = $this->createApplication();

        // Asserts successful instance creation
        $this->assertInstanceOf('\Jtl\Shop4\Application', $app);

        // Assert, that the application object derives from a Silex application
        $this->assertInstanceOf('\Silex\Application', $app);

        // Test whether debug mode is enabled
        $this->assertTrue($app['debug']);
    }
}
