<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(PRIVATE_PATH . DS . 'database.php');
class photo extends DatabaseObject {
	
	protected static $table_name="photo";
	protected static $db_fields = array('id','content','image');
	
	public $id;
	public $content;
	public $image;
	
	
	
}

?>