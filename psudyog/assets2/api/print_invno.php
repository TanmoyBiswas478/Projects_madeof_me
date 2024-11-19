<?php
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);
$output=array();

$doe=date('Y-m-d');
$invno=$data1['invno'];
$sql="update sales set status='Send Delivery Boy' where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if($res){
    $sql="update sales_master set status='Send Delivery Boy' where sinv='".$invno."'";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
}
else{
    mysqli_rollback($con);
}
mysqli_close($con);

?>