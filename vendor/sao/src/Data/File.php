<?php

namespace sao\Data;

class File implements \sao\interfaces\IData
{

	public $error = "";

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
		// проверка размера файла
		return true;
	}

}

?>