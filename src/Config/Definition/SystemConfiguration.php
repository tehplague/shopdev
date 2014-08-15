<?php

namespace Jtl\Shop4\Config\Definition;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class SystemConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('config');
        $rootNode
            ->children()
                ->arrayNode('database')
                    ->children()
                        ->scalarNode('driver')
                            ->isRequired()
                            ->validate()
                            ->ifNotInArray(array('pdo_mysql'))
                                ->thenInvalid('Invalid database driver "%s"')
                            ->end()
                        ->end()

                        ->scalarNode('host')
                            ->defaultValue('localhost')
                        ->end()

                        ->scalarNode('port')
                        ->end()

                        ->scalarNode('user')
                        ->end()

                        ->scalarNode('password')
                        ->end()

                        ->scalarNode('database')
                        ->end()

                        ->scalarNode('charset')
                            ->defaultValue('utf8')
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('redis')
                    ->treatFalseLike(array('enabled' => false))
                    ->treatTrueLike(array('enabled' => true))
                    ->treatNullLike(array('enabled' => false))
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultFalse()
                        ->end()

                        ->scalarNode('socket')
                        ->end()

                        ->scalarNode('host')
                        ->end()

                        ->scalarNode('port')
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('debug')
                    ->treatFalseLike(array('enabled' => false))
                    ->treatTrueLike(array('enabled' => true))
                    ->treatNullLike(array('enabled' => false))
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
