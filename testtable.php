<?php


function TaxValuesFunct($editflag=0){
  include 'dbconfig.php';
         
		$sql = 
		"SELECT *
		FROM taxtable
		INNER JOIN taxtable_meta
		ON taxtable.id=taxtable_meta.tax_id";
     
     //select these fields from two tables
     $fields=array(
        'tax_id',
     	'TaxType',
     	'TaxCode',
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
         	echo "<table id='taxtblid' class='footable table table-stripped table-hover table-responsive' data-page-size='1000' data-filter=#filter>";

            //table headers
         	echo "<tr>";
         	echo "<td align='right'><b>#</b></td>";
         	foreach ($fields as $field){
         			echo "<td align='right'><b>".$field."</b></td>";
         	}
            //additional column for edit button
                if ($editflag==1){
                    echo "<td align='right'></td>";
                }
         	echo "</tr>";
         	
            //table values per row
                 while($row = $result->fetch_assoc()) {
       				//echo $count.": ".$row['Level']."<br>";
       				echo "<tr>";
                 	echo "<td align='right'>".$count."</td>";
                 	foreach($fields as $field){ //generate data horizontally
                 		
                        if($field=='GrossCheck' || $field=='FixedTaxAmount')
                            echo "<td align='right'>".number_format($row[$field],2)."</td>";
                        else if($field=='PercentOver')
                            echo "<td align='right'>".$row[$field]."%</td>";
                        else
                            echo "<td align='right'>".$row[$field]."</td>";
                 	}


            //additional column for edit button
                if ($editflag==1){
                    echo "<td><a href='#' data-toggle='modal' data-target='#myModal4' class = 'editempdialog' id='editempdialog'";
                               
                               foreach($fields as $field){
                                echo "data-".$field."=".$row[$field]." ";
                               }


                         echo "                >                                              
                        <button class='btn btn-info editempdialog' name = 'edit' type='button'><i class='fa fa-paste'></i> Edit</button></a></td>";
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





return $TaxValues;
}// endTaxValues();



//call function
//TaxValuesFunct();

?>