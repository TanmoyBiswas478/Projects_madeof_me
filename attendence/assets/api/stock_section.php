<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$obj=new database();

$op=$data1['op'];

if($op=='view')
{
 $obj->view_db('stock'); 
}

else if($op=='select_condition')
{
 unset($data1['op']);
 $date1=date('Y-m-01');
 $date2=date('Y-m-t');
 $where = "expdate between '".$date1."' and '".$date2."' order by expdate";
 $obj->select_db('stock', $data1,$where);
}
?>