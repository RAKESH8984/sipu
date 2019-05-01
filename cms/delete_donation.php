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
    $ct = donation::find_by_id($_GET['id']);
    if($ct && $ct->delete()) {
      $session->message("The donation {$ct->name} Was Successfully Deleted.");
      $session->message_type("success");
      redirect_to('view_donation.php');
    } else {
      $session->message("The donation Could Not Be Deleted.");
      $session->message_type("danger");
      redirect_to('view_donation.php');
    }
  }else{
    $session->message("Invalid Request");
    $session->message_type("danger");
    redirect_to('view_donation.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
