<?php

namespace app\controllers;

use sao\Session;
use app\models\Book;

class BookController extends \sao\MVC\Controller
{
	public function index()
	{
		// перенаправляем если пользователь не авторизован
		if(!Session::getParam("user_id")) {
			$this->redirect("/login");
		}

		$book = new Book();
		$rows = $book->setUser(1)->byUser();

		$this->render('index', [
			'rows' => $rows
		]);
	}

	public function create($request)
	{
		print_r($request);
		echo json_encode($request);
		Book::create($request);
	}
}

?>