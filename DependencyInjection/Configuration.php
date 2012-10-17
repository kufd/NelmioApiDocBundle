<?php

/*
 * This file is part of the NelmioApiDocBundle.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\ApiDocBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder
            ->root('nelmio_api_doc')
            ->children()
                ->scalarNode('name')->defaultValue('API documentation')->end()
                ->arrayNode('sandbox')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('enabled')->defaultTrue()->end()
                        ->scalarNode('endpoint')->defaultValue('/app_dev.php')->end()
                        ->enumNode('json_declaration_method')
                            ->values(array('format_param', 'accept_header'))
                            ->defaultValue('format_param')
                        ->end()
                        ->arrayNode('authentication')
                            ->children()
                                ->scalarNode('name')->isRequired()->end()
                                ->enumNode('delivery')
                                    // header|query|request, but only query is implemented for now
                                    ->values(array('query'))
                                    ->isRequired()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
