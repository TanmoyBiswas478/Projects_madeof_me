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

// ***** Start Symptoms Type *****
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('symptoms_type', $data1);
}
else if($op=='view')
{
 unset($data1['op']);
 $sql="select * from symptoms_type";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('symptoms_type', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('symptoms_type', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('symptoms_type', $data1,$where);
}
// ***** End Symptoms Type *****

// ***** Start Symptoms head *****
else if($op=='insert1')
{
 unset($data1['op']);
 $obj->insert_db('symptoms_head', $data1);
}
else if($op=='view1')
{
 unset($data1['op']);
 $sql="select * from symptoms_head";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit1')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('symptoms_head', $data1,$where);
}

// Delete data into the table
else if($op=='delete1')
{
 unset($data1['op']);
 $obj->delete_db('symptoms_head', $data1);
}
// Select data into the table 
else if($op=='select_condition1')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('symptoms_head', $data1,$where);
}
// ***** End Symptoms head *****
else if($op=='select_query')
{
 unset($data1['op']);
 $symptoms_type=$data1['symptoms_type'];
 $sql="select symptoms_head,symptoms_description from symptoms_head where symptoms_type='".$symptoms_type."'";
 $obj->select_query($sql); 
}
else if($op=='select_query1')
{
 unset($data1['op']);
 $symptoms_title=$data1['symptoms_title'];
 $sql="select symptoms_description from symptoms_head where symptoms_head='".$symptoms_title."'";
 $obj->select_query($sql); 
}
else if($op=='aview')
{
 unset($data1['op']);
 //$sql="select l.user,s.name from login l,symptoms_type s where l.login_status='1' and l.user=s.ph";
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