<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$pay=$data1['pay'];
$type='Bill';
$inv=$data1['inv'];
if($pay==='Cash'){
  $cash=$data1['gtotal'];
  $card=0.00;
  $upi=0.00;
}
else if($pay==='Card'){
    $card=$data1['gtotal'];
    $cash=0.00;
    $upi=0.00;
}
else{
    $upi=$data1['gtotal'];
    $cash=0.00;
    $card=0.00;
}

$sql="update sales_master set tmode='".$pay."',type='".$type."',cash='".$cash."',upi='".$upi."',card='".$card."' where sinv='".$inv."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if($res){
    echo "Bill Successfully Submited...";
}
else{
    echo "Error....";
}
mysqli_close($con);
?>