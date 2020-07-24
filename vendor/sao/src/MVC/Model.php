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

}

?>