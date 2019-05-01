<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {
	
	private $logged_in=false;
	public $user_id;
  public $user_name;
	public $message;
  public $message_type;
	
	function __construct() {
		session_start();
		$this->check_message();
    $this->check_message_type();
		$this->check_login();
    if($this->logged_in) {
      // actions to take right away if user is logged in
    } else {
      // actions to take right away if user is not logged in
    }
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }

  public function is_logged_in_as_admin() {
    if($this->is_logged_in() && $_SESSION['user_type'] == 'admin') {
      return true;
    }else{
      return false;
    }
  }

  public function admin_login($admin) {
    // database should find user based on username/password
    if($admin){
      $this->user_id = $_SESSION['user_id'] = $admin->id;
      $this->user_name = $_SESSION['user_name'] = $admin->username;
      $_SESSION['user_type'] = 'admin';
      $this->logged_in = true;
    }
  }
  
  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_type']);
    unset($this->user_id);
    $this->logged_in = false;
  }

	private function check_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->logged_in = true;
    } else {
      unset($this->user_id);
      $this->logged_in = false;
    }
  }
  
  public function message($msg="") {
    if(!empty($msg)) {
      // then this is "set message"
      // make sure you understand why $this->message=$msg wouldn't work
      $_SESSION['message'] = $msg;
    } else {
      // then this is "get message"
      return $this->message;
    }
  }
  
  private function check_message() {
    // Is there a message stored in the session?
    if(isset($_SESSION['message'])) {
      // Add it as an attribute and erase the stored version
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
    }
  }

  public function message_type($msg_type="") {
    if(!empty($msg_type)) {
      $_SESSION['message_type'] = $msg_type;
    } else {
      return $this->message_type;
    }
  }
  
  private function check_message_type() {
    if(isset($_SESSION['message_type'])) {
      $this->message_type = $_SESSION['message_type'];
      unset($_SESSION['message_type']);
    } else {
      $this->message_type = "";
    }
  }
	
}

$session = new Session();
$message = $session->message();
$message_type = $session->message_type();

?>