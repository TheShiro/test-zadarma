<?php

namespace sao\MVC;

class Controller
{

	protected $layout = "default";
	protected $className;
	protected $title = "Телефонная книга";

	public function __construct()
	{
		$this->className = \sao\Helper\String::getNameClass(get_class($this));
	}

	protected function render($view, $params = [])
	{
		(new View())
			->setPath($this->className)
			->setLayout($this->layout)
			->setTitle($this->title)
			->render($view, $params);
	}

	protected function redirect($url) {
		$_SERVER['QUERY_STRING'] = $url;
		header('Location: ' . $url);
	}

}

?>