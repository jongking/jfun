<?php
/*
* 语言类
*/
class LAN{
	public static $LAN_STORE = array();
}
/*
* 获取语言类中的文字
*/
function L($key){
	return LAN::$LAN_STORE[strtoupper($key)];
}
function SetL($key, $value){
	LAN::$LAN_STORE[strtoupper($key)] = $value;
}