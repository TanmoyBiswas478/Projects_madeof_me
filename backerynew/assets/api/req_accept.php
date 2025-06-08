<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$reqno=$data1['reqno'];
$item=$data1['item'];
$sqty=$data1['qty'];
$doe=date('Y-m-d');

$sql="SELECT * FROM `stock` WHERE `product`='".$item."' and status='Not Expair' order by expdate ASC limit 0,1"; 
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res)){
    $product=$row['product'];
    $hsn=$row['hsn'];
    $qty=$row['qty'];
    $unit=$row['unit'];
    $bno=$row['bno'];
    $expdate=$row['expdate'];
    $rate=$row['rate'];
    $srate=$row['srate'];
    $gst=$row['gst'];
}

$sql1="select * from outlet_stock where product='".$item."' and expdate='".$expdate."'";
$res1=mysqli_query($con,$sql1) or die(mysqli_error($con));
$c=mysqli_num_rows($res1);

if($c==0){
  $sql2="insert into outlet_stock(product,hsn,qty,unit,bno,expdate,rate,srate,gst,outlet_name) values('".$product."','".$product."','".$sqty."','".$unit."','".$bno."','".$expdate."','".$rate."','".$srate."','".$gst."','Outlet-1')";
  $res2=mysqli_query($con,$sql2) or die(mysqli_error($con));
  if($res2){
    $sql3="update requision set status='Outlet Accept',doa='".$doe."' where item='".$product."' and reqno='".$reqno."'";
    $res3=mysqli_query($con,$sql3) or die(mysqli_error($con));
  }
}
else{
  while($rows=mysqli_fetch_array($res1)){
   $qty1=$rows['qty']+$sqty;
  }
  $sql2="update outlet_stock set qty='".$qty1."' where product='".$item."' and expdate='".$expdate."'";
  $res2=mysqli_query($con,$sql2) or die(mysqli_error($con));
  if($res2){
    $sql3="update requision set status='Outlet Accept',doa='".$doe."' where item='".$product."' and reqno='".$reqno."'";
    $res3=mysqli_query($con,$sql3) or die(mysqli_error($con));
  }
}
$qty=$qty-$sqty;
$sql4="update stock set qty='".$qty."' where product='".$item."' and expdate='".$expdate."'";
$res3=mysqli_query($con,$sql4) or die(mysqli_error($con));
echo "Stock insert successfully....";
mysqli_close($con);
?>