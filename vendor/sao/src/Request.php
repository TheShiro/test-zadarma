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

		if($json = file_get_contents('php://input')) {
			$this->post = json_decode($json);
		}
	}

	public function get($key = "") 
	{
		if(empty($key)) {
			return $this->get;
		}

		return $this->get[$key];
	}

	public function post($key = "") 
	{
		if(empty($key)) {
			return $this->post;
		}

		return $this->post[$key];
	}

}

?>