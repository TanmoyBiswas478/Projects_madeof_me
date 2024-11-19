<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
//$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

if($op=='view')
{
 unset($data1['op']);
 $mobile=$data1['mobile'];
 $sql="select * from patient where mobile='".$mobile."'";
 $obj->select_query($sql); 
}
if($op=='view1')
{
 unset($data1['op']);
 $patient_id=$data1['patient_id'];
 $sql="select * from patient where patient_id='".$patient_id."'";
 $obj->select_query($sql); 
}

?>