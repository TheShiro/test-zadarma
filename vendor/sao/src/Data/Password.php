<?php

namespace sao\Data;

class Password extends String implements \sao\interfaces\IData
{
	
	public function __set($name, $value)
	{
		$this->{$name} = md5($value);
	}

}

?>