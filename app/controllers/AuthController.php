<?php

namespace app\controllers;

use app\models\User;

class AuthController extends \sao\MVC\Controller
{
	public function index()
	{
		if($post = \sao\Application::$app->request->post()) {
			$auth = new User();
			$auth->login = $post['login'];
			$auth->password = $post['pass'];
			if($auth->login()) {
				$this->redirect("/");
			} else {
				$this->render('index', [
					'errors' => "Не верный логин или пароль"
				]);
			}
			// print_r($auth);
			/*if($login = User::where(['login' => $user['login'], 'pass' => md5($user['pass'])])->one()) {
				print_r($login);
				// Session::setParams();
			}*/
		}
		$this->render('index');
	}
}

?>