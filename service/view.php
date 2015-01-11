<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/8
 * Time: 21:47
 */

class View_Manager {
    private static $isInit = false;

    public static function create($param = ''){
        if(self::$isInit){
        }
        elseif(JFUN::load_sys_func(Config::$view_extend)){
            self::$isInit = true;
        }
        elseif (JFUN::load_ext_func(Config::$view_extend)) {
            self::$isInit = true;
        }
        else{
            die('no db connect');
        }
        return self::View($param);
    }

    private static function View($param){
        if(Config::$view_extend == 'dbview'){
            return new DbView($param);
        }
        return new DbView($param);
    }
}