<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace OpenDxp\Bundle\OpenSearchClientBundle\DependencyInjection;

use Exception;

use OpenSearch\Client;
use OpenDxp\Bundle\OpenSearchClientBundle\OpenSearchClientFactory;
use OpenDxp\Bundle\OpenSearchClientBundle\SearchClient\SearchClient;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @internal
 */
final class OpenDxpOpenSearchClientExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    const string CLIENT_SERVICE_PREFIX = 'opendxp.open_search_client.';

    const string OPENDXP_CLIENT_PREFIX = 'opendxp.openSearch.custom_client.';

    public function getAlias(): string
    {
        return 'opendxp_opensearch_client';
    }

    /**
     *
     *
     * @throws Exception
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        foreach ($mergedConfig['clients'] as $clientName => $clientConfig) {
            $definition = new Definition(Client::class);
            $definition->setFactory([OpenSearchClientFactory::class, 'createOpenSearchClient']);
            $definition->setArgument('$logger', new Reference('logger'));
            $definition->setArgument('$config', $clientConfig);
            $definition->addTag('monolog.logger', ['channel' => $clientConfig['logger_channel']]);
            $definition->setPublic(true);
            $container->setDefinition(self::CLIENT_SERVICE_PREFIX . $clientName, $definition);

            $customClientDefinition = new Definition(SearchClient::class);
            $customClientDefinition->setArgument('$client', $definition);
            $customClientDefinition->setPublic(true);
            $container->setDefinition(self::OPENDXP_CLIENT_PREFIX . $clientName, $customClientDefinition);
        }
    }

    /**
     * @throws Exception
     */
    public function prepend(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('default_config.yaml');
    }
}
