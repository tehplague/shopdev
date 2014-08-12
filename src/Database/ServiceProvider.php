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

        $app->register(new DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'user' => 'cspoo',
                'dbname' => 'cspoo_shopdev',
                'password' => 'KzbH3fnBtEMxh6TQ',
                'charset' => 'utf8'
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
