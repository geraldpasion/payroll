 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>Loan tracer</title>
		<script type="text/javascript">
			$(function() {
				$('input[name="daterange"]').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true
				});
			});
		</script>
	</head>
<style>



td,th,tbody{
  
    text-align: center;
    padding: 8px;
}
tr:hover{background-color:#f5f5f5}
thead{
	text-align: left;

}
.thead{

	text-align: left;	
}
</style>
	<body>
		    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Loan tracer</h5>
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
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="table">
											<thead>
											<tr id="thead">
												<th>Table</th>
												
												
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>SSS</td>
												<td> <a href = 'ssstable.php'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> View</button></a></td>
											</tr>
											<tr>
												<td>BIR</td>
												<td> <a href = 'birtable.php'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> View</button></a></td>
											</tr>
											<tr>
												<td>Philhealth</td>
												<td> <a href = 'philhealthtable.php'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> View</button></a></td>
											</tr>
											<tr>
												<td>Pagibig</td>
												<td> <a href = 'pagibig.php'><button class='btn btn-success' type='button'><i class='fa fa-print'></i> View</button></a></td>
											</tr>
											</tbody>
										</table>

								

				
			</div>
	
        </div>
        </div>
        </div>

    
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>