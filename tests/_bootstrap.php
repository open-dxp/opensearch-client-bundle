<?php

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
