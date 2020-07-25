<?php

namespace app\models;

use sao\Session;

class User extends \sao\MVC\model
{
	protected $id;
	protected $login;
	protected $password;
	protected $name;
	protected $email;

	protected $fillable = ['login', 'pass', 'name', 'email'];

	public function login()
	{
		if($user = self::where(['login' => $this->login, 'pass' => $this->password])->one()) {
			Session::setParams(['user_id' => $user['id']]);
			return true;
		}

		return false;
	}

	public function registration($request)
	{
		//User::create($request);
	}

}

?>