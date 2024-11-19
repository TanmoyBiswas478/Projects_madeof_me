<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data=json_decode(file_get_contents("php://input"),true);

$doe=DATE('Y-m-d');

$sql="select * from sales_master where status='Order'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$o=mysqli_num_rows($res);

$sql="select * from sales_master where status='Delivered'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$d=mysqli_num_rows($res);


$sql="select sum(total) total from purchase_master where fy='23-24'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $ptotal=$row['total'];
}

$sql="select sum(total) total from sales_master where fy='23-24'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $stotal=$row['total'];
}

$output=array($o,$d,$ptotal,$stotal);
echo json_encode($output);
mysqli_close($con);
?>