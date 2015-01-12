<?php

class Config
{
    //语言
    public static $lan = 'zh-cn';
    //编码
    public static $encode = 'utf-8';
    //数据库类型
    public static $db_type = 'mssql';
    //数据库地址
    public static $db_host = '.\\sqlexpress';
    //数据库名称
    public static $db_dbname = 'jfun';
    //数据库用户名
    public static $db_username = 'sa';
    //数据库密码
    public static $db_userpwd = '123';

    //model的实现类
    public static $model_extend = 'dbmodel';
    //view的实现类
    public static $view_extend = 'dbview';

    public static $urlRule = array();

    //设置语言
    public static function setLanguage($language)
    {
        self::$lan = $language;
    }

    //设置路由规则
    public static function setUrlRule(array$urlRule)
    {
        self::$urlRule = $urlRule;
    }

    //设置编码
    public static function setEncode($encode)
    {
        self::$encode = $encode;
    }

    //设置数据库参数
    public static function setDBConfig($type, $host, $dbname, $username, $userpwd)
    {
        //数据库类型
        self::$db_type = $type;
        //数据库地址
        self::$db_host = $host;
        //数据库名称
        self::$db_dbname = $dbname;
        //数据库用户名
        self::$db_username = $username;
        //数据库密码
        self::$db_userpwd = $userpwd;
    }

    //获取dsn
    public static function dsn()
    {
        return self::$db_type . ':host=' . self::$db_host . ';dbname=' . self::$db_dbname;
    }
}