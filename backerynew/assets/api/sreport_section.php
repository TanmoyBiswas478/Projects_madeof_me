<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

if($op=='sales_vendor')
{
 $obj->group_view('sales_master','ph'); 
}

else if($op=='sales_total')
{
 if(empty($data1['ph'])){
 $obj->purchase_total('sales_master');
 }
 else{
    $obj->purchase_total("sales_master where ph='".$data1['ph']."'"); 
 }
}

else if($op=='sales_details')
{
 $inv="where sinv='".$data1['sinv']."'";
 $obj->purchase_view('sales',$inv);
}

else if($op=='sales_details1')
{
 $ph="where ph='".$data1['ph']."'";
 $obj->purchase_view('sales_master',$ph);
}
?>
