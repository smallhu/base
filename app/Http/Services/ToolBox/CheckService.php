<?php

namespace App\Http\Services\ToolBox;

class CheckService{

    /*
     *检测字符串是否为空
     */
    public static function isNullOrEmpty($str){
        if($str === 0 || trim($str) === '0' || trim($str) !== ''){
            return false;
        }
        if(!is_null(trim($str)) && !empty(trim($str))){
            return false;
        }
        return true;
    }

    /*
     *邮箱验证
     */
    public static function isEmail($str){
        if(preg_match("/^[_.0-9a-z-a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/", trim($str))){
            return true;
        }
        return false;
    }

    /*
     *检测手机号
     */
    public static function isMobile($str){
        if(preg_match('/^((13[0-9])|(15[0-9])|(18[0-9])|(14[5,7])|(17[0,6-8]))\\d{8}$/', trim($str))){
            return true;
        }
        return false;
    }

    /*
     *检测整数
     */
    public static function isInt($str){
        if(preg_match('/^-?\d+$/', trim($str))){
            return true;
        }
        return false;
    }
}