<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Phxiang_modules\Models' => APP_PATH . '/common/models/',
    'Phxiang_modules'        => APP_PATH . '/common/library/',
    'Phxiang_modules\Plugins'=> APP_PATH . '/plugins',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Phxiang_modules\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Phxiang_modules\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php',
]);

$loader->register();
