<?php

namespace sao;

class Request 
{

	private $get;
	private $post;
	private $files;

	public function __construct() 
	{
		if(!empty($_GET)) {
			$this->get = $_GET;
		}

		if(!empty($_POST)) {
			$this->post = $_POST;
		}

		if($json = file_get_contents('php://input')) {
			$json = json_decode($json);
			if(!empty($json)) {
				$this->post = $json;
			}
		}

		if(!empty($_FILES)) {
			$this->files = $_FILES;
		}

		unset($_GET);
		unset($_POST);
		unset($_FILES);
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

	public function files()
	{
		return $this->files;
	}

}

?>