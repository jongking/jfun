<?php
class Err{
	public static function Msg($msg = '', $filename = '', $line = ''){
		if(Config::$db_type == 'mssql'){
			$msg = iconv('GB2312', 'UTF-8', $msg);
		}
		$errmsg = "Error: " . $msg . "<br/>" . "FILE: " . $filename . "<br/>" . "LINE: " . $line . "<br/>";
		die($errmsg);
	}

	public static function CheckMsg($msg = ''){
		die($msg);
	}
}