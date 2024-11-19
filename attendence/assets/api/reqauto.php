<?php 
include 'connnect.php';
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
  $sql = "SELECT MAX(CAST(SUBSTRING(reqno,11, length(reqno)-10) AS UNSIGNED)) ino FROM requision";
  $result = mysqli_query($con,$sql) or die(mysqli_error($con));
  while ($row = mysqli_fetch_array($result)) {
         $i = $row['ino'];	
     }
     if (empty($i)) {
      $i ="REQ/".$year."/1";
     } else {
        $i = $i + 1;
        $i = "REQ/".$year."/".$i;
    }
    $output= array($i,$dot,$year);
    echo json_encode($output);
} 
catch (Exception $ex) {
}
mysqli_close($con);
?>