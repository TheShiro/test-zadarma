<?php

namespace sao\Route;

class Route
{

	public static $routes = array();

	public function __construct()
	{
		self::$routes = array(
			'get' => array(),
			'post' => array(),
			'put' => array(),
			'delete' => array(),
		);
		require_once ROUTES . "/web.php";
		require_once ROUTES . "/api.php";
	}

	public static function get($urn, $controller, $action)
	{
		$urn = self::getResource($urn);
		self::add(__FUNCTION__, self::arrayFormat($urn, $controller, $action));
	}

	public static function post($urn, $controller, $action)
	{
		$urn = self::getResource($urn);
		self::add(__FUNCTION__, self::arrayFormat($urn, $controller, $action));
	}

	public static function put($urn, $controller, $action)
	{
		$urn = self::getResource($urn);
		self::add(__FUNCTION__, self::arrayFormat($urn, $controller, $action));
	}

	public static function delete($urn, $controller, $action)
	{
		$urn = self::getResource($urn);
		self::add(__FUNCTION__, self::arrayFormat($urn, $controller, $action));
	}

	private static function add($method, $params = array())
	{
		self::$routes[$method] = array_merge(self::$routes[$method], $params);
	}

	private static function arrayFormat($urn, $controller, $action)
	{
		return array(
			$urn => array(
				'controller' => $controller,
				'action' => $action
			)
		);
	}

	private static function getResource($urn)
	{
		$file = debug_backtrace()[1]['file'];
		$source = explode("\\", $file);
		$source = explode(".", end($source));
		if($source[0] == "api"){
			return "/api" . $urn;
		}

		return $urn;
	}

}

?>