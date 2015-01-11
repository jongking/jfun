<?php
/**
 * Created by PhpStorm.
 * User: jongking
 * Date: 2014/12/30
 * Time: 22:20
 */
class Model_Manager {
    private static $isInit = false;

    public static function create($modelName, $param = ''){
        if(self::$isInit){
        }
        elseif(JFUN::load_sys_func(Config::$model_extend)){
            self::$isInit = true;
        }
        elseif (JFUN::load_ext_func(Config::$model_extend)) {
            self::$isInit = true;
        }
        else{
            die('no db connect');
        }
        return self::Model($modelName, $param);
    }

    private static function Model($modelName, $param){
        if(Config::$model_extend == 'dbmodel'){
            return new DbModel($modelName, $param);
        }
        return new DbModel($modelName, $param);
    }

    public static function nullModel(){
        return self::create('');
    }
}