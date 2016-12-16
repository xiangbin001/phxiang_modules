<?php
namespace Phxiang_modules\Modules\Frontend;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            "Phxiang_modules\\Modules\\Frontend\\Controllers" => __DIR__ . '/controllers/',
            "Phxiang_modules\\Modules\\Frontend\\Models" => __DIR__ . '/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                // '.volt'  => 'voltShared',
                '.volt' => function ($view) {
                    $config = $this->getConfig();

                    $volt = new VoltEngine($view, $this);

                    $volt->setOptions([
                        'compiledPath' => $config->application->cacheDir .'volt/',
                        'compiledExtension' => '.php',
//                        'compileAlways'     => false,//Tell Volt if the templates must be compiled in each request or only when they change
                        'compiledSeparator' => '_'
                    ]);


                    $compiler = $volt->getCompiler();
                    $compiler->addFilter('floor', 'floor');
                    $compiler->addFunction('range', 'range');

                    return $volt;
                },
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });
    }
}
