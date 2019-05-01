<?php
require_once("../private/initialize.php");

if(!$session->is_logged_in_as_admin()) {
  $session->message("Please LogIn First");
  $session->message_type("warning");
  redirect_to("login.php");
} 
?>
<?php
  // must have an ID
  if(request_is_get() && request_is_same_domain()) {
    $ct = photo::find_by_id($_GET['id']);
    if($ct && $ct->delete()) {
      $session->message("The photo {$ct->name} Was Successfully Deleted.");
      $session->message_type("success");
      redirect_to('view_photo.php');
    } else {
      $session->message("The photo Could Not Be Deleted.");
      $session->message_type("danger");
      redirect_to('view_photo.php');
    }
  }else{
    $session->message("Invalid Request");
    $session->message_type("danger");
    redirect_to('view_photo.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
