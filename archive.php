<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
        $empLevel = $_SESSION['employee_level'];
        if(isset($_SESSION['logsession']) && $empLevel == '3') {
                include('menuheader.php');

        }else if(isset($_SESSION['logsession']) && $empLevel == '4') {
            include('levelexe.php');
        }
        ?>
        <title>Archive</title>
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <script src="js/plugins/toastr/toastr.min.js"></script>
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">        
                
        <script src="js/keypress.js"></script>
         <script type="text/javascript">
        //  $(document).ready(function(){
        //       showEdited=function(){
        //  toastr.options = { 
        //              "closeButton": true,
        //            "debug": false,
        //            "progressBar": true,
        //            "preventDuplicates": true,
        //            "positionClass": "toast-top-right",
        //            "onclick": null,
        //            "showDuration": "400",
        //            "hideDuration": "1000",
        //            "timeOut": "7000",
        //            "extendedTimeOut": "1000",
        //            "showEasing": "swing",
        //            "hideEasing": "linear",
        //            "showMethod": "fadeIn",
        //            "hideMethod": "fadeOut" // 1.5s
        //              }
        //              toastr.success("Employee team updated!");
        //      }
        //      history.replaceState({}, "Title", "archive.php");
                
        //  });
        // </script>
        <?php
        if(isset($_GET['edited']))
        {
            echo '<script type="text/javascript">'
                    , '$(document).ready(function(){'   
                    , 'showEdited();'
                    , '});' 
               
               , '</script>'
            ;   
        }
        ?>
    </head>
    <body>
        <form name="frmUser" method="post" action="">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Archive</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    

                        <div class="ibox-content">  
                            <div class="form-group">
                            <div class="table-responsive">
                            <div class="col-lg-12">
                                <div class = "col-lg-1 col-md-1 col-sm-5 col-xs-5">
                                    <h4>Search</h4>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <select class = "form-control" id = "selecttype">
                                        <option></option>
                                        <option value = "1">Earnings</option>
                                        <option value = "2">Deductions</option>
                                        <option value = "3">Announcements</option>
                                        <option value = "4">Holiday</option>
                                      </select>
                                    <br>
                                </div>
                    <br>
                    <BR>
                    <BR>
                    <BR>
                                    <div id = "div1" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Earnings</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class = "col-md-2">Max Amount</th>
                                                    <th class = "col-md-5">Type</th>
                                                    <th class = "col-md-3" style='text-align:center'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                            include('dbconfig.php');
                                            if ($result = $mysqli->query("SELECT * FROM earnings_archive ORDER BY earnings_id")) //get records from db
                                            {
                                                if ($result->num_rows > 0) //display records if any
                                                {
                                                    while ($row = mysqli_fetch_object($result))
                                                    {
                                                    
                                                        echo "<tr class = 'josh'>";
                                                        echo "<td>".$row->earnings_name."</td>";
                                                        echo "<td>".$row->earnings_max_amount."</td>";
                                                        echo "<td>".$row->earnings_type."</td>";
                                                        
                                                        //restore
                                                        echo "<td style='text-align:center'><a href='earnings_restore.php?earnings_id=".$row->earnings_id."' class='btn btn-success' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";

                                                        //delete
                                                        echo "<a href='earnings_delete_archive.php?earnings_id=".$row->earnings_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                        
                                                    }
                                                    echo "</table>";
                                                }
                                            }
                                        ?>
                                             </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "first" href = "#first"><<</a>
                                                    </li>
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "prev" href = "#prev"><</a>
                                                    </li>
                                                    <li class = "footable-page active">
                                                      <a data-page = "0" href = "#">1</a>
                                                    </li>
                                                    <li class = "footable-page">
                                                      <a data-page = "1" href = "#">2</a>
                                                    </li>
                                                    <li class = "footable-page ">
                                                      <a data-page = "2" href = "#">3</a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "next" href = "#next">></a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "last" href = "#last">>></a>
                                                    </li>
                                                  </ul>
                                                </td>
                                              </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id = "div2" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Deductions</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class = "col-md-2">Max Amount</th>
                                                    <th class = "col-md-5">Type</th>
                                                    <th class = "col-md-3" style='text-align:center'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                            include('dbconfig.php');
                                            if ($result = $mysqli->query("SELECT * FROM deductions_archive ORDER BY deduction_id")) //get records from db
                                            {
                                                if ($result->num_rows > 0) //display records if any
                                                {
                                                    while ($row = mysqli_fetch_object($result))
                                                    {
                                                    
                                                        echo "<tr class = 'josh'>";
                                                        echo "<td>".$row->deduction_name."</td>";
                                                        echo "<td>".$row->deduction_max_amount."</td>";
                                                        echo "<td>".$row->deduction_type."</td>";
                                                        
                                                        //restore
                                                        echo "<td style='text-align:center'><a href='deduction_restore.php?deduction_id=".$row->deduction_id."' class='btn btn-success' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";

                                                        //delete
                                                        echo "<a href='deduction_delete_archive.php?deduction_id=".$row->deduction_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                        
                                                    }
                                                    echo "</table>";
                                                }
                                            }
                                        ?>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "first" href = "#first"><<</a>
                                                    </li>
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "prev" href = "#prev"><</a>
                                                    </li>
                                                    <li class = "footable-page active">
                                                      <a data-page = "0" href = "#">1</a>
                                                    </li>
                                                    <li class = "footable-page">
                                                      <a data-page = "1" href = "#">2</a>
                                                    </li>
                                                    <li class = "footable-page ">
                                                      <a data-page = "2" href = "#">3</a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "next" href = "#next">></a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "last" href = "#last">>></a>
                                                    </li>
                                                  </ul>
                                                </td>
                                              </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id = "div3">
                                        <div class = "col-md-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Announcements</h4>
                                        </div>
                                        <table style="table-layout: fixed;" class = "footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class = 'josh'>
                                                    <th class = "col-md-5">Date</th>
                                                    <th class = "col-md-5">Announcement</th>
                                                    <th class = "col-md-3" style='text-align:center'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            include('dbconfig.php');
                                            if ($result = $mysqli->query("SELECT * FROM announcement WHERE announcement_archive = 'archive' ORDER BY announcement_date DESC")) //get records from db
                                            {
                                                if ($result->num_rows > 0) //display records if any
                                                {
                                                    while ($row = mysqli_fetch_object($result)){
                                                        echo "<tr>";
                                                            echo "<td>". date("Y-m-d", strtotime($row->announcement_date)) ."</td>";
                                                            echo "<td style='word-wrap: break-word'>". $row->announcement_details ."</td>";
                                                            echo "<td>";

                                                            //restore
                                                            echo "<a href='announcement_restore.php?ann_id=".$row->announcement_id."' class='btn btn-success' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";

                                                            //delete
                                                            echo "<a href='announcement_delete_archive.php?ann_id=".$row->announcement_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";

                                                            "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                        ?>
                                              </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "first" href = "#first"></a>
                                                    </li>
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "prev" href = "#prev"></a>
                                                    </li>
                                                    <li class = "footable-page active">
                                                      <a data-page = "0" href = "#">1</a>
                                                    </li>
                                                    <li class = "footable-page">
                                                      <a data-page = "1" href = "#">2</a>
                                                    </li>
                                                    <li class = "footable-page ">
                                                      <a data-page = "2" href = "#">3</a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "next" href = "#next">></a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "last" href = "#last">>></a>
                                                    </li>
                                                  </ul>
                                                </td>
                                              </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id = "div4" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Holidays</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-page-size='20' data-limit-navigation='5' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "col-md-2">Name</th>
                                                    <th>Date</th>
                                                    <th class = "col-md-5">Type</th>
                                                    <th class = "col-md-3" style='text-align:center'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                         <?php
                                            include('dbconfig.php');
                                            if ($result = $mysqli->query("SELECT * FROM holiday WHERE holiday_archive='archive' ORDER BY holiday_id")) //get records from db
                                            {
                                                if ($result->num_rows > 0) //display records if any
                                                {
                                                    while ($row = mysqli_fetch_object($result))
                                                    {
                                                    
                                                        echo "<tr class = 'josh'>";
                                                        echo "<td>".$row->holiday_name."</td>";
                                                        echo "<td>" . date("Y-m-d",strtotime($row->holiday_date)) . "</td>";
                                                        
                                                        $type = $row->holiday_type;
                                                        if($type == "Special") {
                                                            echo "<td>Special Holiday</td>";
                                                        } else {
                                                            echo "<td>Legal Holiday</td>";
                                                        }

                                                        //restore
                                                        echo "<td style='text-align:center'><a href='holiday_restore.php?holidayid=".$row->holiday_id."' class='btn btn-success' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";

                                                        //delete
                                                        echo "<a href='holiday_delete_archive.php?holidayid=".$row->holiday_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                        
                                                    }
                                                    echo "</table>";
                                                }
                                            }
                                        ?>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan = "78">
                                                  <ul class = "pagination pull-right">
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "first" href = "#first"><<</a>
                                                    </li>
                                                    <li class = "footable-page-arrow disabled">
                                                      <a data-page = "prev" href = "#prev"><</a>
                                                    </li>
                                                    <li class = "footable-page active">
                                                      <a data-page = "0" href = "#">1</a>
                                                    </li>
                                                    <li class = "footable-page">
                                                      <a data-page = "1" href = "#">2</a>
                                                    </li>
                                                    <li class = "footable-page ">
                                                      <a data-page = "2" href = "#">3</a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "next" href = "#next">></a>
                                                    </li>
                                                    <li class = "footable-page-arrow">
                                                      <a data-page = "last" href = "#last">>></a>
                                                    </li>
                                                  </ul>
                                                </td>
                                              </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                   
                                   

                                    <script type="text/javascript">
                                        $(function () {
                                            $('#selecttype').bind('change', function(event) {
                                           var i= $('#selecttype').val();
                                           
                                            if(i=="1")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').show();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
                                             }
                                           else if(i=="2")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').show();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
                                            }
                                            else if(i=="3")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').show();
                                                 $('#div4').hide();
                                            }
                                            else if(i=="4")
                                             {
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').show();
                                            }
                                            });
                                        });
                                    </script>

            <!--Modal for "Delete" record-->
            <div class="modal inmodal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="glyphicon glyphicon-trash modal-icon"></i>
                    <h4 class="modal-title">Delete Entry</h4>
                  </div><!--/.modal-header-->
                  <div class="modal-body">
                    <div class="alert alert-danger">     
                      Are you sure you want to permanently delete this record?
                    </div>
                  </div><!--/.modal-body-->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-ok-sign"></span>&nbsp;Yes</button>
                    <button type="button" class="btn btn-white" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-remove"></span>&nbsp;No</button>
                  </div><!--/.modal-footer-->
                </div>
              </div>
            </div><!--/#myModalDelete-->

            <!--Modal for "Restore" record-->
            <div class="modal inmodal fade" id="myModalRestore" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="glyphicon glyphicon-check modal-icon"></i>
                    <h4 class="modal-title">Restore Entry</h4>
                  </div><!--/.modal-header-->
                  <div class="modal-body">
                    <div class="alert alert-danger">
                      <span class = "glyphicon glyphicon-warning-primary"></span>      
                      Continue restoring this record?
                    </div>
                  </div><!--/.modal-body-->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-ok-sign"></span>&nbsp;Yes</button>
                    <button type="button" class="btn btn-white" style = "width:120px;" data-dismiss = "modal"><span class = "glyphicon glyphicon-remove"></span>&nbsp;No</button>
                  </div><!--/.modal-footer-->
                </div>
              </div>
            </div><!--/#myModalRestore-->           
                
                </div>
        

                                </div>
                            </div>
                        </div>
                    </div>                                
                </div>
            </div>
        
    </body>
    <?php
        include('menufooter.php');
    ?>

</html>