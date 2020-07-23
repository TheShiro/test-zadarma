<?php

namespace sao;

class Session 
{

	public function __construct() 
	{
		session_start();
	}

	public static function setParams($arr = array()) 
	{
		foreach ($arr as $k => $v) {
			$_SESSION[$k] = $v;
		}
	}

	public static function getParams() 
	{
		return $_SESSION;
	}

	public static function getParam($id) 
	{
		return !empty($_SESSION[$id]) ? $_SESSION[$id] : false;
	}

	public static function destroy() 
	{
		session_unset();
		session_destroy();
		setcookie(session_name(), session_id(), time()-3600);
	}
}

?>