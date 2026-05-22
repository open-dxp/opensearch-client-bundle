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
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.ch)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\OpenSearchClientBundle;

use OpenDxp\Bundle\OpenSearchClientBundle\DependencyInjection\OpenDxpOpenSearchClientExtension;
use OpenDxp\Extension\Bundle\AbstractOpenDxpBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class OpenDxpOpenSearchClientBundle extends AbstractOpenDxpBundle
{
    #[\Override]
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new OpenDxpOpenSearchClientExtension();
        }

        return $this->extension;
    }

    #[\Override]
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getJsPaths(): array
    {
        return [];
    }

    public function getCssPaths(): array
    {
        return [];
    }
}
