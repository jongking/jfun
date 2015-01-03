<?php
class Db_factory{
	private static $isinit = false;
	private static $defaultDb;

	public static function DefaultDb(){
		if(!isset(self::$defaultDb)){
			self::$defaultDb = self::create();
		}
		return self::$defaultDb;
	}

	public static function create(){
		if(self::$isinit){
			return self::JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		elseif(JFUN::load_sys_func(Config::$db_type)){
			self::$isinit = true;
			return self::JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		elseif (JFUN::load_ext_func(Config::$db_type)) {
			self::$isinit = true;
			return self::JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		else{
			die('no db connect');
		}
	}

	private static function JDB($db_type, $db_host, $db_dbname, $db_username, $db_userpwd){
		return new JDB($db_type, $db_host, $db_dbname, $db_username, $db_userpwd);
	}
}

abstract class AbstractDB{
 	// 强制要求子类定义这些方法
    abstract protected function init($db_type, $db_host, $db_dbname, $db_username, $db_userpwd);
    abstract public function close();
    abstract public function query($sql);
    abstract public function exec($sql);
	abstract public function beginTransaction();
	abstract public function commit();
	abstract public function rollBack();
	
    // 普通方法（非抽象方法）
    public function __construct($db_type, $db_host, $db_dbname, $db_username, $db_userpwd) {
		$this->init($db_type, $db_host, $db_dbname, $db_username, $db_userpwd);
	}
	/**
	 * 析构函数
	 */
	public function __destruct() {
		$this->close();
	}
}