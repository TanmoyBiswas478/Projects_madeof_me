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
 $obj->insert_db('role', $data1);
}

// View data into the the table 
else if($op=='view')
{
    $sql="select * from slot order by id asc";
    $obj->select_query($sql); 
}

else if($op=='dview')
{
 $sql="select * from days order by id asc";
 $obj->select_query($sql); 
}

else if($op=='cview')
{
 $days=$data1['days'];
 $sloat=$data1['sloat'];
 echo $sql="SELECT tname,teacher FROM `routine` WHERE days='".$days."' and sloat='".$sloat."'";
 //$obj->select_query($sql); 
}


// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('role', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('role', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('role', $data1,$where);
}
?>