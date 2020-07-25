<?php

namespace sao\MVC;

class View
{

	protected $layout;
	// path to view file
	protected $path;
	protected $title = "Телефонная книга";

	public function __construct()
	{
		// $this->path = $path;
		// $this->layout = $layout;
	}

	// путь до вида
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function render($view, $params = [])
	{
		extract($params);

		$viewFile = sprintf("%s/%s/%s.php", VIEW, $this->path, $view);

		if(is_file($viewFile)) {
			ob_start();
			require_once $viewFile;
			$content = ob_get_clean();
		} else {
			throw new \Exception("Не найден вид $viewFile", 500);
		}

		$layout = sprintf("%s/layout/%s.php", VIEW, $this->layout);
		if(is_file($viewFile)) {
			require_once $layout;
		} else {
			throw new \Exception("Не найден шаблон $layout не найден", 500);
		}
	}

}

?>