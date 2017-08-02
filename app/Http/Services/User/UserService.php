<?php

namespace App\Http\Services\User;

use App\Http\Dao\UserDao;
use App\Http\Services\BaseService;

class UserService extends BaseService
{

    public static function info()
    {
        return UserDao::info();
    }

}