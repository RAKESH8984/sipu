<?php
require_once("../private/initialize.php");

if(!$session->is_logged_in_as_admin()) {
  $session->message("Please LogIn First");
  $session->message_type("warning");
  redirect_to("login.php");
}


?>
<?php
  if(request_is_post() && request_is_same_domain()) {

    if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
      $message = "Sorry, request was not valid.";
    }
    if(!has_presence($_POST['content'])) {
    $message = "Missing Field Values.";
    $message_type = "danger";
    }else{
      $pl= new photo();
      $pl->content = $_POST['content'];
     

       if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name=$_FILES["uploadedimage"]["name"];
        $temp_name=$_FILES["uploadedimage"]["tmp_name"];
        $imgtype=$_FILES["uploadedimage"]["type"];
        $ext= GetImageExtension($imgtype);
        $imagename= uniqid().$ext;
        $pl->image = $imagename;
         move_uploaded_file($temp_name, "../photo/".$imagename);
         $path="../photo/".$imagename;
         //pjresize($path,$path,350,300,'Y');
        }else
        {
            $pl->image = "no_image.jpg";
        }
     
     
      if($pl->save()) {
        // Success
        $session->message("Image has inserted successfully");
        $session->message_type("success");
        redirect_to('view_photo.php');
      } else {
        // Failure
        $message = "Image Could Not Be Saved.";
        $message_type = "danger";
      }
    }
  }

?>
<?php include_layout_template('admin'.DS.'head.php'); ?>

  <body class="nav-md">
         <div class="container body">


        <div class="main_container">
         <?php 
          
             include_layout_template('admin'.DS.'side_nav.php');
             include_layout_template('admin'.DS.'top_nav.php'); 
         
         ?>
 

            <!-- page content -->
            <div class="right_col" role="main">
            <?php echo output_message($message, $message_type); ?>
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add Photo</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form id="form" action="add_photo.php" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        <?php echo csrf_token_tag(); ?>
                                        <p><code>*</code> Marked Fields Are Compulsory</a></p>
                                        
                                       <!-- Product Name-->
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name">content<span class="text-danger">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="content" placeholder=" content" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>



                                       <!-- Photo Upload -->
                                         <div class="form-group">
                                             <div id="kv-avatar-errors" class="control-label col-md-3 col-sm-3 col-xs-12" style="width:800px;display:none"></div>

                                               <div class="col-md-9"> 
                                               <label class="control-label col-md-4 col-sm-4 col-xs-12"> Upload </label>
                                                  <div class="kv-avatar center-block" style="width:200px">
                                                    <input id="avatar" name="uploadedimage" type="file" class="file-loading">
                                                 </div>
                                            </div>
                                         </div>


                                         
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <input id="send" type="submit" name="submit" class="btn btn-success" value="Submit">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                <div class="clearfix"></div>
               
          
            <!-- /page content -->

  

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    
    <!-- /footer content -->
    
    <script src="public/js/bootstrap.min.js"></script>

    <!-- bootstrap progress js -->
    <script src="../public/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../public/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- form validation -->
    <script type="text/javascript" src="../public/js/parsley/parsley.min.js"></script>

    
      <!-- textarea resize -->
    <script src="../public/js/textarea/autosize.min.js"></script>
    <script>
            autosize($('.resizable_textarea'));
    </script>
    <script src="../public/js/custom.js"></script>

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

       <link href="../plugins/file/fileinput.css" rel="stylesheet">
    <style>
    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }
    </style>
  <script src="../plugins/file/fileinput.js" type="text/javascript"></script>
    <script>
var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
$("#avatar").fileinput({
    overwriteInitial: true,
    maxFileSize: 4500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i> Browse',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i> Remove',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../photo/default_avatar_male.jpg" alt="Photo" style="width:160px">',
    layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif","jpeg","jpe"]
});
</script>

        

    
</body>

</html>
