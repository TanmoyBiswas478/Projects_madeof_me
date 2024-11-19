<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$output=array();
$sql="SELECT reqno,reqdate,doa,COUNT(item) AS item_count,COUNT(`cancel`) AS item_cancel FROM requision where doa<>'' GROUP BY reqno, reqdate, outlet";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res)){
    $output[]=$row;
}
echo json_encode($output);
mysqli_close($con);

?>