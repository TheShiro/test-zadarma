<?php

define("DEBUG", 1);

define("ROOT", dirname(__DIR__));

define("APP", ROOT . '/app');

define("VIEW", ROOT . '/app/view');

define("ROUTES", ROOT . '/routes');

define("CONFIG", ROOT . '/config');

require_once ROOT . '/vendor/autoload.php';

?>