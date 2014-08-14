<?php

namespace Jtl\Shop4\Database;

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\ServiceProviderInterface;

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $doctrineMappings = $this->generateDoctrineMappings($app);
        $doctrineTypes = $this->generateDoctrineTypes($app);

        // Load DB config from configuration service and initialize Doctrine
        $app->register(new DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver' => $app['shop4.config']['database']['driver'],
                'host' => $app['shop4.config']['database']['host'],
                'user' => $app['shop4.config']['database']['user'],
                'dbname' => $app['shop4.config']['database']['database'],
                'password' => $app['shop4.config']['database']['password'],
                'charset' => $app['shop4.config']['database']['charset']
            )
        ));

        $app->register(new DoctrineOrmServiceProvider(), array(
            // 'orm.proxies_dir' => APP_ROOT . '/cache/orm',
            'orm.em.options' => array(
                // 'default_cache' => 'apc',
                'mappings' => $doctrineMappings,
                'types' => $doctrineTypes
            )
        ));
    }

    private function generateDoctrineMappings(Application $app)
    {
        return array(
            array(
                'type' => 'annotation',
                'use_simple_annotation_reader' => false,
                'namespace' => 'Jtl\Shop4\Entity',
                'path' => APP_ROOT . '/src/Entity'
            )
        );
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
