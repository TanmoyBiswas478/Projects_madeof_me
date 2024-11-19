<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="Outlet";

$data1['outlet']='Outlet1';
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('requision', $data1);
}

// View data into the the table 
else if($op=='view')
{
 $obj->view_db('requision'); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "reqno ='".$data1['reqno']."'";
 unset($data1['reqno']);
 $obj->update_db('requision', $data1,$where);
}

else if($op=='update')
{
 unset($data1['op']);
 $data1['doa']=date('Y-m-d');
 $where = "reqno ='".$data1['reqno']."' and item='".$data1['item']."'";
 unset($data1['reqno']);
 $obj->update_db('requision', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('requision', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "reqno ='".$data1['reqno']."' and status='Send to Outlet'";
 unset($data1['reqno']);
 $obj->select_db('requision', $data1,$where);
}
?>