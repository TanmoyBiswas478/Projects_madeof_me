<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$sform=$data1['tname'];
$output=array();

$sql="select * from training where sform='".$sform."' order by tname";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $output[]=$row;
}
echo json_encode($output);
mysqli_close($con);

?>