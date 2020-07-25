<?php

namespace sao\Route;

class Router
{

	protected $method;
	protected $uri;
	protected $controller;
	protected $action;
	protected $get;

	public function __construct()
	{
		new Route();
		$this->method = strtolower($_SERVER['REQUEST_METHOD']);
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function dispatch()
	{
		if(!$this->matchRoute()) {
			throw new \Exception("Страница не найдена", 404);
		}
	}

	public function matchRoute() 
	{
		foreach(Route::$routes as $k => $method) {
			foreach($method as $k => $v) {
				if($this->parse($k, $this->uri)) {
					$controllerPath = "app\controllers\\" . $v['controller'];

					if(class_exists($controllerPath)) {
						$controller = new $controllerPath;
						$action = $v['action'];

						if(method_exists($controller, $action)) {
							if(!empty($this->get)) {
								$controller->$action($this->get, \sao\Application::$app->request->post());
							} else {
								$controller->$action(\sao\Application::$app->request->post());
							}
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

	/**
	 * @param $url1 - route
	 * @param $url2 - urn
	 */
	private function parse($url1, $url2)
	{
		$url1 = explode("/", $url1);
		$turl1 = $url1;

		$url2 = explode("/", $url2);
		$turl2 = $url2;

		//получаем отличия роута и запроса
		$url1 = array_diff($url1, $turl2);
		$url2 = array_diff($url2, $turl1);

		if($url1 != $turl1 && count($url1) == count($url2)) {
			foreach ($url1 as $k => $v) {
				if(strstr($v, "{") == "") {
					$this->get = [];
					return false;
				} else {
					$key = str_replace(["{", "}"], "", $v);
					$this->get[$key] = $url2[$k];
				}
			}

			return true;
		}

		return false;
	}

}

?>