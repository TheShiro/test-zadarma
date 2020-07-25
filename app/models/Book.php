<?php

namespace app\models;

class Book extends \sao\MVC\model
{

	protected $id;
	protected $user_id;
	protected $name;
	protected $surname;
	protected $phone;
	protected $email;
	protected $photo;

	protected $fillable = ['user_id', 'name', 'surname', 'phone', 'email', 'photo'];

	public function byUser()
	{
		return self::where(['user_id' => $this->user_id])->orderBy(['id'], "desc")->all();
	}

	public function setUser($value)
	{
		$this->user_id = $value;

		return $this;
	}

}

?>