<?php
require_once("../private/initialize.php");

if($session->is_logged_in_as_admin()) {
  $session->message("Already LoggedIn");
  $session->message_type("warning");
  redirect_to("index.php");
}
if(request_is_post() && request_is_same_domain()) {

  if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
    $message_type = "danger";
  }
  
  if(!has_presence($_POST['name']) || !has_presence($_POST['pass'])) {
    $message = "Missing Field Values.";
    $message_type = "danger";
  }else{
    $name = trim($_POST['name']);
    $pass = trim($_POST['pass']);
    // Check database to see if username/password exist.
    $found_user = Admin::authenticate($name, $pass);
    if ($found_user) {
      $session->admin_login($found_user);
      log_action('Admin Login', "{$found_user->name} logged in.");
      $session->message("Login Successfull");
      $session->message_type("success");
      redirect_to("index.php");
    } else {
      // username/password combo was not found in the database
      $message = "name/pass combination incorrect.";
      $message_type = "danger";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>|| LOGIN ||</title>

    <!-- Bootstrap core CSS -->

    <link href="../public/css/bootstrap.min.css" rel="stylesheet">

    <link href="../public/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../public/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../public/css/custom.css" rel="stylesheet">
    <link href="../public/css/icheck/flat/green.css" rel="stylesheet">


    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>

    

</head>

<body style="background:#F7F7F7;">
    
    <div class="">

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form action="login.php" method="post" id="form" data-parsley-validate>
                        <?php echo csrf_token_tag(); ?>
                        <h1>Login Form</h1>
                        <?php echo output_message($message, $message_type); ?>
                        <div>
                            <input type="text" class="form-control" name="name" placeholder="Userid" required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="pass" placeholder="Password" required />
                        </div>
                        
                        <div>
                            <input id="btn_login" name="login" type="submit" class="btn btn-default btn-block" value="Login" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i>Admin panel</h1>

                                <p></p>
                            </div>
                        </div>
                    </form>
                    
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>


<script type="text/javascript" src="../public/js/parsley/parsley.min.js"></script>
<script>
    $(document).ready(function () {
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#form .btn').on('click', function () {
            $('#form').parsley().validate();
            validateFront();
        });
        var validateFront = function () {
            if (true === $('#form').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });
    try {
        hljs.initHighlightingOnLoad();
    } catch (err) {}
</script>

</body>

</html>