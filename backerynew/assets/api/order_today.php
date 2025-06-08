<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1 = json_decode(file_get_contents("php://input"), true);

$output=array();
$doe=date('Y-m-d');
$sql="select * from ordertb  where status='Pending' and rdate='".$doe."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $output[]=$row;
}
echo json_encode($output);
mysqli_close($con);
?>