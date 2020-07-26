<?php

namespace sao\Data;

class String implements \sao\interfaces\IData
{

	public $error = "Строка должна содержать только буквы или цифры!";

	protected $value;
	// protected $title = "Строка";

	public function __toString()
	{
		// var_dump($this->__get("value"));
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
		// echo "1";
		$diff = preg_replace("/[a-z\d]/iu", "", $value);
		// print_r($diff);
		// if(!$diff) {
		if(preg_match("/^[a-z]{1}[a-z\d]*$/ui", $value)) {
			// echo "true";
			return true;
		} else {
			// echo "false";
			return false;
		}
	}
}

?>