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
			'rows' => $rows,
			'id' => Session::getParam("user_id")
		]);
	}

	public function create($request)
	{
		$id = Book::create($request);
		echo json_encode($id);
	}

	public function update($request)
	{
		Book::update($request);
		echo json_encode(true);
	}

	public function delete($request)
	{
		Book::delete($request);
		echo json_encode(true);
	}
}

?>