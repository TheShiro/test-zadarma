<?php

namespace app\controllers;

use app\models\User;
use app\models\Book;

class ValidationController extends \sao\MVC\Controller
{

	public function user($request)
	{
		$user = new User();

		foreach ($request as $k => $val) {
			$user->{$val->name} = $val->value;
		}

		if($user->invalid) {
			echo json_encode($user->invalid);
		} else {
			echo json_encode(true);
		}
	}

	public function book($request)
	{
		$book = new Book();

		foreach ($request as $k => $val) {
			$book->{$val->name} = $val->value;
		}

		if($book->invalid) {
			echo json_encode($book->invalid);
		} else {
			echo json_encode(true);
		}
	}
	
}