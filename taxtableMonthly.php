<?php

function TaxMonthly($TaxCode, $NetTaxableIncome){

  $TaxValues = array( 
                'Z' => array( 
                       'Level2' => array(
                                        'GrossCheck' => 0,
                                        'FixedTaxAmount' => 0,
                                        'PercentOVer' => 5
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
                                        'PercentOVer' => 5
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
                                        'PercentOVer' => 5
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
                                        'PercentOVer' => 5
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
                                        'PercentOVer' => 5
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
                                        'PercentOVer' => 5
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

  //initialized
  $NetIncomeAfterTax=0;


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
      
      //get value of Fixed Tax Amount from table
      $FixedTaxAmount=$TaxValues[$TaxCode][$Level]['FixedTaxAmount'];
      echo "FixedTaxAmount: ".$FixedTaxAmount.'<br>';

      //minus Fixed Tax Amount to Gross
      //$GrossMinusFixedTax = $NetTaxableIncome - $FixedTaxAmount;
      //echo 'GrossMinusFixedTax: '.$GrossMinusFixedTax.'<br>';

      //get % Over
      $PercentOver = $TaxValues[$TaxCode][$Level]['PercentOver'];
      echo 'PercentOver: '.$PercentOver.'<br>';


      $Difference = $NetTaxableIncome - $grosscheck;
      echo "Difference(NetTaxableIncome - grosscheck): ".$Difference."<br>";

      $PercentedDifferenceGross = $Difference * ($PercentOver/100);
      echo 'PercenteDifferenceGross(Difference * (PercentOver/100): '.$PercentedDifferenceGross.'<br>';

      $total_tax=$PercentedDifferenceGross+$FixedTaxAmount;
      echo 'Total tax ('.$FixedTaxAmount.'+'.$PercentedDifferenceGross.'): '.$total_tax."<br>";

      $NetIncomeAfterTax = $NetTaxableIncome - $FixedTaxAmount - $PercentedDifferenceGross;
      //echo 'NetIncomeAfterTax: '.$NetIncomeAfterTax.'<br>';
      break;
    }
    

  }

  if ($NetIncomeAfterTax==0)
    $NetIncomeAfterTax=$NetTaxableIncome;


  echo '<br>NetIncomeAfterTax: '.$NetIncomeAfterTax;

  return $NetIncomeAfterTax;
}//end function


/*for testing purposes
$TaxCode='ME4/S4';
$NetTaxableIncome=100000;
TaxMonthly($TaxCode, $NetTaxableIncome);
*/

?>