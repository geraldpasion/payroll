 <!DOCTYPE html>
<html>

	<head>
		<?php
			include('menuheader.php');
		?>
		<title>BIR Table</title>
		<style>
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			
			.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
			.zx{
			border: none;
			border-color: transparent;
			margin-top:1.5%;
			}
		
		</style>	
		<script type="text/javascript">

			$(document).on("click", ".editempdialog", function () {

			 var tax_id = $(this).data('tax_id');	
			 var TaxType = $(this).data('taxtype');
			 var TaxCode = $(this).data('taxcode');
			 var Level = $(this).data('level');
			 var GrossCheck = $(this).data('grosscheck');
			 var FixedTaxAmount = $(this).data('fixedtaxamount');
			 var PercentOver = $(this).data('percentover');
			 


			 $(".modal-body #tax_id").val( tax_id );
			 $(".modal-body #TaxType").val( TaxType );
			 $(".modal-body #TaxCode").val( TaxCode );
			 $(".modal-body #Level").val( Level );
			 $(".modal-body #GrossCheck").val( GrossCheck );
			 $(".modal-body #FixedTaxAmount").val( FixedTaxAmount );
			 $(".modal-body #PercentOver").val( PercentOver );
			 });
			
		</script>			
				<script type="text/javascript">
			$(document).ready(function(){
				 showEdited=function(){
			toastr.options = { 
						"closeButton": true,
					  "debug": false,
					  "progressBar": true,
					  "preventDuplicates": true,
					  "positionClass": "toast-top-right",
					  "onclick": null,
					  "showDuration": "400",
					  "hideDuration": "1000",
					  "timeOut": "7000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut" // 1.5s
						}
						toastr.success("BIR table successfully edited!");
				}
				//history.replaceState({}, "Title", "birtable.php");
				
			});
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
		    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>BIR Table</h5>
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
				<?php
				//generate table here
				include 'testtable.php';


				TaxValuesFunct(1);

				?>
				</div>
			</div>
        </div>
	</div>
		<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog modal-small">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<i class="fa fa-edit modal-icon"></i>
					<h4 class="modal-title">Edit BIR</h4>
				</div>
				<div class="modal-body">
					<div class="ibox-content">
						<form id = "myForm" method="POST" action = "taxtableexe.php" class="form-horizontal">
						<input id = "id" name = "id" type="hidden" class="form-control" readonly = "readonly">
							
						<?php 

						 $fields=array(
						 'tax_id',
				     	'TaxType',
				     	'TaxCode',
				     	'Level',
				     	'GrossCheck',
				     	'FixedTaxAmount',
				     	'PercentOver'
				     	);

						foreach ($fields as $field){

						?>

							<div class="form-group">
								<div class = "col-sm-1"></div>
								<label class="col-sm-2 control-label"><?php echo $field ?></label>
								<div class="col-md-8"><?php 

								if($field=='tax_id' || $field=='TaxType' || $field=='TaxCode' || $field=='Level') //readonly
								echo '<input id = "'.$field.'" name = "'.$field.'" type="text" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)" readonly>';
								else
								echo '<input id = "'.$field.'" name = "'.$field.'" type="text" onpaste="return false" onDrop="return false" class="form-control" onKeyPress="return doubleonly(this, event)">';

								 ?></div>
							</div>
							
						<?php 
						
						}
						?>						
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
		
		
		<?php
			include('menufooter.php');
		?>
	</body>
</html>