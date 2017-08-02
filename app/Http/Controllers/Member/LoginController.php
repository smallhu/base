<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Services\User\ApiAccountService;
use Illuminate\Http\Request;
use App\Http\Services\ToolBox\CheckService;

class LoginController extends Controller{

    /*
     * 登录接口
     * @param account string 登录名 可以为手机号 邮箱 普通账号(英文加数字)
     * @param password string 密码
     * @param channel_id string 渠道ID
     * return JSON rtnList
     * rtnList['backCode'] string 返回状态码
     * rtnList['backDesc'] string 返回描述
     */
    public function login(Request $request){
        //1.接收参数
        $params = [];
        //登录名
        $params['account'] = $request->input('account');
        //密码
        $params['password'] = $request->input('password');
        //渠道ID
        $params['channel_id'] = $request->input('channel_id');

        //2.验证参数
        if(CheckService::isNullOrEmpty($params['account'])
            || CheckService::isNullOrEmpty($params['password'])
            || CheckService::isNullOrEmpty($params['channel_id'])){
            $rtnList = [];
            $rtnList['backCode'] = 'A001';
            $rtnList['backDesc'] = '参数有误';
            return json_encode($rtnList);
        }
        $where = [];
        //3.拼装查询条件
        if(CheckService::isMobile($params['account'])){
            //判断是否为手机号
            $where[] = ['phone','=',$params['account']];
        }else if(CheckService::isEmail($params['account'])){
            //判断是否为邮箱
            $where[] = ['email','=',$params['account']];
        }else{
            //普通账号
            $where[] = ['account','=',$params['account']];
        }
        //密码
        $whereIn = [];
        $whereIn['password'] = [md5($params['password']),md5(md5($params['password']))];
        $params = [];
        $params['where'] = $where;
        $params['whereIn'] = $whereIn;
        //4.获取用户记录
        $userBasic = ApiAccountService::selectOneByParams($params);
        if(empty($userBasic)){
            $rtnList = [];
            $rtnList['backCode'] = 'A004';
            $rtnList['backDesc'] = '账号或者密码错误!';
            return json_encode($rtnList);
        }
        //5.生成token，修改登录时间
        $saveData['token'] = md5(uniqid(mt_rand(), true));
        $newTime = time();
        $saveData['last_login_time'] = date('Y-m-d H:i:s',$newTime);
        $saveData['token_time'] = $newTime + 3600 * 3;
        $saveData['id'] = $userBasic['id'];
        $modifyBasic = ApiAccountService::modifyBasic($saveData);
        $rtnList = [];
        $rtnList['backCode'] = '000';
        $rtnList['backDesc'] = '获取数据成功!';
        $rtnList['data'] = $modifyBasic;
        return json_encode($rtnList);
    }
}