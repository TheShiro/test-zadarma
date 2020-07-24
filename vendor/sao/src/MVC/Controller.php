<?php

namespace sao\MVC;

class Controller
{

	protected $layout = "default";
	protected $className;

	public function __construct()
	{
		$this->className = \sao\Helper\String::getNameClass(get_class($this));
	}

	protected function render($view, $params = [])
	{
		(new View($this->className))->render($view, $params);
	}

}

?>