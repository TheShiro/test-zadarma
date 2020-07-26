<?php

namespace sao\MVC;

class Model extends \sao\Database\Query
{

	protected $atributes = [];
	protected $fillable = [];
	protected $hidden = [];

	public $invalid = "";

	public function __construct()
	{
		parent::__construct();
	}

	public function __set($name,$value)
	{
		$typeObject = "\sao\Data\\" . ucfirst($name);
		$this->{$name} = new $typeObject();

		if($this->{$name}->validation($value)) { //валидация 
			$this->{$name}->value = $value;
		} else {
			$this->invalid .= $this->{$name}->error . "<br>";
		}
	}

	public function __get($name) 
	{
		return $this->{$name};
	}

}

?>