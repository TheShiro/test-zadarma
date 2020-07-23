<?php

namespace sao\Helper;

class Helper
{

	public static function getNameClass($class)
	{
		$class = explode("\\", $class);
		preg_match_all("/[A-Z][^A-Z]*?/U", end($class), $ret);
		return strtolower($ret[0][0]);
	}

}

?>