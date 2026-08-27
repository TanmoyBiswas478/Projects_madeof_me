<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$aadhaar=$data1['aadhaar'];

$sql="select * from reg where aadhaar='".$aadhaar."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
$output=array($c);
echo json_encode($output);
mysqli_close($con);
?>