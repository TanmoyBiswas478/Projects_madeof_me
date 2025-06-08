<?php
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1 = json_decode(file_get_contents("php://input"), true);

$op = $data1['op'];
//$_SESSION['user']="";
$data1['sname'] = $_SESSION['sname'];
$data1['user'] = $_SESSION['user'];

// *** Create new object for class database
$obj = new database();

// Insert the data into the table
if ($op == 'insert') {
    unset($data1['op']);
    $obj->insert_db('purchase', $data1);
}

// View data into the the table 
else if ($op == 'view') {
    $pinv = $data1['pinv'];
    $sname = $_SESSION['sname'];
    $sql = "select * from purchase where pinv='" . $pinv . "' and sname='" . $sname . "'";
    $obj->select_query($sql);
}

// Update data into the table 
else if ($op == 'edit') {
    unset($data1['op']);
    $where = "id =" . $data1['id'];
    unset($data1['idd']);
    $obj->update_db('purchase', $data1, $where);
}

// Delete data into the table
else if ($op == 'delete') {
    unset($data1['op']);
    $obj->delete_db('purchase', $data1);
}
// Select data into the table 
else if ($op == 'select_condition') {
    unset($data1['op']);
    $where = "id =" . $data1['idd'];
    unset($data1['idd']);
    $obj->select_db('purchase', $data1, $where);
} else if ($op == 'total_values') {
    unset($data1['op']);
    $pinv = $data1['pinv'];
    $sname = $_SESSION['sname'];
    $sql = "select sum(tax) totaltax,sum(gstamt) totalgst,sum(total) gtotal from purchase where pinv='" . $pinv . "' and sname='" . $sname . "'";
    $obj->select_query($sql);
}
else if ($op == 'stock_view') {
    unset($data1['op']);

    $sname = $_SESSION['sname'];
    $sql = "select bname,product,hsn,qty,unit,rate,srate,mrp,gst,(qty*rate) as svalue from stock where sname='" . $sname . "'";
    $obj->select_query($sql);
}
?>