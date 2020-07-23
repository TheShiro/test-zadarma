<?php

namespace sao;

class Application
{

	public static $app;

	public function __construct()
	{
		//create session
		new Session();
		new Errors\ErrorHandler();
		self::$app = Container::instance();
		self::$app->request = new Request();
	}

	public function run()
	{
		// echo "<pre>";
		(new Route\Router())->dispatch();
	}

}

?>