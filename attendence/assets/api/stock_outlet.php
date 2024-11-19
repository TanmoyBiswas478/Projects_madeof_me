<?php 
// include 'connect.php';
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
// header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
// $data1=json_decode(file_get_contents("php://input"),true);

// $product='DEMO1';
// $sqty=15;

// $query = "SELECT * FROM stock WHERE product = $product and qty>0 ORDER BY exp_date ASC LIMIT 1";
// $result = mysqli_query($connection, $query);
// $pdata = mysqli_fetch_assoc($result);
// if ($pdata) 
// {
//  $category=$pdata['category'];
//  $product=$pdata['product'];
//  $hsn=$pdata['hsn'];
//  $qty=$pdata['qty'];
//  $unit=$pdata['unit'];
//  $bno=$pdata['bno'];
//  $expdate=$pdata['expdate'];
//  $rate=$pdata['rate'];
//  $gst=$pdata['gst'];
//  $rqty=$sqty-$qty;
//  if($rqty>0)
//  {
//     $query = "SELECT * FROM stock WHERE product = $product and qty>0 ORDER BY exp_date ASC LIMIT 1";
//     $result = mysqli_query($connection, $query);
//     $pdata = mysqli_fetch_assoc($result);
//     if ($pdata) 
//     {
//      $category=$pdata['category'];
//      $product=$pdata['product'];
//      $hsn=$pdata['hsn'];
//      $qty=$pdata['qty'];
//      $unit=$pdata['unit'];
//      $bno=$pdata['bno'];
//      $expdate=$pdata['expdate'];
//      $rate=$pdata['rate'];
//      $gst=$pdata['gst'];

//  }
//  else{
//  $sql="insert into outlet_stock(category,product,hsn,qty,unit,bno,expdate,rate,gst,outlet_name) 
//  values('".$category."','".$product."','".$hsn."','".$sqty."','".$unit."','".$bno."','".$expdate."','".$rate."','".$gst."','".$oname."')";
//  $res=mysqli_query($con,$sql) or die(mysqli_error($con));

//  if($res){
//     $sql="update stock set qty=$qty-$sqty where bno='".$bno."'";
//     $res=mysqli_query($con,$sql) or die(mysqli_error($con));
//  }

//  }

// }


?>