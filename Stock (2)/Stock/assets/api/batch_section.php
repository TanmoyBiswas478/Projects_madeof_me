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

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('batch', $data1);
}

// View data into the the table 
else if($op=='view')
{
 $obj->view_db('batch'); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('batch', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('batch', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('batch', $data1,$where);
}

// Query section
else if($op=='training_view')
{
 unset($data1['op']);
 $cat=$data1['category'];
 $sql="select tname from training where category='".$cat."'";
 $obj->select_query($sql);
}

else if($op=='batch_no')
{
 unset($data1['op']);
 $tname=$data1['tname'];
 $sql="select max(bno) bno from batch where tname='".$tname."'";
 $obj->select_query($sql);
}


?>