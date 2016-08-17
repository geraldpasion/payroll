<?php


function TaxValuesFunct(){
  include 'dbconfig.php';
         
		$sql = 
		"SELECT *
		FROM taxtable
		INNER JOIN taxtable_meta
		ON taxtable.id=taxtable_meta.tax_id";
     
     //select these fields from two tables
     $fields=array(
     	'TaxType',
     	'TaxCode',
     	'tax_id',
     	'Level',
     	'GrossCheck',
     	'FixedTaxAmount',
     	'PercentOver'
     	);

     //prepare a multidimensional array
     $TaxValues = array();

		$count=1;
     $result = $conn->query($sql);
         if ($result->num_rows > 0) {
         	echo "<table border=1>";

         	echo "<tr>";
         	echo "<th></th>";
         	foreach ($fields as $field){
         			echo "<th>".$field."</th>";
         	}
         	echo "</tr>";
         	
                 while($row = $result->fetch_assoc()) {
       				//echo $count.": ".$row['Level']."<br>";
       				echo "<tr>";
                 	echo "<td>".$count."</td>";
                 	foreach($fields as $field){ //generate data horizontally
                 		echo "<td>".$row[$field]."</td>";

                 		//generate array
                 		//$value=$row[$field];


                 	}

                 	//generate array
                 	$TaxValues[$row['TaxType']][$row['TaxCode']][$row['Level']]['GrossCheck']=$row['GrossCheck'];
                 	$TaxValues[$row['TaxType']][$row['TaxCode']][$row['Level']]['FixedTaxAmount']=$row['FixedTaxAmount'];
                 	$TaxValues[$row['TaxType']][$row['TaxCode']][$row['Level']]['PercentOver']=$row['PercentOver'];

                 	echo "</tr>";
                 	

       				

       				$count++;  
                 }
             echo "</tr>";
             echo "</table>";
         }//end if
echo "<pre>";
print_r($TaxValues);
echo "</pre>";

return $TaxValues;
}// endTaxValues();

//call function
//TaxValuesFunct();

?>