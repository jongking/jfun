<?php
class Config{
	//语言
	public static $lan = 'zh-cn';
	//编码
	public static $encode = 'utf-8';

	//数据库类型
	public static $db_type = 'mysql';
	//数据库地址
	public static $db_host = 'localhost';
	//数据库名称
	public static $db_dbname = 'jfun';
	//数据库用户名
	public static $db_username = 'root';
	//数据库密码
	public static $db_userpwd = 'sssaaa';

	//获取dsn
	public static function dsn(){
		return self::$db_type.':host='.self::$db_host.';dbname='.self::$db_dbname;
	}
}