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
<select>
	<?php 
   for($i = 2000 ; $i <= date('Y'); $i++){
      echo "<option>$i</option>";
   }
?>
</select>
</body>
</html>