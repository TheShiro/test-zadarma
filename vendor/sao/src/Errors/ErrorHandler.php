<?php 

namespace sao\Errors;

class ErrorHandler 
{

	public function __construct() 
	{
		if(DEBUG) {
			error_reporting(-1);
		} else {
			error_reporting(0);
		}

		set_exception_handler([$this, 'exceptionHandler']);
	}

	public function exceptionHandler($e) 
	{
		$this->displayError("Exception", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
	}

	protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404) 
	{
		http_response_code($responce);

		if($responce == 404 && !DEBUG) {
			require_once WWW . 'view/404.php';
			die();
		}

		if(DEBUG) {
			require_once 'view/dev.php';
			die();
		} else {
			require_once 'view/prod.php';
			die();
		}
	}

}

?>