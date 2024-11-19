<?php 
session_start();
include 'connect.php';
try 
{
 $month=date('m');
 $year=date('y');
 $dot=date('Y-m-d');
 if($month>='04')
 {
  $x=$year+1;
  $year=$year."-".$x;
 }
 else
 {
  $x=$year-1;
  $year=$x."-".$year;
 }
  $input=$_SESSION['sname'];
  // Step 1: Extract initials of each word
  $words = explode(" ", $input);
  
  $initials = array_map(function($word) {
    return $word[0];
 }, $words);
 // Step 2: Convert initials to uppercase
 $initials = array_map('strtoupper', $initials);
 // Step 3: Concatenate initials to form output
 $output = implode("", $initials);
 $output=substr($output,0,3);

  $sql = "SELECT MAX(CAST(SUBSTRING(sinv,11, length(sinv)-10) AS UNSIGNED)) ino FROM sales_master where sname='".$input."'";
  $result = mysqli_query($con,$sql) or die(mysqli_error($con));
  while ($row = mysqli_fetch_array($result)) {
         $i = $row['ino'];	
     }
     if (empty($i)) {
      $i =$output."/".$year."/1";
     } else {
        $i = $i + 1;
        $i = $output."/".$year."/".$i;
    }
    $output= array($i,$dot,$year);
    echo json_encode($output);
} 
catch (Exception $ex) {
}
mysqli_close($con);
?>