<?php

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

define('OPENDXP_PROJECT_ROOT', dirname(__DIR__));

const PROJECT_ROOT = OPENDXP_PROJECT_ROOT;

// set the used pimcore/symfony environment
foreach (['APP_ENV' => 'test', 'OPENDXP_SKIP_DOTENV_FILE' => true] as $name => $value) {
    putenv("{$name}={$value}");
    $_ENV[$name] = $_SERVER[$name] = $value;
}
require_once OPENDXP_PROJECT_ROOT . '/vendor/autoload.php';

\OpenDxp\Bootstrap::setProjectRoot();
\OpenDxp\Bootstrap::bootstrap();
