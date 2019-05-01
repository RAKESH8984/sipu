<?php
ob_start();
// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// Set constants to easily reference public 
// and private directories
define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . DS . "private");
define("PUBLIC_PATH", APP_ROOT . DS . "public");

// load config file first
require_once(PRIVATE_PATH . DS . "config.php");
date_default_timezone_set('Asia/Kolkata');

// load basic functions next so that everything after can use them
require_once(PRIVATE_PATH . DS . "functions" . DS . "general_functions.php");
require_once(PRIVATE_PATH . DS . "functions" . DS . "csrf_request_type_functions.php");
require_once(PRIVATE_PATH . DS . "functions" . DS . "csrf_token_functions.php");
require_once(PRIVATE_PATH . DS . "functions" . DS . "request_forgery_functions.php");
require_once(PRIVATE_PATH . DS . "functions" . DS . "validation_functions.php");
require_once(PRIVATE_PATH . DS . "functions" . DS . "xss_sanitize_functions.php");

// load core objects
require_once(PRIVATE_PATH . DS . "session.php");
require_once(PRIVATE_PATH . DS . "database.php");
require_once(PRIVATE_PATH . DS . "database_object.php");

require_once(PRIVATE_PATH . DS . "pagination.php");

require_once(PRIVATE_PATH.DS."phpMailer".DS."class.phpmailer.php");
require_once(PRIVATE_PATH.DS."phpMailer".DS."class.smtp.php");


//$sel_admin = Admin::find_by_id(1);
//define("ADMIN_NAME", $sel_admin->username );

?>