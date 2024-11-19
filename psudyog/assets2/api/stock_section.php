<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$obj=new database();
$data1['sname']=$_SESSION['sname'];
$data1['user']=$_SESSION['user'];


$op=$data1['op'];

if($op=='view')
{
 $where="sname='".$_SESSION['sname']."' and status='Not Expair'";
 $obj->select_db('stock', $data1,$where);  
}

else if($op=='select_condition')
{
 unset($data1['op']);
 $date1=date('Y-m-01');
 $date2=date('Y-m-t');
 $where = "expdate between '".$date1."' and '".$date2."' order by expdate";
 $obj->select_db('stock', $data1,$where);
}
else if($op=='ostock_view'){
    $obj->view_stock('outlet_stock');
}
else if($op=='select_product')
{
 unset($data1['op']);
 $product=$data1['product'];
 $where = "product='".$product."'";
 $obj->select_db('outlet_stock', $data1,$where);
}

else if($op=='select_condition_outlet')
{
 unset($data1['op']);
 $date1=date('Y-m-01');
 $date2=date('Y-m-t');
 $where = "expdate between '".$date1."' and '".$date2."'  order by expdate";
 $obj->select_db('outlet_stock', $data1,$where);
}

else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('stock', $data1);
}

?>