<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

//print_r($data1);

$op=$data1['op'];
$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

if($op=='view')
{
 unset($data1['op']);
 $tname=$data1['tname'];
 $sql="select * from question_bank where tname='".$tname."'";
 $obj->select_query($sql); 
}
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('question_bank', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('question_bank', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('question_bank', $data1,$where);
}
?>