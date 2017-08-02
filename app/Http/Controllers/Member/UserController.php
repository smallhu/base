<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;

class UserController extends Controller
{
    /**
     * 展示给定用户的信息
     */
    public function info()
    {
        $rtnList = [];
        $rtnList['code'] = '000';
        $rtnList['desc'] = '数据获取成功！';
//        $userList = UserService::getIdValue();
        $userList = UserService::info();
        $rtnList['list'] = $userList;
        return json_encode($rtnList);
    }
}