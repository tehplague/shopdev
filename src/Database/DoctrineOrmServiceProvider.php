<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Francisco Javier Palma <palmasev@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author      Francisco Javier Palma <palmasev@gmail.com>,
 *              Christian Spoo <christian.spoo@jtl-software.com>
 * @copyright   2012 Francisco Javier Palma.
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://fjavierpalma.es
 */
namespace Jtl\Shop4\Database;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\DriverChain;

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
