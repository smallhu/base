<?php
namespace App\Http\Services;

class BaseService{
    /*
     *新增记录
     */
    public static function addBasic($params){
        $dao = self::getDao();
        return $dao::addBasic($params);
    }

    /*
     *修改记录
     */
    public static function modifyBasic($params){
        $dao = self::getDao();
        return $dao::modifyBasic($params);
    }

    /*
     *通过主键获取记录
     */
    public static function findObjByKey($id){
        $dao = self::getDao();
        return $dao::selectByPrimaryKey($id);
    }

    /*
     *通过条件获取一条记录
     */
    public static function selectOneByParams($params){
        $dao = self::getDao();
        return $dao::selectOneByParams($params);
    }

    /*
     *通过条件获取记录总数
     */
    public static function findCountByParams($params){
        $dao = self::getDao();
        return $dao::selectCountByParams($params);
    }

    /*
     *通过条件获取列表
     */
    public static function findListByParams(){
        $dao = self::getDao();
        return $dao::findListByParams();
    }

    /*
     *通过条件获取分页记录列表
     */
    public static function findListPageByParams($params){
        //Todo findListPageByParams
    }

    protected static function getDao(){
        $serviceName = get_called_class();
        $serviceList = explode('\\',$serviceName);
        $daoName = 'App\Http\Dao\\'.substr(end($serviceList),0,-7) . 'Dao';
        return new $daoName();
    }
}