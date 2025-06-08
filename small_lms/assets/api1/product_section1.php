<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
//$_SESSION['user']="";
$data1['sname']=$_SESSION['sname'];
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('product', $data1);
}

// View data into the the table 
else if($op=='view')
{
 $sname=$_SESSION['sname'];
 $pinv=$data1['pinv'];
 $pname= $data1['pname'];
 $sql="select * from product where pinv='".$pinv."' and pname='".$pname."' and sname='".$sname."'";
 $obj->select_query($sql);
}


// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('product', $data1);
}

else if ($op == 'product_view') {
    unset($data1['op']);

    $sname = $_SESSION['sname'];
    $sql = "select id,pname,imeno,chargerno,price,status from product where sname='" . $sname . "'";
    $obj->select_query($sql);
}
?>