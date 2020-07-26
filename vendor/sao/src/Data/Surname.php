<?php

namespace sao\Data;

class Surname extends String
{

	public $error = "Фамилия должно содержать только кириллические буквы!";

	public function validation($value)
	{
		if(preg_match("/^[а-я]{1,}$/ui", $value)) {
			return true;
		} else {
			return false;
		}
	}

}

?>