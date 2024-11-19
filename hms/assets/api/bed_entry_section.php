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
 $obj->insert_db('bed_entry', $data1);
}
else if($op=='view')
{
 unset($data1['op']);
 $sql="select * from bed_entry";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('bed_entry', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('bed_entry', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('bed_entry', $data1,$where);
}

else if($op=='aview')
{
 unset($data1['op']);
 //$sql="select l.user,s.name from login l,bed_entry s where l.login_status='1' and l.user=s.ph";
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
else if($op=='select_query')
{
 unset($data1['op']);
 $dept_ward=$data1['dept_ward'];
 $sql="select bed_type from bed_entry where w_no='".$dept_ward."'";
 $obj->select_query($sql);
}
else if($op=='select_query12')
{
 unset($data1['op']);
 $bed_type=$data1['bed_type'];
 $sql="select bed_no from bed_entry where bed_type='".$bed_type."' and status='0'";
 $obj->select_query($sql);
}
else if($op=='select_query2')
{
 unset($data1['op']);
 $w_no=$data1['w_no'];
 $sql="select w_section from ward_section where w_no='".$w_no."'";
 $obj->select_query($sql);
}
?>