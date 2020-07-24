<?php

namespace app\controllers;

use app\models\User;

class MainController extends \sao\MVC\Controller
{
	public function index()
	{
		$users = User::delete(['id' => 2, 'name' => 2]);
		// print_r($users);

		$this->render('index');
	}
}

?>