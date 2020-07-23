<?php

namespace sao\MVC;

class View
{

	protected $layout;
	// path to view file
	protected $path;

	public function __construct($path, $layout = "default")
	{
		$this->path = $path;
		$this->layout = $layout;
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