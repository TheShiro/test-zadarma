<?php

namespace sao\Data;

class String implements \sao\interfaces\IData
{

	protected $value;

	public function __toString()
	{
		return $this->__get("value");
	}

	public function __set($name, $value)
	{
		$this->{$name} = $value;
	}

	public function __get($name) 
	{
		return $this->{$name};
	}

	public function validate()
	{
		//
	}
}

?>