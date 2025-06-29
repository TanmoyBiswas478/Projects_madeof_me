<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="Admin";

$string =$data1['iname'];

// **** Separate section is here ****
if (preg_match('/^([^\(]+)\((\d+)\s*([^\)]+)?\)$/', $string, $matches)) {
    // $matches[1] will contain $x
    $x = trim($matches[1]);

    // $matches[2] will contain $y
    $y = trim($matches[2]);

    // $matches[3] will contain $z (optional)
    $z = isset($matches[3]) ? trim($matches[3]) : null;
    } 
    $data1['iname']=$x;
    $data1['cqty']=$y;
    $data1['cunit']=$z;
    $data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('receipe', $data1);
 //$where = "iname ='".$data1['iname']."'";
}

// View data into the the table 
else if($op=='view')
{
 unset($data1['op']);
 $where = "iname ='".$data1['iname']."' and cqty='".$data1['cqty']."' and cunit='".$data1['cunit']."'";
 unset($data1['iname']);
 $obj->select_db('receipe', $data1,$where);
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('receipe', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('receipe', $data1);
}

// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('receipe', $data1,$where);
}

// Total section 
else if($op=='gtotal')
{
 unset($data1['op']);
 $where = "iname ='".$data1['iname']."' and cqty='".$data1['cqty']."' and cunit='".$data1['cunit']."'";
 $obj->total_db('receipe', $data1,$where);
}

?>