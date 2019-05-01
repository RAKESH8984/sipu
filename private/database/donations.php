<?php
require_once(PRIVATE_PATH . DS . 'database.php');
class donations extends DatabaseObject {
	protected static $table_name="donations";
	protected static $db_fields = array('id','name','email','phone','address','amount');
	
	public $id;
	public $name;
	public $email;
	public $phone;
	public $address;
	public $amount;
	

}

?>