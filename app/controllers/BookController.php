<?php

namespace app\controllers;

use sao\Session;

class BookController extends \sao\MVC\Controller
{
	public function index()
	{
		// перенаправляем если пользователь не авторизован
		if(!Session::getParam("user_id")) {
			$this->redirect("/login");
		}

		$this->render('index');
	}
}

?>