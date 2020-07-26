<?php

namespace sao\Data;

class File implements \sao\interfaces\IData
{

	public $error = "Файл должен весить меньше 2Мб и быть формата png или jpg!";

	protected $value;
	protected $temp;

	public function __toString()
	{
		return $this->__get("value");
	}

	public function __set($name, $value)
	{
		$this->{$name} = "uploads/" . uniqid() . "_" . $value['name'];
		$this->temp = $value['tmp_name'];
	}

	public function __get($name) 
	{
		return $this->{$name};
	}

	public function validation($value)
	{
		// print_r($value);
		if($value['size'] > (1024 * 1024 * 2)) {
			return false;
		}

		if(!preg_match("/(png)|(jpg)/i", $value['type'])) {
			return false;
		}

		return true;
	}

}

?>