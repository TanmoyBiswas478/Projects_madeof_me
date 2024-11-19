<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1 = json_decode(file_get_contents("php://input"), true);

$op = isset($data1['op']) ? $data1['op'] : ''; // Check if 'op' key is set
$_SESSION['user'] = "Admin";
$data1['user'] = $_SESSION['user'];

// *** Create new object for class database
$obj = new database();  

// Insert the data into the table
if ($op == 'insert') {
    unset($data1['op']);
    $obj->insert_db('materials', $data1);
}

// View data in the table 
else if ($op == 'view') {
    $obj->view_db('materials'); 
}

// Update data in the table 
else if ($op == 'edit') {
    unset($data1['op']);
    $where = "id =" . $data1['id'];
    unset($data1['idd']);
    $obj->update_db('materials', $data1, $where);
}
else if($op=='view2')
{
 unset($data1['op']);
 $tname=$data1['tname'];
 $sql="select * from materials where tname='".$tname."'";
 $obj->select_query($sql); 
}

// Delete data from the table
else if ($op == 'delete') {
    unset($data1['op']);
    $obj->delete_db('materials', $data1);
}

// Select data from the table 
else if ($op == 'select_condition') {
    unset($data1['op']);
    $where = "id =" . $data1['id'];
    unset($data1['idd']);
    $obj->select_db('materials', $data1, $where);
}
?>
