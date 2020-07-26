<?php

namespace app\controllers;

use sao\Application;
use app\models\File;

class FileController extends \sao\MVC\Controller
{

	public function upload($request)
	{
		$file = Application::$app->request->files()['file'];

		$model = new File();
		$model->file = $file;

		if($model->invalid) {
			echo json_encode($model->invalid);
		} else {
			$model->upload();
			echo json_encode($model->file->value);
		}
	}

}