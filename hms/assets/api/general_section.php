<?php
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1 = json_decode(file_get_contents("php://input"), true);

$op = $data1['op'];
//$_SESSION['user']="Admin";
$data1['user'] = $_SESSION['user'];

// *** Create new object for class database
$obj = new database();

if ($op == 'insert') {
    unset($data1['op']);
    $obj->insert_db('patient', $data1);
} else if ($op == 'view') {
    unset($data1['op']);
    $sql = "select * from patient";
    $obj->select_query($sql);
} else if ($op == 'update') {
    unset($data1['op']);
    $patient_id = $data1['patient_id'];
    unset($data1['patient_id']);
    $where = "patient_id = '" . $patient_id . "'";
    $obj->update_db('patient', $data1, $where);
} else if ($op == 'delete') {
    unset($data1['op']);
    $obj->delete_db('patient', $data1);
} else if ($op == 'select_condition') {
    if (isset($data1['idd'])) {
        unset($data1['op']);
        $where = "id = " . $data1['idd'];
        $obj->select_db('patient', $data1, $where);
    } else {
        echo "Error: 'idd' key not found in the request data";
    }
} else if ($op == 'aview') {
    unset($data1['op']);
    $sql = "select * from login where login_status='1'";
    $obj->select_query($sql);
} else if ($op == 'deactive') {
    unset($data1['op']);
    $idd = $data1['idd'];
    $sql = "update login  set login_status='0' where id='" . $idd . "'";
    $obj->select_query($sql);
}
?>
