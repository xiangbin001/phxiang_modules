<?php

namespace Phxiang_modules\Plugins;

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;

class SecurityPlugin extends Plugin
{
    // ...

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {

//        执行之前
//        $this->flash->error("You don't have access to this module");
//        $this->flash->output();
//
//exit()        ;$acl = new AclList();
//        $acl->setDefaultAction(Acl::DENY);
//        $roles = array(
//            'users'  => new Role('Users'),
//            'guests' => new Role('Guests')
//        );
//
//        foreach ($roles as $role) {
//            $acl->addRole($role);
//        }
//
//
//
//
//
//
//
//        $auth = $this->session->get('auth');
//        if (!$auth) {
//            $role = 'Guests';
//        } else {
//            $role = 'Users';
//        }
//
//        // Take the active controller/action from the dispatcher
//        $controller = $dispatcher->getControllerName();
//        $action = $dispatcher->getActionName();
//
//        // Obtain the ACL list
//        $acl = $this->getAcl();
//
//        // Check if the Role have access to the controller (resource)
//        $allowed = $acl->isAllowed($role, $controller, $action);
//        if ($allowed != Acl::ALLOW) {
//
//            // If he doesn't have access forward him to the index controller
//            $this->flash->error("You don't have access to this module");
//            $dispatcher->forward(
//                array(
//                    'controller' => 'index',
//                    'action'     => 'index'
//                )
//            );
//
//            // Returning "false" we tell to the dispatcher to stop the current operation
//            return false;
//        }
    }
}