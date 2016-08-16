<?php

function TaxSemiMonthly($TaxCode, $NetTaxableIncome, $return_grosscheck=0){

  $TaxValues = array( 
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

  //initialized
  $NetIncomeAfterTax=0;

  //prepare array
  $TaxDetails = array();

  echo '<br>TaxCode: '.$TaxCode.'<br>';

  //find right values
	for($i=7; $i>0; $i--){
		$Level='Level'.($i+1);
		//echo $i.'<br>';
		
		if($NetTaxableIncome>=$TaxValues[$TaxCode][$Level]['GrossCheck']){

			echo 'NetTaxableIncome: '.$NetTaxableIncome.'<br>';
      echo $Level.'<br>';
      $grosscheck = $TaxValues[$TaxCode][$Level]['GrossCheck'];
      echo 'GrossCheck: '.$grosscheck.'<br>';

      $TaxDetails[]=$Level;
      $TaxDetails[]=$grosscheck;

      /*if($return_grosscheck>0){
        return $grosscheck;
        break;
      }*/
      
      //get value of Fixed Tax Amount from table
      $FixedTaxAmount=$TaxValues[$TaxCode][$Level]['FixedTaxAmount'];
      echo "FixedTaxAmount: ".$FixedTaxAmount.'<br>';

      $TaxDetails[]=$FixedTaxAmount;
      //minus Fixed Tax Amount to Gross
      //$GrossMinusFixedTax = $NetTaxableIncome - $FixedTaxAmount;
      //echo 'GrossMinusFixedTax: '.$GrossMinusFixedTax.'<br>';

      //get % Over
      $PercentOver = $TaxValues[$TaxCode][$Level]['PercentOver'];
      echo 'PercentOver: '.$PercentOver.'<br>';
      $TaxDetails[]=$PercentOver;

      $Difference = $NetTaxableIncome - $grosscheck;
      echo "Difference(NetTaxableIncome - grosscheck): ".$Difference."<br>";
      $TaxDetails[]=$Difference;

      $PercentedDifferenceGross = $Difference * ($PercentOver/100);
      echo 'PercentedDifferenceGross(Difference * (PercentOver/100): '.$PercentedDifferenceGross.'<br>';
      $TaxDetails[]=$PercentedDifferenceGross;

      $total_tax=$PercentedDifferenceGross+$FixedTaxAmount;
      echo 'Total tax ('.$FixedTaxAmount.'+'.$PercentedDifferenceGross.'): '.$total_tax."<br>";
      $TaxDetails[]=$total_tax;

      $NetIncomeAfterTax = $NetTaxableIncome - $FixedTaxAmount - $PercentedDifferenceGross;
      $TaxDetails[]=$NetIncomeAfterTax;


      echo '<br>NetIncomeAfterTax: '.$NetIncomeAfterTax."<br>";
      return $TaxDetails;
      //echo 'NetIncomeAfterTax: '.$NetIncomeAfterTax.'<br>';
      break;
		}


	}

  if ($NetIncomeAfterTax==0)
    {      
      $NetIncomeAfterTax=$NetTaxableIncome;
      //return empty taxdetails
      $EmptyTaxDetails = array (0,0,0,0,0,0,0,$NetIncomeAfterTax);
      return $EmptyTaxDetails;
     // $TaxDetails=(0,0,0,0,0,0,$NetIncomeAfterTax);
    }

	

  /*
  TaxDetails[]
  0. Level
  1. GrossCheck
  2. FixedAmount
  3. PercentOver
  4. Difference
  5. PercentedDifferenceGross
  6. total_tax //Withholding Tax
  7. NetIncomeAfterTax
  */

	//return $NetIncomeAfterTax;
  
}//end function


/*for testing purposes
$TaxCode='ME4/S4';
$NetTaxableIncome=17000;
TaxSemiMonthly($TaxCode, $NetTaxableIncome);
*/

?>