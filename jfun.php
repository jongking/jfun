<?php
/* 框架版本信息 */
define('JFUN_VERSION', '1.0.0');

/* 路径相关配置信息 */
define('JFUN_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
//缓存文件夹地址
define('CACHE_PATH', JFUN_PATH.'caches'.DIRECTORY_SEPARATOR);
//服务文件夹地址
define('SERVICE_PATH', JFUN_PATH.'service'.DIRECTORY_SEPARATOR);
//语言文件夹地址
define('LAN_PATH', JFUN_PATH.'language'.DIRECTORY_SEPARATOR);
//拓展文件夹地址
define('EXT_PATH', JFUN_PATH.'extention'.DIRECTORY_SEPARATOR);

/*
 * 二进制:十进制 模式描述 
 * 00: 0 关闭 
 * 01: 1 window 
 * 10: 2 log 
 * 11: 3 window|log
 */
!defined('JFUN_DEBUG') && define('JFUN_DEBUG', 0);

class JFUN{
	/**
	 * 初始化框架
	 */
	public static function init(){
		self::_loadlib();
	}

	/**
	 * 加载配置文件
	 * @param string $func 函数库名
	 */
	public static function load_config($func) {
		return self::_requireFile($func.'.php');
	}
	/**
	 * 加载系统的函数库
	 * @param string $func 函数库名
	 */
	public static function load_sys_func($func) {
		return self::_requireFileOne($func.'.php', SERVICE_PATH);
	}
	/**
	 * 加载拓展的函数库
	 * @param string $func 函数库名
	 */
	public static function load_ext_func($func) {
		return self::_requireFileOne($func.'.php', EXT_PATH);
	}
	/**
	 * 加载语言
	 * @param string $func 函数库名
	 */
	public static function load_lan_func($func) {
		return self::_requireFile($func.'.php', LAN_PATH);
	}
	/**
	 * 载入文件
	 */
	private static function _requireFile($filename, $filedir = ''){
		if (file_exists($filedir.$filename)) {
			include $filedir.$filename;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 条件载入文件
	 */
	private static function _requireFileOne($filename, $filedir = ''){
		if (file_exists($filedir.$filename)) {
			include_once $filedir.$filename;
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 载入公用函数库
	 */
	private static function _loadlib(){
		self::load_sys_func('config');
		self::load_config('config');
		self::load_sys_func('err');
		self::load_lan_func('lan');
		self::load_lan_func(Config::$lan);
		self::load_sys_func('global');
		self::load_sys_func('db');
	}
}