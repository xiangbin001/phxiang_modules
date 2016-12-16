<?php
/**
 * Created by PhpStorm.
 * User: xiangbin
 * Date: 2016/11/5
 * Time: 16:36
 */

namespace Phxiang_modules\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

class NotFoundPlugin extends Plugin
{
    public function beforeException(Event $event, Dispatcher $dispatcher)
    {
        echo 'no resource';
        exit();
    }
}