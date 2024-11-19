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

// View data into the the table 
if($op=='view')
{
 $tname=$data1['tname'];
 $sql="SELECT bno from batch WHERE tname='".$tname."'";
 $obj->select_query($sql); 
}
else if($op=='view1')
{
 $user=$_SESSION['name'];
 $tname=$data1['tname'];
 $sql="SELECT bno,trname from batch WHERE tname='".$tname."' and trname='".$user."'";
 $obj->select_query($sql); 
}

?>