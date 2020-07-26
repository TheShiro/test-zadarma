<?php

namespace sao\Data;

class Password extends String
{

	public $error = "Пароль должен содержать только латинские буквы и цифры! минимальная длина 8 знаков.";
	
	public function __set($name, $value)
	{
		$this->{$name} = md5($value);
	}

	public function validation($value)
	{
		if(preg_match("/^[a-z\d]{8,}$/ui", $value)) {
			// echo "true";
			return true;
		} else {
			// echo "false";
			return false;
		}
	}

}

?>