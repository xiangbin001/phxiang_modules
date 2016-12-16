<?php
/**
 * Created by PhpStorm.
 * User: xiangbin
 * Date: 2016/11/5
 * Time: 9:05
 */

namespace Phxiang_modules\Modules\Frontend\Models;

use Phalcon\Mvc\Model;

class UserAddress extends Model
{

    public function initialize()
    {
        $this->hasOne("uid", "Phxiang_modules\\Modules\\Frontend\\Models\\User", "id", ['alias' => 'user']);
    }
}