<?php

namespace Jtl\Shop4\Database;

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\ServiceProviderInterface;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $doctrineTypes = $this->generateDoctrineTypes($app);

        // Load DB config from configuration service and initialize Doctrine
        $app->register(new DoctrineOrmServiceProvider(), array(
            'doctrine_orm.entities_path' => APP_ROOT . '/src/Entity',
            'doctrine_orm.entities_namespace' => 'Jtl\Shop4\Entity',
            'doctrine_orm.proxies_path' => APP_ROOT . '/cache/proxies',
            'doctrine_orm.proxies_namespace' => 'Jtl\Shop4\Database\Proxies',
            'doctrine_orm.connection_parameters' => array(
                'driver' => $app['config']['database']['driver'],
                'host' => $app['config']['database']['host'],
                'user' => $app['config']['database']['user'],
                'dbname' => $app['config']['database']['database'],
                'password' => $app['config']['database']['password'],
                'charset' => $app['config']['database']['charset']
            )
        ));
    }

    private function generateDoctrineTypes(Application $app)
    {
        return array(
            // 'datetime' => '\Jtl\ConnectorLicense\DBAL\Types\UTCDateTimeType',
            // 'license_type' => '\Jtl\ConnectorLicense\DBAL\Types\LicenseTypeType'
        );
    }

    public function boot(Application $app)
    {
    }
}
