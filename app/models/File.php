<?php

namespace app\models;

class File extends \sao\MVC\model
{

	protected $file;

	public function upload()
	{
		if($this->invalid) {
			return false;
		}

		move_uploaded_file($this->file->temp, $this->file->value);
	}

}