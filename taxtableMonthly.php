<?php

function TaxMonthly($TaxCode, $NetTaxableIncome, $cutoff){

 
ob_start();
$TaxValues=TaxValuesFunct();
ob_end_clean();
  //initialized
  $NetIncomeAfterTax=0;

  //prepare array
  $TaxDetails = array();

  echo '<br>TaxCode: '.$TaxCode.'<br>';

  //find right values
  for($i=7; $i>0; $i--){
    $Level='Level'.($i+1);
    //echo $i.'<br>';
    
    if($NetTaxableIncome>=$TaxValues[$cutoff][$TaxCode][$Level]['GrossCheck']){

      echo 'NetTaxableIncome: '.$NetTaxableIncome.'<br>';
      echo $Level.'<br>';
      $grosscheck = $TaxValues[$cutoff][$TaxCode][$Level]['GrossCheck'];
      echo 'GrossCheck: '.$grosscheck.'<br>';

      $TaxDetails[]=$Level;
      $TaxDetails[]=$grosscheck;
      
      //get value of Fixed Tax Amount from table
      $FixedTaxAmount=$TaxValues[$cutoff][$TaxCode][$Level]['FixedTaxAmount'];
      echo "FixedTaxAmount: ".$FixedTaxAmount.'<br>';

      $TaxDetails[]=$FixedTaxAmount;
      //minus Fixed Tax Amount to Gross
      //$GrossMinusFixedTax = $NetTaxableIncome - $FixedTaxAmount;
      //echo 'GrossMinusFixedTax: '.$GrossMinusFixedTax.'<br>';

      //get % Over
      $PercentOver = $TaxValues[$cutoff][$TaxCode][$Level]['PercentOver'];
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