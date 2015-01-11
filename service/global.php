<?php
function POST($name){
	Check::create()->notNull($_POST[$name], $name);
	return $_POST[$name];
}
function GET($name){
	Check::create()->notNull($_GET[$name], $name);
	return $_GET[$name];
}
function REQUEST($name){
	Check::create()->notNull($_REQUEST[$name], $name);
	return $_REQUEST[$name];
}