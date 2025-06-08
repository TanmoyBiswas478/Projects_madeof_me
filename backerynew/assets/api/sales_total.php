<?php 
session_start();
$con=mysqli_connect("localhost","root","","restro") or die(mysqli_error($con));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data=json_decode(file_get_contents("php://input"),true);

$invno=$data['invno'];

$sql="select sum(gstamt) gstamt,sum(total) total from sales where invno='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res)){
    $gstamt=$row['gstamt'];
    $total=$row['total'];
}
$output=array($gstamt,$total);
echo json_encode($output);
mysqli_close($con);
?>