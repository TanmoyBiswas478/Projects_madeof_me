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

if($op=='view1')
{
 unset($data1['op']);
 $sql="select * from birth_record";
 $obj->select_query($sql); 
}
if($op=='view2')
{
 unset($data1['op']);
 $sql="select * from death_record";
 $obj->select_query($sql); 
}


else if($op=='aview')
{
 unset($data1['op']);
 //$sql="select l.user,s.name from login l,bed_type s where l.login_status='1' and l.user=s.ph";
 $sql="select * from login where login_status='1'";
 $obj->select_query($sql); 
}

else if($op=='deactive')
{
 unset($data1['op']);
 $idd=$data1['idd'];
 $sql="update login  set login_status='0' where id='".$idd."'";
 $obj->select_query($sql); 
}



?>