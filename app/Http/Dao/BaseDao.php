<?php
namespace App\Http\Dao;

class BaseDao{
    /*
     * 物理删除记录
     * @param $id
     * @return
     */
    public static function deleteByPrimaryKey($id){
        $model = self::getModel();
        return $model->destroy($id);
    }

    /*
     * 物理删除记录
     * @param $ids
     * @return
     */
    public static function deleteByIdList($Ids){
        $model = self::getModel();
        return $model->destroy($Ids);
    }

    /*
     *新增记录
     */
    public static function addBasic($params){
        $model = self::getModel();
        foreach ($params as $column => $value){
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /*
     * 更新记录
     */
    public static function modifyBasic($params){
        $model = self::getModel();
        $model = $model->find($params['id']);
        unset($params['id']);
        foreach ($params as $column => $value){
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /*
     * 根据主键 返回记录
     * @param seq
     * @return
     */
    public static function selectByPrimaryKey($id){
        $model = self::getModel();
        return $model->find($id);
    }

    /*
     * 根据 条件返回记录
     * @param params
     * @return
     */
    public static function selectByParams($params){
        $model = self::getModel();
        if(isset($params['where'])){
            $model = $model->where($params['where']);
        }
        if(isset($params['whereIn'])){
            foreach ($params['whereIn'] as $key => $item){
                $model = $model->whereIn($key,$item);
            }
        }
        return $model->first();
    }

    /*
     * 查询 符合条件的记录总数
     * @param params
     * @return
     */
    public static function selectCountByParams($params){
        $model = self::getModel();
        if(isset($params['where'])){
            $model = $model->where($params['where']);
        }
        if(isset($params['whereIn'])){
            foreach ($params['whereIn'] as $key => $item){
                $model = $model->whereIn($key,$item);
            }
        }
        return $model->count();
    }


    /*
     * 分页查询 记录，分页条件为null，返回所有
     * @param params 查询条件
     * @param pageOffset 开始游标
     * @param pageSize 每页显示的数量
     * @param orderParam 排序参数
     * @return
     */
    public static function selectListByParams(){

    }

    /*
     * 获取一个..注意,这个方法大多数的子类都没有实现过
     * @param params
     * @return
     */
    public static function selectOneByParams($params){
        $model = self::getModel();
        if(isset($params['where'])){
            $model = $model->where($params['where']);
        }
        if(isset($params['whereIn'])){
            foreach ($params['whereIn'] as $key => $item){
                $model = $model->whereIn($key,$item);
            }
        }
        return $model->first();
    }

    protected static function getModel(){
        $daoName = get_called_class();
        $pathList = explode('\\',$daoName);
        $modelName = 'App\Models\\'.substr(end($pathList),0,-3);
        return new $modelName();
    }

}