<?php
class Db_factory{
	public static function create(){
		if(JFUN::load_sys_func(Config::$db_type)){
			return new JDB();
		}
		elseif (JFUN::load_ext_func(Config::$db_type)) {
			return new JDB();
		}
		else{
			echo 'no db connect';
		}
	}
}