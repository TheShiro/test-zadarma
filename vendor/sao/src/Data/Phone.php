<?php

namespace sao\Data;

class Phone extends String
{

	public $error = "Телефон должен иметь формат (ХХХ) ХХХ-ХХ-ХХ!";

	public function validation($value)
	{
		if(preg_match("/^\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/ui", $value)) {
			return true;
		} else {
			return false;
		}
	}

}

?>