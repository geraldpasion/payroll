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
		</head>
<body>
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>13 Month Pay</h5><br>
	<hr>
	<center>
	<select>
		<?php 
  			 for($i = 2000 ; $i <= date('Y'); $i++){
    			  echo "<option>$i</option>";
  			 }
		?>
	</select>
	<input type="submit"/>
	</center>
</div>
</div>
</div>
</div>

</center>
</body>
</html>