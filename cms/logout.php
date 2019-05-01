<?php require_once("../private/initialize.php"); ?>
<?php	
    $session->logout();
    $session->message("Logged Out Successfully, Thank You");
    $session->message_type("info");
    redirect_to("login.php");
?>
