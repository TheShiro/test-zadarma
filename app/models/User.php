<?php

namespace app\models;

class User extends \sao\MVC\model
{
	/*public function query()
	{
		return self::where()->get();
	}*/

	protected $fillable = ['login', 'pass', 'name', 'email'];
}

?>