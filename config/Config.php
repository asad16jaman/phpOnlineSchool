<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

define('BASE_PATH',dirname(dirname(__FILE__)));

require_once BASE_PATH. '/lib/db/MySqliDb.php';
require_once BASE_PATH. '/lib/helper/Helper.php';




define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "lms");

/**
 * Get instance of DB object
 */
function getDbInstance() {
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}