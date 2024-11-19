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

if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('permission', $data1);
}

else if($op=='uview')
{
 unset($data1['op']);
 $obj->view_db('login'); 
}

else if($op=='user_view')
{
 unset($data1['op']);
 $ph=$data1['ph'];
 $sql="select name from staff where ph='".$ph."'";
 $obj->select_query($sql); 
}

else if($op=='mview')
{
 unset($data1['op']);
 $sql="select distinct(menue) menue from navigation";
 $obj->select_query($sql); 
}

else if($op=='sview')
{
 unset($data1['op']);
 $menue=$data1['menue'];
 $sql="select submenu from navigation where menue='".$menue."'";
 $obj->select_query($sql); 
}

else if($op=='view')
{
 unset($data1['op']);
 $ph=$data1['ph'];
 $sql="select * from permission where ph='".$ph."'";
 $obj->select_query($sql); 
}

else if($op=='urlview')
{
 unset($data1['op']);
 $menue=$data1['menue'];
 if(empty($data1['submenue']))
 {
  $sql="select id,url from navigation where menue='".$menue."'";
 }
 else{
  $submenue=$data1['submenue'];
  $sql="select id,url from navigation where menue='".$menue."' and submenu='".$submenue."'";
 }
 $obj->select_query($sql); 
}


?>