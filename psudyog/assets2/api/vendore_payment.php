<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="Admin";
$month=date("F").'-'.date("Y");
$data1['month']=$month;
$data1['user']=$_SESSION['user'];


// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('vendor_pay', $data1);
}

// View data into the the table 
// else if($op=='view')
// {
//  $obj->view_db('vendor_pay'); 
// }

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('vendor_pay', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('vendor_pay', $data1);
}

// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('vendor_pay', $data1,$where);
}

// Select data into the table 
else if($op=='view')
{
 unset($data1['op']);
 $where = "debit >0.00 and month='".$month."'";
 $obj->select_db('vendor_pay', $data1,$where);
}

else if($op=='select_vendor_pay')
{
 unset($data1['op']);
 $where = "vname ='".$data1['vname']."'";
 $obj->select_db('vendor_pay', $data1,$where);
}

else if($op=='ledger')
{
 unset($data1['op']);
 $where = 1;
 $obj->ledger('vendor_pay', $data1,$where);
}
?>