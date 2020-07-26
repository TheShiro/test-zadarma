<?php

namespace app\controllers;

use sao\Session;
use app\models\User;

class AuthController extends \sao\MVC\Controller
{

	protected $layout = "auth";

	public function index()
	{
		if($post = \sao\Application::$app->request->post()) {
			$auth = new User();
			$auth->login = $post['login'];
			$auth->password = $post['password'];

			// print_r($auth);
			if($auth->login()) {
				// echo "OK";
				$this->redirect("/");
			} 

			$this->render('index', [
				'errors' => "Не верный логин или пароль"
			]);
		}
		$this->render('index');
	}

	public function logout()
	{
		Session::destroy();
		$this->redirect("/");
	}

	public function signup()
	{
		if($post = \sao\Application::$app->request->post()) {
			$auth = new User();
			$auth->login = $post['login'];
			$auth->password = $post['password'];
			$auth->repeat = $post['repeat'];
			$auth->name = $post['name'];
			$auth->email = $post['email'];

			if($auth->signup()) {
				$this->redirect("/");
			} else {
				$this->render('signup', [
					'errors' => $auth->invalid
				]);
			}
		}

		$this->render('signup');
	}
}

?>