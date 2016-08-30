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
        <script type="text/javascript">
            $(document).on("click", ".answerdialog", function () {
             var inqid = $(this).data('announcement');
             var subje = $(this).data('subject');
             
              $(".modal-body #details").val( inqid );
              $(".modal-body #subject").val( subje );
             
             });
        </script>
        <script src="js/keypress.js"></script>
         

        <script type="text/javascript">
 
//delete announcement
        function delete_ann(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dd6b55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Deleted!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "announcement_delete_archive.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
            //  alert('deleted');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}
//restore announcement
function restore_ann(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Yes, restore it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Restored!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "announcement_restore.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
            //  alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}

//delete earnings
        function delete_earnings(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dd6b55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Deleted!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "earnings_delete_archive.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
            //  alert('deleted');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}

//restore earnings
function restore_earnings(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Yes, restore it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Restored!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "earnings_restore.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
             // alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}
//restore_deductions

function restore_deductions(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Yes, restore it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Restored!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "deduction_restore.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
             // alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}
//delete_deductions
function delete_deductions(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dd6b55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
             swal("Deleted!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "deduction_delete_archive.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
             // alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}

//restore_Holidays

function restore_holidays(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Yes, restore it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
            swal("Restored!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "holiday_restore.php",
              async: false,
              method: "GET",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
             // alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}
//delete_holidays
function delete_holidays(id) {
        swal({
        title: "Are you sure?",
        text: "The action you are about to do cannot be undone!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dd6b55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function(isConfirm){   if (isConfirm) { 
             swal("Deleted!", "Your imaginary file has been deleted.", "success");  
            //alert(id);
            
            var id_val = id;
            var request = $.ajax({
              url: "holiday_delete_archive.php",
              async: false,
              method: "POST",
              data: { announcement_id : id_val },
              dataType: "html"
            });
             
            request.done(function( msg ) {
             // alert('restored');
              window.location.replace("http://10.10.1.31/payroll/archive.php");
            });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });

        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } });

}
        </script>
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
                                        <table class = "footable table table-stripped' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" data-page-size='20' data-limit-navigation='5' cellspacing="0" width="100%">
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
                                                        echo "<td style='text-align:center'>";
                                                       // echo"<a href='earnings_restore.php?earnings_id=".$row->earnings_id."' class='btn btn-primary' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";
                                                         echo "<a href='#' class='btn btn-primary' onclick='restore_earnings(".$row->earnings_id.")'>Restore</a>&nbsp;&nbsp;";
                                                            "</td>";
                                                        //delete
                                                       // echo "<a href='earnings_delete_archive.php?earnings_id=".$row->earnings_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                         echo "<a href='#' class='btn btn-danger' onclick='delete_earnings(".$row->earnings_id.")'>Delete</a>&nbsp;&nbsp;";

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
                                        <table class = "footable table table-stripped' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" data-page-size='20' data-limit-navigation='5' cellspacing="0" width="100%">
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
                                                       echo "<td style='text-align:center'>";
                                                        //echo"<a href='deduction_restore.php?deduction_id=".$row->deduction_id."' class='btn btn-primary' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";
                                                        echo "<a href='#' class='btn btn-primary' onclick='restore_deductions(".$row->deduction_id.")'>Restore</a>&nbsp;&nbsp;";

                                                        //delete
                                                       // echo "<a href='deduction_delete_archive.php?deduction_id=".$row->deduction_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                        echo "<a href='#' class='btn btn-danger' onclick='delete_deductions(".$row->deduction_id.")'>Delete</a>&nbsp;&nbsp;";
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
                                        <table style="table-layout: fixed;" class = "footable table table-stripped data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" data-page-size='20' data-limit-navigation='5' cellspacing="0" width="100%">
                                            <thead>
                                                <tr class = 'josh'>
                                                    <th class = "col-md-5">Date</th>
                                                    <th class = "col-md-5">Subject</th>
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
                                                            echo "<td style='word-wrap: break-word'>". $row->subject ."</td>";
                                                            echo "<td>";

                                                            //view
                                                           // echo "<a href='announcement_restore.php?ann_id=".$row->announcement_id."' class='btn btn-success'>View</a>&nbsp;&nbsp;";
                                                            echo "<a href='#' data-toggle='modal' data-target='#myModal4' data-announcement='$row->announcement_details' data-subject = '$row->subject'class = 'answerdialog btn btn-success'>View</a>&nbsp;&nbsp;";
                                                            //restore
                                                           // echo "<a href='announcement_restore.php?ann_id=".$row->announcement_id."' class='btn btn-primary' onclick='restore_ann(".$row->announcement_id.")'>Restore</a>&nbsp;&nbsp;";
                                                             echo "<a href='#' class='btn btn-primary' onclick='restore_ann(".$row->announcement_id.")'>Restore</a>&nbsp;&nbsp; ";

                                                            //delete
                                                            //echo "<a href='announcement_delete_archive.php?ann_id=".$row->announcement_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                            echo "<a href='#' class='btn btn-danger' onclick='delete_ann(".$row->announcement_id.")'>Delete</a>&nbsp;&nbsp; ";
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
                                                  <ul class = "pagination pull-right" data-limit-navigation="5">
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

                                    <div id = "div4" style = "display:none;">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "margin-left:-2em;">
                                            <h4>Deleted List of Holidays</h4>
                                        </div>
                                        <table class = "footable table table-stripped' data-filter=#filter" id="zctb" class="display table table-bordered table-hover sortable" data-page-size='20' data-limit-navigation='5' cellspacing="0" width="100%">
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
                                                        echo "<td style='text-align:center'>";
                                                       // echo"<a href='holiday_restore.php?holidayid=".$row->holiday_id."' class='btn btn-primary' onclick='return confirm(\"Are you sure? You want to Restore this file?\");'>Restore</a>&nbsp;&nbsp;";
                                                        echo "<a href='#' class='btn btn-primary' onclick='restore_holidays(".$row->holiday_id.")'>Restore</a>&nbsp;&nbsp; ";
                                                        //delete
                                                        //echo "<a href='holiday_delete_archive.php?holidayid=".$row->holiday_id."' class='btn btn-danger' onclick='return confirm(\"Are you sure? You want to delete this file?\");'>Delete</a>&nbsp;&nbsp; ";
                                                        echo "<a href='#' class='btn btn-danger' onclick='delete_holidays(".$row->holiday_id.")'>Delete</a>&nbsp;&nbsp; ";
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
                                            $('#div0').hide();
                                            $('#div1').hide();
                                            $('#div2').hide();
                                            $('#div3').hide();
                                            $('#div4').hide();
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
                                            else{
                                                 $('#div0').hide();
                                                 $('#div1').hide();
                                                 $('#div2').hide();
                                                 $('#div3').hide();
                                                 $('#div4').hide();
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
        
        <!--modal view-->
        <div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <i class="fa fa-exclamation-circle modal-icon"></i>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Announcement details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="ibox-content">
                           
                                <div class="form-group">
                                    <div class="col-md-10" id = "quest">
                                    <input id = "inqid" class="form-control" type = "hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Subject</label><br><br>
                                    <div class="col-md-12">
                                    <input type="text"  id = "subject" class="form-control" readonly/>
                                    </div><br><br><br>
                                    <label class="col-sm-1 control-label">Announcement</label><br><br>
                                    <div class="col-md-12">
                                    <textarea  id = "details" class="form-control" style="min-width: 100%; margin: 0px -9px 0px 0px; width: 508px; height: 129px;" readonly></textarea>
                                    </div>

                                </div>
                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
        include('menufooter.php');
    ?>

</html>