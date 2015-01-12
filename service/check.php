<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/11
 * Time: 19:54
 */
class Check
{
    public function limitLen($value, $lenUp = 0, $lenDn = 30, $description = '')
    {
        if (strlen($value) > $lenDn) {
            Err::CheckMsg("{$description}长度不能大于{$lenDn}");
        }
        if (strlen($value) < $lenUp) {
            Err::CheckMsg("{$description}长度不能小于{$lenUp}");
        }
        return $this;
    }
    public function notNull($value, $description = '')
    {
        if(is_null($value)){
            Err::CheckMsg("{$description}不能为空");
        }
        return $this;
    }
    public function isEmpty($value)
    {
        if(is_null($value) || strlen($value) == 0){
            return true;
        }
        return false;
    }

    private static $Default;
    public static function create(){
        if(!isset(self::$Default)){
            self::$Default = new Check();
        }
        return self::$Default;
    }

    private function __construct(){

    }
}