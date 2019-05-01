<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(PRIVATE_PATH . DS . 'database.php');

class Admin extends DatabaseObject {
	
	protected static $table_name="user_login";
	protected static $db_fields = array('id', 'name', 'pass');
	
	public $id;
	public $name;
	public $pass;
	

	public static function authenticate($name="", $pass="") {
    global $database;
    $name = $database->escape_value($name);
    $pass = $database->escape_value($pass);
    //$hassed_password = sha1($password);
    $sql  = "SELECT * FROM user_login ";
     $sql .= "WHERE name = '{$name}' ";
    $sql .= "AND pass = '{$pass}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>