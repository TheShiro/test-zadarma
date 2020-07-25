<?php

namespace app\controllers;

use app\models\User;

class UserController extends \sao\MVC\Controller
{

	public function login()
	{
		$user = User::login();
		return json_encode($user);
	}
}

?>