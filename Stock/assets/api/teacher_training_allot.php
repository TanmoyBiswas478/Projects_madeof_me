<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="teacher";
$data1['user']=$_SESSION['user'];


// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='view')
{
 unset($data1['op']);
 $user=$_SESSION['name'];
 $sql="SELECT distinct(tname) FROM `batch` WHERE trname='".$user."'";
 $obj->select_query($sql); 
}
?>