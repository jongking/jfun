<?php
class Db_factory{
	private static $isinit = false;

	public static function create(){
		if(self::$isinit){
			return new JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		elseif(JFUN::load_sys_func(Config::$db_type)){
			self::$isinit = true;
			return new JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		elseif (JFUN::load_ext_func(Config::$db_type)) {
			self::$isinit = true;
			return new JDB(Config::$db_type, Config::$db_host, Config::$db_dbname, Config::$db_username, Config::$db_userpwd);
		}
		else{
			echo 'no db connect';
		}
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