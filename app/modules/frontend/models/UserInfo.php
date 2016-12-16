<?php
namespace Phxiang_modules\Modules\Frontend\Models;

use \Phalcon\Mvc\Model;

class UserInfo extends Model
{
    public $id;

    public $uid;

    public $address;

    public $token;

    public function initialize()
    {
        $this->belongsTo("uid", "Phxiang_modules\\Modules\\Frontend\\Models\\User", "id", [ 'alias' => 'user']);
    }
}