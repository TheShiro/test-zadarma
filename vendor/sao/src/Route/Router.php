<?php

namespace sao\Route;

class Router
{

	protected $method;
	protected $uri;
	protected $controller;
	protected $action;

	public function __construct()
	{
		new Route();
		$this->method = strtolower($_SERVER['REQUEST_METHOD']);
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function dispatch()
	{
		if(!$this->matchRoute()) {
			print_r(Route::$routes);
			print_r($this->uri);
			throw new \Exception("Страница не найдена", 404);
		}
	}

	public function matchRoute() {
		foreach(Route::$routes as $k => $method) {
			foreach($method as $k => $v) {
				if($k == $this->uri) {
					$controllerPath = "app\controllers\\" . $v['controller'];
					if(class_exists($controllerPath)) {
						$controller = new $controllerPath;
						$action = $v['action'];

						if(method_exists($controller, $action)) {
							$controller->$action(\sao\Application::$app->request->post());
						} else {
							throw new \Exception("Метод $controllerPath::$action не найден", 404);
						}
					} else {
						throw new \Exception("Контроллер {$v['controller']} не найден", 404);
					}

					return true;
				}
			}
		}

		return false;
	}

}

?>