<?php

namespace sao\Database;

class Query extends Db
{

	private static $table = "";
	private static $select = "*";
	private static $values = "";
	private static $where = "";
	private static $group = "";
	private static $order = "";

	private static $params = [];

	private static $object;

	public function __construct()
	{
		\sao\Database\Db::instance();
	}

	public static function select($params = [])
	{
		if(empty($params)) {
			return self::object();
		}

		self::$select = implode(", ", $params);

		return self::object();
	}

	private static function values($params = [])
	{
		$ret = [];

		foreach (self::$object->fillable as $val) {
			if(isset($params[$val])) {
				$ret[] = ":" . $val;
				self::$params[":" . $val] = $params[$val];
			} else {
				throw new \Exception("Ошибка передачи параметров", 500);
			}
		}

		return $ret;
	}

	private static function set($params = [])
	{
		$ret = [];

		foreach ($params as $key => $val) {
			if($key != "id") {
				$ret[] = $key . " = :" . $key;
			}
			self::$params[":" . $key] = $val;
		}

		return $ret;
	}

	public static function where($params = [])
	{
		if(empty($params)) {
			return self::object();
		}

		self::$where = self::parseParams($params);
		
		return self::object();
	}

	public static function groupBy($params = "")
	{
		return self::object();
	}

	public static function orderBy($params = "")
	{
		return self::object();
	}

	public static function one() {
		$class = self::object();

		$sql = self::bindQuery();

		return $class->execute($sql, self::$params)->fetch();
	}

	public static function all() {
		$class = self::object();

		$sql = self::bindQuery();

		echo $sql;

		return $class->execute($sql, self::$params)->fetchAll();
	}

	public static function create($params = []) {
		if(empty($params)) {
			return false;
		}

		$class = self::object();
		
		$sql = sprintf("INSERT INTO %s(%s) VALUES (%s)",
			self::$table,
			implode(", ", $class->fillable),
			implode(", ", self::values($params))
		);

		$class->execute($sql, self::$params);
	}

	public static function update($params = []) {
		if(empty($params) || empty($params['id'])) {
			return false;
		}

		$class = self::object();
		
		$sql = sprintf("UPDATE %s SET %s WHERE id = :id LIMIT 1",
			self::$table,
			implode(", ", self::set($params))
		);

		$class->execute($sql, self::$params);
	}

	public static function delete($params = []) {
		if(empty($params) || empty($params['id'])) {
			return false;
		}

		$class = self::object();
		
		$sql = sprintf("DELETE FROM %s WHERE id = :id",
			self::$table
		);

		foreach ($params as $key => $val) {
			if($key == 'id'){
				self::$params[":" . $key] = $val;
			}
		}

		$class->execute($sql, self::$params);
	}

	private static function object()
	{
		if(!isset(self::$object)) {
			self::$object = new static;
			self::$table = \sao\Helper\String::getNameClass(get_class(self::$object));
		}
		// имя таблицы по классу
		return self::$object;
	}

	private static function parseParams($params)
	{
		$ret = "";
		foreach ($params as $key => $val) {
			$ret .= $key . " = :" . $key;
			self::$params[":" . $key] = $val;
		}
		return $ret;
	}

	private static function bindQuery()
	{
		return sprintf("SELECT %s FROM %s %s %s %s", 
			self::hidden(),//self::$select, 
			self::$table,
			(self::$where ? "WHERE " . self::$where : ""),
			(self::$group ? "ORDER BY " . self::$group : ""),
			(self::$order ? "ORDER BY " . self::$order : "")
		);
	}

	private static function hidden()
	{
		if(self::$select == "*") {
			self::$select = "id, " . implode(", ", self::$object->fillable);
		}

		return self::$select;
	}

}

?>