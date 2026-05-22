<?php
declare(strict_types=1);

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\OpenSearchClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @internal
 */
final class Configuration implements ConfigurationInterface
{
    public const string ROOT_NODE = 'opendxp_opensearch_client';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ROOT_NODE);

        $rootNode = $treeBuilder->getRootNode();
        $this->addOpenSearchClientConfiguration($rootNode);

        return $treeBuilder;
    }

    private function addOpenSearchClientConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->children()
                ->arrayNode('clients')
                    ->useAttributeAsKey('name')
                        ->prototype('scalar')
                    ->end()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('name')->end()
                            ->arrayNode('hosts')
                                ->prototype('scalar')->end()
                                ->defaultValue(['localhost:9200'])
                                ->info('List of opensearch hosts, including their ports')
                            ->end()
                            ->scalarNode('logger_channel')
                                ->defaultValue('opendxp.opensearch.default')
                                ->info('Logger channel to be used for opensearch client logs')
                            ->end()
                            ->booleanNode('log_404_errors')
                                ->info('Enables logging of 404 errors (default: false)')
                                ->defaultFalse()
                            ->end()
                            ->scalarNode('username')
                                ->defaultValue('admin')
                                ->info('Username for opensearch authentication')
                            ->end()
                            ->scalarNode('password')
                                ->defaultValue('admin')
                                ->info('Password for opensearch authentication')
                            ->end()
                            ->scalarNode('ssl_key')
                                ->info('Path to private SSL key file (.key)')
                            ->end()
                            ->scalarNode('ssl_cert')
                                ->info('Path to PEM formatted SSL cert file (.cert)')
                            ->end()
                            ->scalarNode('ssl_password')
                                ->info('If private key and certificate require a password (default: null)')
                            ->end()
                            ->booleanNode('ssl_verification')
                                ->info('Enable or disable the SSL verification (default: true)')
                            ->end()
                            ->scalarNode('aws_region')
                                 ->info('Will set the setSigV4Region()')
                            ->end()
                            ->scalarNode('aws_service')
                               ->info('Will set the setSigV4ServicesetSigV4Service()')
                            ->end()
                            ->scalarNode('aws_key')
                               ->info('Will set the setSigV4CredentialProvider() key')
                            ->end()
                            ->scalarNode('aws_secret')
                               ->info('Will set the setSigV4CredentialProvider() key')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
