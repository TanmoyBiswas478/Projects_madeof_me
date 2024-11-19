<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$data1['sname']=$_SESSION['sname'];
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  


// Select data into the table 
if($op=='select_condition')
{
 unset($data1['op']);
 $where = "category='".$data1['category']."' and sname='".$data1['sname']."'";
 unset($data1['category']);
 $obj->select_db('stock', $data1,$where);
}
?>