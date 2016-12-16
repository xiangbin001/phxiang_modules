<?php
namespace Phxiang_modules\Modules\Frontend\Models;

use \Phalcon\Mvc\Model;

class User extends Model
{
    public function getSource()
    {
        return 'user';
    }

    public function initialize()
    {
        $this->useDynamicUpdate(true);
        //resuable为缓存
        $this->hasOne("id", '\Phxiang_modules\Modules\Frontend\Models\UserInfo', 'uid', ['alias' => 'userinfo','resuable'=>true]);
        $this->hasMany("id", '\Phxiang_modules\Modules\Frontend\Models\UserAddress', 'uid', ['alias' => 'useraddress']);
    }
}