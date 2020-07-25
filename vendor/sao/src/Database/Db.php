<?php

namespace sao\Database;

class Db
{

	use \sao\Traits\TSingletone;

	protected static $dbh;

	public function __construct()
	{
		$db = require_once CONFIG . "/db.php";

		self::$dbh = new \PDO($db['dsn'], $db['user'], $db['pass']);
	}

	protected static function execute($query, $params = [])
	{
		$sth = self::$dbh->prepare($query);
		$sth->execute($params);

		return $sth;
	}

}

?>