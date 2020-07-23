<?php

namespace sao\MVC;

class Model
{

	protected $atributes = [];
	protected $fillable = [];
	protected $hidden = [];

	protected $table;

	public function __construct()
	{
		$this->table = \sao\Helper\Helper::getNameClass(get_class($this));
		// sao\Db::instance();
	}

}

?>