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

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('client', $data1);
}

// View data into the the table 
else if($op=='view')
{
 $sname=$_SESSION['sname'];
 $obj->view_db('client',$sname);  
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('client', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('client', $data1);
}

// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('client', $data1,$where);
}

// Select data into the table 
else if($op=='select_state')
{
 unset($data1['op']);
 $code=substr($data1['gstno'], 0, 2);
 $where = "code =".$code;
 $obj->select_db('state', $data1,$where);
}

else if($op=='select_client')
{
 unset($data1['op']);
 $sname=$_SESSION['sname'];
 $where = "cname ='".$data1['cname']."' and sname='".$sname."'";
 $obj->select_db('client', $data1,$where);
}

?>