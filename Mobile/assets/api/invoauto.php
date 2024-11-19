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
  
  $sql = "SELECT MAX(CAST(SUBSTRING(wno,11, length(wno)-10) AS UNSIGNED)) ino FROM bill";
  $result = mysqli_query($con,$sql) or die(mysqli_error($con));
  while ($row = mysqli_fetch_array($result)) {
         $i = $row['ino'];	
     }
     if (empty($i)) {
      $i ="BPL/".$year."/1";
     } else {
        $i = $i + 1;
        $i = "BPL/".$year."/".$i;
    }
    $output= array($i,$dot,$year);
    echo json_encode($output);
} 
catch (Exception $ex) {
}
mysqli_close($con);
?>