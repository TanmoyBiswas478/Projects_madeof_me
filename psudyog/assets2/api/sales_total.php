<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data=json_decode(file_get_contents("php://input"),true);

$invno=$data['sinv'];

$sql="select sum(tax) tax,sum(gstamt) gstamt,sum(total) total from sales where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res)){
    $gtax=$row['tax'];
    $gstamt=$row['gstamt'];
    $total=$row['total'];
}
$output=array($gtax,$gstamt,$total);
echo json_encode($output);
mysqli_close($con);
?>