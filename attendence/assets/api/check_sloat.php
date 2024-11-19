<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$doe=date('Y-m-d');

$as=$data1['as'];
$sname=$data1['sname'];

$sql="select * from appoinment where doa='".$doe."' and asloat='".$as."' and sname='".$sname."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
$output=array($c);
echo json_encode($c);
mysqli_close($con);
?>