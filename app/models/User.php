<?php

namespace app\models;

use sao\Session;

class User extends \sao\MVC\model
{
	protected $id;
	protected $login;
	protected $password;
	protected $repeat; // repeat password
	protected $name;
	protected $email;

	public $invalid = "";

	protected $fillable = ['login', 'pass', 'name', 'email'];

	public function login()
	{
		if($user = self::where(['login' => $this->login, 'pass' => $this->password])->one()) {
			Session::setParams(['user_id' => $user['id']]);
			return true;
		}

		return false;
	}

	public function signup()
	{
		if(!$this->invalid) {
			$request = [
				'login' => $this->login,
				'pass' => $this->password,
				'name' => $this->name,
				'email' => $this->email,
			];

			self::create($request);
		} else {
			return false;
		}
	}

}

?>