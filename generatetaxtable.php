<?php

include 'dbconfig.php';
include 'functions.php';

//monthly
$TaxValues = array( 
                'Z' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 0,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 883,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 2500,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 5833,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 11667,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 20833,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 41667,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  ),

                'S/ME' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 4167,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 5000,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 6667,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 10000,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 15833,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 25000,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 45833,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  ),

                  'ME1/S1' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 6250,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 7083,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 8750,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 12083,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 17917,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 27083,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 47917,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  

                  ),

                  'ME2/S2' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 8333,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 9167,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 10833,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 14167,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 20000,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 29167,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 50000,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  

                  ),

                  'ME3/S3' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 10417,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 11250,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 12917,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 16250,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 22083,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 31250,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 52083,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  

                  ),

                  'ME4/S4' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 12500,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 13333,
                                        'FixedTaxAmount' => 41.67,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 15000,
                                        'FixedTaxAmount' => 208.33,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 18333,
                                        'FixedTaxAmount' => 708.33,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 24167,
                                        'FixedTaxAmount' => 1875,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 33333,
                                        'FixedTaxAmount' => 4166.67,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 54167,
                                        'FixedTaxAmount' => 10416.67,
                                        'PercentOver' => 32
                                   ),

                  

                  ),


  );//end array TaxValues





//Semi Monthly
$TaxValues_semi = array( 
                'Z' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 0,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 417,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 1250,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 2917,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 5833,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 10417,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 20833,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),

                'S/ME' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 2083,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 2500,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 3333,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 5000,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 7917,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 12500,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 22917,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),

                  'ME1/S1' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 3125,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 3542,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 4375,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 6042,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 8958,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 13542,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 23958,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),

                  'ME2/S2' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 4167,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 4583,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 5417,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 7083,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 10000,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 14583,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 25000,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),

                  'ME3/S3' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 5208,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 5625,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 6458,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 8125,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 11042,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 15625,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 26042,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),

                   'ME4/S4' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 6250,
                                        'FixedTaxAmount' => 0,
                                        'PercentOver' => 5
                                   ),
                       'Level3' => array(
                                        'GrossCheck' => 6667,
                                        'FixedTaxAmount' => 20.83,
                                        'PercentOver' => 10
                                   ),
                       'Level4' => array(
                                        'GrossCheck' => 7500,
                                        'FixedTaxAmount' => 104.17,
                                        'PercentOver' => 15
                                   ),
                       'Level5' => array(
                                        'GrossCheck' => 9167,
                                        'FixedTaxAmount' => 354.17,
                                        'PercentOver' => 20
                                   ),
                       'Level6' => array(
                                        'GrossCheck' => 12083,
                                        'FixedTaxAmount' => 937.50,
                                        'PercentOver' => 25
                                   ),
                       'Level7' => array(
                                        'GrossCheck' => 16667,
                                        'FixedTaxAmount' => 2083.33,
                                        'PercentOver' => 30
                                   ),
                       'Level8' => array(
                                        'GrossCheck' => 27083,
                                        'FixedTaxAmount' => 5208.33,
                                        'PercentOver' => 32
                                   ),

                  ),


  );//end array TaxValues


//clear truncate tables
$tables=array(
	'taxtable',
	'taxtable_meta'
	);

foreach($tables as $tab){
$sql='TRUNCATE TABLE '.$tab;
echo $sql."<br>";
$result = mysqli_query($conn,$sql);

 if ($result) {
   echo "$tab table has been truncated<br>";  
 }
 else echo "Something went wrong: " . mysql_error();
}




$TaxCode = array('Z','S/ME', 'ME1/S1', 'ME2/S2', 'ME3/S3', 'ME4/S4' );
$Level = array(2,3,4,5,6,7,8);
$Options = array('GrossCheck', 'FixedTaxAmount', 'PercentOver');
$Type = array('Monthly', 'Semi-monthly');

$tax_id = 1;
foreach ($Type as $typ){

	foreach ($TaxCode as $tc){	//taxcodes

		$values='('.'"'.$typ.'", "'.$tc.'")';
		$into = '(TaxType, TaxCode)';
		//make insert statement here
		echo $into."<br>";
		echo $tax_id.": ".$values."<br>";

		//insert taxtable
		insert_statement($into, $values, 'taxtable');

//*******************meta******************************

		
			foreach ($Level as $lvl){ //levels
				$level='Level'.$lvl;
					$values_meta = '("'.$tax_id.'", ';
					$values_meta=$values_meta.'"'.$level.'", ';

					foreach($Options as $opt){ //options = grosschecl, fixedtaxamount, PercentOver
						//prepare insert
						if($typ == 'Monthly')
						$db_val=$TaxValues[$tc][$level][$opt];
						else 
						$db_val=$TaxValues_semi[$tc][$level][$opt];
						

						$values_meta=$values_meta.'"'.$db_val.'", ';
						
					}//end options

					$into_meta='(tax_id, Level, GrossCheck, FixedTaxAmount, PercentOver)';
					echo "into_meta: ".$into_meta."<br>";

					$values_meta=substr($values_meta, 0, -2);
					$values_meta=$values_meta.")";
					echo "values_meta: ". $values_meta."<br>";
					

					//insert meta
					insert_statement($into_meta, $values_meta, 'taxtable_meta');

					//reset values_meta
					$values_meta="";

			}//end level
//*****************************************************

		

		echo '<br>';
		$tax_id++;
	}//end taxcode

}//end type






?>