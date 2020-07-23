<?php

namespace sao;

class Request 
{

	private $get;
	private $post;

	public function __construct() 
	{
		if(!empty($_GET)) {
			$this->get = $_GET;
		}

		if(!empty($_POST)) {
			$this->post = $_POST;
		}
	}

	public function get($key = 0) 
	{
		if(empty($key)) {
			return $this->get;
		}

		return $this->get[$key];
	}

	public function post($key = 0) 
	{
		if(empty($key)) {
			return $this->post;
		}

		return $this->post[$key];
	}

}

?>