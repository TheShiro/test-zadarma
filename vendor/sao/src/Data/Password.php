<?php

namespace sao\Data;

class Password extends String
{
	
	public function __set($name, $value)
	{
		$this->{$name} = md5($value);
	}

}

?>