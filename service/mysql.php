<?php
class JDB{
	//pdo连实例
	private $pdo;
	/**
	 * 构造函数
	 */
	public function __construct() {
		self::$pdo = new PDO(Config::dsn(), Config::$db_username, Config::$db_userpwd);

	}

	public function query($sql){
		$pdo.query($sql);
	}
}