<?php
require_once("../private/initialize.php");
if(!$session->is_logged_in_as_admin() ) {
  $session->message("Please LogIn First");
  $session->message_type("warning");
  redirect_to("login.php");
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
                                    <h2>Origin Page</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table ">
                                        <thead>
                                            <tr class="headings">
                                                <th>id </th>
                                                <th>content</th>
											    
                                                <th>video</th>  
                                                <th class=" no-link last"><span class="nobr">Action</span></th>
                                            </tr>
                                        </thead>
                                        <?php
                                    
                                          $product_set = temple::find_all();
                                  
                               

                                      ?>
                                        <tbody>
                                          <?php foreach($product_set as $ps): ?>
                                            <tr>
                                            <td><?php echo $ps->id; ?></td>
								             <td><?php echo $ps->content; ?></td>

                                            
                                            <td> <img src='../origin/<?php echo $ps->image; ?>' alt='Photo' class='img-rounded' style='width:120px; height: 100px;'></td>

                                              
                                            <td>
                                                 <a href="edit_temple.php?id=<?php echo $ps->id; ?>">
                                                <button type="button" class="btn btn-primary btn-xs">Edit <i class="fa fa-pencil"></i></button>
                                                </a>
                                           
                                            </td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                <div class="clearfix"></div>
                <?php include_layout_template('admin'.DS.'foot.php'); ?>
            </div>
            <!-- /page content -->

        </div>

    </div>

      <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    
    <!-- /footer content -->
    <link href="../public/css/tableTools.css" rel="stylesheet">
    <link href="../public/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <script src="../public/js/bootstrap.min.js"></script>

    <!-- bootstrap progress js -->
    <script src="../public/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../public/js/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="../public/js/custom.js"></script>

    <script src="../public/js/datatables/js/jquery.dataTables.js"></script>
    <script src="../public/js/datatables/tools/js/dataTables.tableTools.js"></script>
    
    <script>
        $(document).ready( function () {
            $('#example').dataTable( {
                "dom": 'T<"clear">lfrtip',
                "sPaginationType": "full_numbers",
                "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [2]
                        } //disables sorting for column one
                ],
                "tableTools": {
                    "sSwfPath": "../public/js/Datatables/tools/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                    {
                        "sExtends": "copy",
                        "mColumns": [0, 1]
                    },
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1]
                    },
                    {
                        "sExtends": "print",
                        "mColumns": [0, 1],
                    },
                ]
                }
            } );
        } );
        
    </script>

    
</body>

</html>
