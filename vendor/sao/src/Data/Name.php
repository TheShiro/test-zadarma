<?php

namespace sao\Data;

class Name extends String
{

	public $error = "Имя должно содержать только кириллические буквы!";

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