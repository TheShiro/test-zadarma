<?php

namespace app\controllers;

use sao\Session;
use sao\Helper\String;
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
		$rows = $book->setUser(Session::getParam('user_id'))->byUser();

		$this->render('index', [
			'rows' => $rows,
			'id' => Session::getParam("user_id")
		]);
	}

	public function view($id) {
		// echo String::numberToString(858000000000);
		$entry = Book::where(['id' => $id['id']])->one();
		$this->render('view', [
			'entry' => $entry,
			'id' => Session::getParam("user_id")
		]);
	}

	public function create($request)
	{
		$book = new Book();
		foreach ($request as $key => $val) {
			$book->{$key} = $val;
		}

		if($book->invalid) {
			echo json_encode($book->invalid);
		}

		$id = Book::create($request);
		echo json_encode($id);
	}

	public function update($request)
	{
		$book = new Book();
		foreach ($request as $key => $val) {
			$book->{$key} = $val;
		}

		if($book->invalid) {
			echo json_encode($book->invalid);
		}

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