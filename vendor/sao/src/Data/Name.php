<?php

namespace sao\Data;

class Name extends String
{

	public $error = "Имя должно содержать только кириллические буквы!";

	public function validation($value)
	{
		$diff = preg_replace("/[а-я]/iu", "", $value);
		// print_r($diff);
		if(!$diff) {
			return true;
		} else {
			return false;
		}

	}

}

?>