<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);
$output=array();
$doe=date('Y-m-d');
$sql="select sum(total) gtotal,sum(cash) gcash,sum(card) gcard,sum(upi) gupi from sales_master where invdate='".$doe."' and sname='".$_SESSION['sname']."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res)){
    $gtotal=$row['gtotal'];
    $gcash=$row['gcash'];
    $gcard=$row['gcard'];
    $gupi=$row['gupi'];
}
$output=array($gtotal,$gcash,$gcard,$gupi);
echo json_encode($output);
mysqli_close($con);
?>