<?php
echo(microtime());
?>

<body bgcolor=rgb(88,88,88) >
	<font color=white>
<?php

//require 'rb.php';
include 'functions.php';

//compute('2016-05-16 - 2016-06-15');

$cutoff_field='2016-08-01 - 2016-08-12';
$update=1;
$emp='121';

//compute($cutoff_field, $update, $emp);
//ob_start();
compute($cutoff_field,0,0,0);
//ob_end_clean();
//delete_emp_salary($cutoff_field, $emp);

//compute_others();

//header("Location: processing2.php");
//die();
?>
</font>
</body>

<?php
echo(microtime());
?>