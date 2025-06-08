<?php 
session_start();
include 'connect.php';
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$data1['sname']=$_SESSION['sname'];
$data1['user']=$_SESSION['user'];
$month=date('m');
$year=date('y');
$dot=date('Y-m-d');
if($month>='04')
{
 $x=$year+1;
 $year=$year."-".$x;
}
else
{
 $x=$year-1;
 $year=$x."-".$year;
}
$data1['fy']=$year;
// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert_master')
{
 unset($data1['op']);
 $sql="select * from purchase_master where pinv='".$data1['pinv']."' and sname='".$_SESSION['sname']."'";
 $res=mysqli_query($con,$sql) or die(mysqli_error($con));
 $c=mysqli_num_rows($res);
 if($c==0)
 {
  $obj->insert_db('purchase_master', $data1);
 }
 mysqli_close($con);
}

// View data into the the table 
else if($op=='view')
{
 $sname=$_SESSION['sname'];
 $obj->view_db('purchase_master',$sname); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('purchase_master', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('purchase_master', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('purchase_master', $data1,$where);
}
?>