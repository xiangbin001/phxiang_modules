<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Events\Manager as EventsManager;

//setShared仅会被实例化一次，set只要用到就会实例化新的对象
/**
 * Registering a router
 */
$di->setShared('router', function () {
    $router = new Router();

    $router->setDefaultModule('frontend');
    $router->setDefaultNamespace('Phxiang_modules\Modules\Frontend\Controllers');

    return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
* Set the default namespace for dispatcher
*/
//调度器调度之前可以设置甚多的事件转发
$di->setShared('dispatcher', function() {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Phxiang_modules\Modules\Frontend\Controllers');

    //事件转发
    $eventsManager = new EventsManager();
    //http://www.myleftstudio.com/reference/dispatching.html
    $eventsManager->attach('dispatch:beforeExecuteRoute', new Phxiang_modules\Plugins\SecurityPlugin());
    $eventsManager->attach('dispatch:beforeException', new \Phxiang_modules\Plugins\NotFoundPlugin());
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

$di->setShared('modelsManager',function () {
    $manager = new Manager();
    return $manager;
});

$di->setShared('modelsManager',function () {
    $manager = new \stdClass();
    return $manager;
});