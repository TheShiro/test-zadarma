<?php

namespace sao\Interfaces;

interface IData
{

	public function __toString();

	public function __set($name, $value);

	public function __get($name);

	public function validation($value);

}

?>