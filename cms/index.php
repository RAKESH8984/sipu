<?php
require_once("../private/initialize.php");
if(!$session->is_logged_in_as_admin()) {
  $session->message("Please LogIn First");
  $session->message_type("warning");
  redirect_to("login.php");
} 
?>
<?php include_layout_template('admin'.DS.'head.php'); ?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include_layout_template('admin'.DS.'side_nav.php'); ?>
            <?php include_layout_template('admin'.DS.'top_nav.php'); ?>
            <!-- page content -->
            <div class="right_col" role="main">
            <?php echo output_message($message, $message_type); ?>
               <h3 align="center" style="color:#FF0000">WELCOME TO UGRATARA</h3>
                <div class="clearfix"></div>
				<img src="../images/about.jpg">
                <?php include_layout_template('admin'.DS.'foot.php'); ?>
            </div>
        </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../public/js/chartjs/chart.min.js"></script>
    <script src="../public/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../public/js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../public/js/custom.js"></script>  
</body>
</html>