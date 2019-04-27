<?php

$count = 0 ;
$number = 2 ;
// assigned no of pirme no's to primelimt variable
$primelimit = 10;
$primeNo = array();
// Below is the loop to find the first given no of prime no's
while ($count < $primelimit ){
 $div_count=0;
  for ( $i=1;$i<=$number;$i++){
      if (($number%$i)==0){
       $div_count++;
      }
  }
  if ($div_count<3){ // Prime no logic
      $primeNo[]= $number;
      $count=$count+1;
  }
  $number=$number+1;
}


echo "<table width='100%'>";
echo "<tr><td></td>";
$secrow= '';
foreach($primeNo as $key =>$val){
  echo "<td width='10px'>".$val."</td>";
    $secrow.='--';
}
echo "</tr><tr><td colspan='".$primelimit."'>".$secrow."</td></tr>";
echo "</tr>";
for($i =0; $i<count($primeNo); $i++){
  echo "<tr>";
  for($j=0; $j<count($primeNo); $j++){
      
      if($j==0){
          echo "<td>".$primeNo[$i]."|</td>";
      }
	// Printing the multiple of prime table.
      echo " <td width='10px'>". $primeNo[$i]*$primeNo[$j]."<td>";
      
    }
  echo "</tr>";
}
?>
