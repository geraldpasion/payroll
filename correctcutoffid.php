<?php
echo(microtime());
?>

<body bgcolor=rgb(88,88,88) >
	<font color=white>
<?php

//require 'rb.php';
include 'functions.php';

//compute('2016-05-16 - 2016-06-15');

$cutoff_field='2016-07-01 - 2016-07-31';
$update=1;
$emp='121';

//compute($cutoff_field, $update, $emp);
compute($cutoff_field,0,0,0);

//delete_emp_salary($cutoff_field, $emp);

//compute_others();


?>
</font>
</body>

<?php
echo(microtime());
?>