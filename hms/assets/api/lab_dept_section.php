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
 $obj->insert_db('lab_dept', $data1);
}
else if($op=='view')
{
 unset($data1['op']);
 $sql="select * from lab_dept";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('lab_dept', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('lab_dept', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('lab_dept', $data1,$where);
}
else if($op=='insert1')
{
 unset($data1['op']);
 $obj->insert_db('lab_test', $data1);
}
else if($op=='view1')
{
 unset($data1['op']);
 $sql="select * from lab_test";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit1')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('lab_test', $data1,$where);
}

// Delete data into the table
else if($op=='delete1')
{
 unset($data1['op']);
 $obj->delete_db('lab_test', $data1);
}
// Select data into the table 
else if($op=='select_condition1')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('lab_test', $data1,$where);
}
else if($op=='insert2')
{
 unset($data1['op']);
 $obj->insert_db('lab_charges', $data1);
}
else if($op=='view2')
{
 unset($data1['op']);
 $sql="select * from lab_charges";
 $obj->select_query($sql); 
}

// Update data into the table 
else if($op=='edit2')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['id']);
 $obj->update_db('lab_charges', $data1,$where);
}

// Delete data into the table
else if($op=='delete2')
{
 unset($data1['op']);
 $obj->delete_db('lab_charges', $data1);
}
// Select data into the table 
else if($op=='select_condition2')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('lab_charges', $data1,$where);
}
else if($op=='select_query3')
{
 unset($data1['op']);
 $lab_dept=$data1['lab_dept'];
 $sql="select test from lab_test where lab_dept='".$lab_dept."'";
 $obj->select_query($sql);
}
else if($op=='select_query4')
{
 unset($data1['op']);
 $test=$data1['test'];
 $sql="select test_charge from lab_charges where test='".$test."'";
 $obj->select_query($sql);
}

else if($op=='aview')
{
 unset($data1['op']);
 //$sql="select l.user,s.name from login l,lab_dept s where l.login_status='1' and l.user=s.ph";
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