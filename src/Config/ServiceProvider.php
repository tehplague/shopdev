<?php

namespace Jtl\Shop4\Config;

use Silex\Application;
use Silex\ServiceProviderInterface;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;

use Jtl\Shop4\Config\Definition\SystemConfiguration;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers configuration services on the given application
     * @param  Application $app The shop4 application
     * @return [type]           [description]
     */
    public function register(Application $app)
    {
        $this->loadConfiguration($app);
    }

    public function boot(Application $app)
    {

    }

    private function loadConfiguration(Application $app)
    {
        $yaml = file_get_contents(APP_ROOT . '/config/config.yml');
        $parsedYaml = Yaml::parse($yaml);

        $processor = new Processor();
        $definition = new SystemConfiguration();

        $app['config'] = $processor->processConfiguration(
            $definition,
            array($parsedYaml)
        );
    }
}
