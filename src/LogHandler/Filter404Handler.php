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

namespace OpenDxp\Bundle\OpenSearchClientBundle\LogHandler;

use Monolog\Handler\AbstractHandler;
use Monolog\Level;
use Monolog\LogRecord;

/**
 * Ignores warning messages for 404 errors as they are spamming the logs
 *
 * @internal
 */
final class Filter404Handler extends AbstractHandler
{
    private bool $ignoreNextResponseWarning = false;

    public function isHandling(LogRecord $record): bool
    {
        $ignore =
            $record->level === Level::Warning
            && ($record->context['HTTP code'] ?? null) === 404;
        if ($ignore) {
            $this->ignoreNextResponseWarning = true;
        } else {
            $ignore = $this->ignoreNextResponseWarning
                && $record->level === Level::Warning
                && $record->message === 'Response';
            $this->ignoreNextResponseWarning = false;
        }

        return $ignore;
    }

    public function handle(LogRecord $record): bool
    {
        return $this->isHandling($record);
    }
}
