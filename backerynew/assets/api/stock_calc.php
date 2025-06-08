<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

//print_r($data1);

$product=$data1['product'];
$qty=$data1['qty'];
$unit=$data1['unit'];
$unit=strtoupper($unit);

$sql="select unit,rate,gst from stock where product='".$product."' and status='Not Expair'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_assoc($res))
{
 $unit1=$row['unit'];
 $unit1=strtoupper($unit1);
 $rate1=$row['rate'];
 $gst=$row['gst'];
 $gstamt=($rate1*$gst)/100;
 $rate1=$rate1+$gstamt;
 $rate1 = number_format($rate1,2); 
}

if($unit==$unit1){
    $rate2=$rate1;
    $total=$qty*$rate2;
}
else{
   $rate2=$rate1/1000; 
   $total=$qty*$rate2;
}
$total = number_format($total,2); 
$output=array($rate2,$total);
echo json_encode($output);
mysqli_close($con);
?>