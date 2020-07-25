<?php

namespace sao\Data;

class Repeat extends String
{
	
	public function __set($name, $value)
	{
		$this->{$name} = md5($value);
	}

}

?>