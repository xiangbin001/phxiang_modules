<?php
/**
 * Created by PhpStorm.
 * User: xiangbin
 * Date: 2016/11/5
 * Time: 16:18
 */

namespace Phxiang_modules\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phxiang_modules\Modules\Frontend\Models\User;

class SessionController extends Controller
{

    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            array(
                'id' => $user->id,
                'name' => $user->name
            )
        );
    }

    public function startAction()
    {
        if ($this->request->isPost()) {

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            //@todo 用户密码验证需要修复
            $user = User::findFirst(
                array(
                    "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                    'bind' => array(
                        'email'    => $email,
                        'password' => sha1($password)
                    )
                )
            );

            if ($user != false) {

                $this->_registerSession($user);

                $this->flash->success('Welcome ' . $user->name);

                return $this->dispatcher->forward(
                    array(
                        'controller' => 'invoices',
                        'action'     => 'index'
                    )
                );
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->dispatcher->forward(
            array(
                'controller' => 'session',
                'action'     => 'index'
            )
        );
    }

}