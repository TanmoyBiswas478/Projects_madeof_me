<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$inv=$data1['pinv'];
$data1['user']=$_SESSION['user'];
$sname=$_SESSION['sname'];
// *** Create new object for class database
$obj=new database();  

if($op=='purchase_view')
{
 $obj->view_db('purchase_master',$sname); 
 
}

else if($op=='purchase_total')
{
 $obj->purchase_total('purchase_master',$sname);
}

else if($op=='purchase_details')
{
 $obj->purchase_view('purchase',$inv);
}

?>
