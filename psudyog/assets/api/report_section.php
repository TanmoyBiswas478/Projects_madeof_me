<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
//$inv=$data1['pinv'];
$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

if($op=='purchase_vendor')
{
 $obj->group_view('purchase_master','vendore'); 
}

// if($op=='purchase_view')
// {
//  $obj->view_db('purchase_master'); 
// }

else if($op=='purchase_total')
{
 if(empty($data1['vendor'])){
 $obj->purchase_total('purchase_master');
 }
 else{
    $obj->purchase_total("purchase_master where vendore='".$data1['vendor']."'"); 
 }
}

else if($op=='purchase_details')
{
 $inv="where pinv='".$data1['pinv']."'";
 $obj->purchase_view('purchase',$inv);
}

else if($op=='purchase_details1')
{
 $vendor="where vendore='".$data1['vendor']."'";
 $obj->purchase_view('purchase_master',$vendor);
}

?>
