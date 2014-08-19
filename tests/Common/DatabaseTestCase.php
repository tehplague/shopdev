<?php

namespace Jtl\Shop4\Tests\Common;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use MyDataFixtures\LoadUserData;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
abstract class DatabaseTestCase extends ApplicationTestCase
{
    private $loader;
    private $executor;

    protected abstract function getFixtures();

    public function createApplication()
    {
        $app = parent::createApplication();

        $fixtures = $this->getFixtures();

        $this->loader = new Loader();
        foreach ($fixtures as $fixture) {
            $this->loader->addFixture($fixture);
        }

        $purger = new ORMPurger();
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->executor = new ORMExecutor($app['doctrine_orm.em'], $purger);

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        $this->executor->execute($this->loader->getFixtures());
    }
}