<?php

namespace sao\MVC;

class Model extends \sao\Database\Query
{

	protected $atributes = [];
	protected $fillable = [];
	protected $hidden = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function __set($name,$value)
	{
		// echo "initialize $name <br>";
		$typeObject = "\sao\Data\\" . ucfirst($name);
		$this->{$name} = new $typeObject();
		$this->{$name}->value = $value;
	}

	public function __get($name) 
	{
		return $this->{$name};
	}

}

?>