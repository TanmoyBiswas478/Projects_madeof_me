<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$product=$data1["pname"];

$sql="select hsn from stock where product='".$product."'";
$result1=mysqli_query($con,$sql);
while($row1=mysqli_fetch_array($result1)){
    $output[] = $row1;
}
echo json_encode($output);
mysqli_close($con);
?>