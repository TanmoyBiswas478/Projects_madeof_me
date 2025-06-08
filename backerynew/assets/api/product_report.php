<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$doe=date("Y-m-d");
//$doe='2023-10-27';
$output=array();

$sql="SELECT product,sum(qty) qty FROM sales where invdate='".$doe."' GROUP BY product";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res)){
    $output[]=$row;
}
echo json_encode($output);
mysqli_close($con);
?>