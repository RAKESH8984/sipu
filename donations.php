<?php
require_once("private/initialize.php");
ini_set("display_errors",0)
?>
<?php
  if(request_is_post() && request_is_same_domain()) {

    if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
      $message = "Sorry, request was not valid.";
    }
    if(!has_presence($_POST['name'])) {
    $message = "Missing Field Values.";
    $message_type = "danger";
    }else{
       $donations = new donations();
	   $donations->name = ($_POST['name']);
	   $donations->email = ($_POST['email']);
	   $donations->phone = ($_POST['phone']);
	   $donations->address = ($_POST['address']);
	   $donations->amount = ($_POST['amount']);
	   
      
		 if($donations->save()) {
        $n='n';
        $session->message("donation saved successfully.");
        $session->message_type("success");
		echo "<script>location.href='donations.php?m=$n'</script>";
       
      } else {
        // Failure
        $message = "donation Could Not Be Created.";
        $message_type = "danger";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<?php include("title.php"); ?>
	<meta name="description" content=" | " />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/responsive.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/camera.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
 <link rel="stylesheet" href="js/styles.css">
<link rel='stylesheet' id='flexslider-css'  href='css/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='owl-carousel-css'  href='css/owl.carousel.css' type='text/css' media='all' />
<link rel='stylesheet' id='owl-theme-css'  href='css/owl.theme.css' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='css/font-awesome.css' type='text/css' media='all' />
<link rel='stylesheet' id='cherry-plugin-css'  href='css/cherry-plugin.css' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='css/styles.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme48550-css'  href='css/main-style.css' type='text/css' media='all' />
<link rel='stylesheet' id='magnific-popup-css'  href='css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Lato-css'  href='css/font1.css' type='text/css' media='all' />
<link rel='stylesheet' id='options_typography_Satisfy-css'  href='css/font.css' type='text/css' media='all' />
<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='js/modernizr.js'></script>
<script type='text/javascript' src='js/jflickrfeed.js'></script>
<script type='text/javascript' src='js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='js/custom.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script type='text/javascript' src='js/script.js'></script>
	<style type='text/css'>
body { background-image:url(images/bg.jpg); background-repeat:repeat; background-position:top center; background-attachment:scroll; }
.header { background-color:#ffffff }
</style>
<style type='text/css'>
h1 { font: bold 36px/43px Lato;  color:#27acd5; }
h2 { font: bold 32px/38px Lato;  color:#27acd5; }
h3 { font: bold 28px/34px Lato;  color:#27acd5; }
h4 { font: bold 24px/29px Lato;  color:#27acd5; }
h5 { font: bold 20px/24px Lato;  color:#27acd5; }
h6 { font: bold 18px/22px Lato;  color:#27acd5; }
body { font-weight: normal;}
.logo_h__txt, .logo_link { font: normal 36px/48px Satisfy;  color:#e23722; }
.sf-menu > li > a { font: normal 14px/17px Lato;  color:#382f25; }
.nav.footer-nav a { font: normal 14px/17px Lato;  color:#72523f; }
</style>
	<script src="js/jssor.slider.min.js" type="text/javascript"></script>
	    <script type="text/javascript">
        jssor_1_slider_init = function() {
            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            var MAX_WIDTH = 3000;
            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;
                if (containerWidth) {
                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        };
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .jssorb032 {position:absolute;}
        .jssorb032 .i {position:absolute;cursor:pointer;}
        .jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
        .jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .i.idn {opacity:.3;}
        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
</head>
<body class="home page page-id-203 page-template page-template-page-home-php">
	<div id="motopress-main" class="main-holder">
		<!--Begin #motopress-main-->
		<?php include("header.php"); ?>
	<div class="motopress-wrapper content-holder clearfix">
	<div class="w3-content w3-display-container">
                      <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:200px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
           
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:450px;overflow:hidden;">
            <div>
                <img data-u="image" src="images/banner.jpg" />
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>             
</div>
	<div class="container">
		<div class="row">
			<div class="span12" data-motopress-wrapper-file="page-fullwidth.php" data-motopress-wrapper-type="content">
				<div class="row">
					<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
						<section class="title-section">
					
				<!-- BEGIN BREADCRUMBS-->
					<!-- END BREADCRUMBS -->
	</section><!-- .title-section -->
					</div>
				</div>
				<div id="content" class="row">
					<div class="span12" data-motopress-type="loop" data-motopress-loop-file="loop/loop-page.php">
							<div id="post-14" class="post-14 page type-page status-publish hentry page">
		<div class="row">


<div class="span8">
<div  id="wpcf7-f208-p14-o1">
<form action="#" method="post" class="wpcf7-form" novalidate>
	<?php if($_GET['m']=='n')
					{?>
						<h3 align="center">THANK YOU, FOR YOUR VALUABLE FEEDBACK.</h3>
						<?php }else{?>
<h1 class="title-header">Donation</h1>
	<?php }?>
<div class="row-fluid">
<p class="span12 field"><span class="wpcf7-form-control-wrap your-name"><input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name:" /></span> </p>
</div>
<div class="row-fluid">
<p class="span12 field"><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="E-mail:" /></span> </p>
</div>
<div class="row-fluid">
<p class="span12 field"><span class="wpcf7-form-control-wrap your-phone"><input type="text" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Phone:" /></span> </p>
</div>

<p class="field"><span class="wpcf7-form-control-wrap your-message"><textarea name="address" cols="4" rows="5" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Address:"></textarea></span> </p>
<div class="row-fluid">
<p class="span12 field"><span class="wpcf7-form-control-wrap your-phone">
<input type="text" name="amount" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Donation Amount :" /></span> </p>
</div>
<p class="submit-wrap"><input type="submit" value="SUBMIT" name="submit" class="wpcf7-form-control wpcf7-submit btn btn-primary" /></p>

<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div>
<div class="span12">
<br><br></div>


	
	</div>
	
		<?php include("footer.php"); ?>
		<script type='text/javascript' src='js/jquery.form.min.js'></script>
<script type='text/javascript' src='js/scripts.js'></script>
<script type='text/javascript' src='js/superfish.js'></script>
<script type='text/javascript' src='js/jquery.mobilemenu.js'></script>
<script type='text/javascript' src='js/jquery.magnific-popup.min.js'></script>
</body>
</html>