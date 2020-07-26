<?php

namespace sao\Data;

class Email extends String
{

	public $error = "Введите корректный email-адрес!";

	public function validation($value)
	{
		// echo "1";
		// $diff = preg_replace("/^[a-z\d]*@[a-z\d]*\.[a-z\d]{2,}$/iu", "", $value);
		// print_r($diff);
		if(preg_match("/^[a-z\d]*@[a-z\d]*\.[a-z]{2,}$/ui", $value)) {
			// echo "true";
			return true;
		} else {
			// echo "false";
			return false;
		}
	}

}

?>