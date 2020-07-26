<?php

namespace sao\Data;

class Number implements \sao\interfaces\IData
{
	
	public $error = "Здесь должно быть целочисленное значение!";

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

	public function validation($value)
	{
		if(is_numeric($value)) {
			// echo "true";
			return true;
		} else {
			// echo "false";
			return false;
		}
	}

}

?>