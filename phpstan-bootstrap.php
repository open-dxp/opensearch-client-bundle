<?php
use OpenDxp\Bootstrap;
use OpenDxp\Model\Exception\NotFoundException;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    define('OPENDXP_PROJECT_ROOT', __DIR__);
} elseif (file_exists(__DIR__ . '/../../../vendor/autoload.php')) {
    define('OPENDXP_PROJECT_ROOT', __DIR__ . '/../../..');
} elseif (getenv('OPENDXP_PROJECT_ROOT')) {
    define('OPENDXP_PROJECT_ROOT', getenv('OPENDXP_PROJECT_ROOT'));
} else {
    throw new NotFoundException(
        'Unknown configuration! OpenDxp project root not found, please set env variable OPENDXP_PROJECT_ROOT.'
    );
}

include_once OPENDXP_PROJECT_ROOT . '/vendor/autoload.php';
Bootstrap::setProjectRoot();
Bootstrap::bootstrap();

if (!defined('OPENDXP_TEST')) {
    define('OPENDXP_TEST', true);
}
