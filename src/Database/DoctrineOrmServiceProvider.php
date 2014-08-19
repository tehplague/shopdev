<?php

namespace Jtl\Shop4\Database;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\DriverChain;

/**
 * Doctrine ORM service provider capable of loading Gedmo Doctrine extensions
 * 
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class DoctrineOrmServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['doctrine_orm.configuration'] = $app->share(function($app) {
            if ($app['debug'] === true) {
                $cache = new \Doctrine\Common\Cache\ArrayCache();
            }
            else {
                $cache = new \Doctrine\Common\Cache\ArrayCache();
            }

            $config = new Configuration();
            $config->setMetadataCacheImpl($cache);

            $driverChain = new DriverChain();
            \Gedmo\DoctrineExtensions::registerMappingIntoDriverChainORM(
                $driverChain
            );

            $driverImpl = $config->newDefaultAnnotationDriver($app['doctrine_orm.entities_path'], false);
            $driverChain->addDriver($driverImpl, $app['doctrine_orm.entities_namespace']);
            $config->setMetadataDriverImpl($driverChain);

            $config->setQueryCacheImpl($cache);
            $config->setProxyDir($app['doctrine_orm.proxies_path']);
            $config->setProxyNamespace($app['doctrine_orm.proxies_namespace']);

            \Doctrine\ORM\Proxy\Autoloader::register(
                $app['doctrine_orm.proxies_path'],
                $app['doctrine_orm.proxies_namespace']
            );

            if ($app['debug'] === true) {
                $config->setAutogenerateProxyClasses(true);
            }
            else {
                $config->setAutogenerateProxyClasses(false);
            }

            return $config;
        });

        $app['doctrine_orm.em'] = $app->share(function($app) {
            return EntityManager::create(
                $app['doctrine_orm.connection_parameters'],
                $app['doctrine_orm.configuration']
            );
        });
    }

    public function boot(Application $app) {
        
    }
}
