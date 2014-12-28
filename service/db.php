<?php
class Db_factory{
	private static $isinit = false;

	public static function create(){
		if($isinit){
			return new JDB();
		}
		elseif(JFUN::load_sys_func(Config::$db_type)){
			$isinit = true;
			return new JDB();
		}
		elseif (JFUN::load_ext_func(Config::$db_type)) {
			$isinit = true;
			return new JDB();
		}
		else{
			echo 'no db connect';
		}
	}
}

abstract class AbstractDB{
 	// 强制要求子类定义这些方法
    abstract protected function init();
    abstract public function close();
    abstract public function query($sql);
    abstract public function exec($sql);
	abstract public function beginTransaction();
	abstract public function commit();
	abstract public function rollBack();
	
    // 普通方法（非抽象方法）
    public function __construct() {
		$this->init();
	}
	/**
	 * 析构函数
	 */
	public function __destruct() {
		$this->close();
	}
}