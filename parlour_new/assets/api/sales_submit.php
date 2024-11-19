<?php 
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$pay=$data1['pay'];
$type=$data1['type'];
$invno=$data1['inv'];
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
$sql="update sales_master set tax=(SELECT sum(tax) tax FROM `sales` WHERE invno='$invno'),
cgsta=(SELECT sum(cgsta) cgsta FROM `sales` WHERE invno='$invno'),
sgsta=(SELECT sum(cgsta) sgsta FROM `sales` WHERE invno='$invno'),
igsta=(SELECT sum(igsta) igsta FROM `sales` WHERE invno='$invno'),
total=(SELECT sum(total) total FROM `sales` WHERE invno='$invno'),
pay='".$pay."',type='".$type."',cash='".$cash."',upi='".$upi."',card='".$card."' where invno='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if($res){

    if($type=='Bill'){
    echo "Bill Successfully Submited...";
    }
    else{
        echo "Appoinment Successfully Done..."; 
    }
}
else{
    echo "Error....";
}
mysqli_close($con);
?>