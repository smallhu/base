<?php

namespace App\Http\Dao;

use Illuminate\Support\Facades\DB;

class UserDao extends BaseDao
{
    /**
     * 展示给定用户的信息
     */
    public static function info()
    {
        $userList = DB::select('select * from py_user limit 1,10');
        return $userList;
    }
}