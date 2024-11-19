<?php 
session_start();
include 'sales_class.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);



$data2=$data1;
$inv=$data1['sinv'];
$state=$data1['state'];
$vname=$data1['ph'];
$gstno=$data1['gstno'];
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

$op=$data1['op'];
$data1['user']=$_SESSION['user'];
$data1['sname']=$_SESSION['sname'];
$data1['fy']=$year;
$data2['user']=$_SESSION['user'];
$data2['sname']=$_SESSION['sname'];

// *** Create new object for class database
$obj=new sales();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 unset($data2['op']);
 unset($data2['ph']);
 unset($data2['wph']);
 unset($data2['name']);
 unset($data2['gstno']);
 unset($data2['state']);
 unset($data1['product']);
 unset($data1['hsn']);
 unset($data1['qty']);
 unset($data1['unit']);
 unset($data1['rate']);
 unset($data1['tax']);
 unset($data1['gstper']);
 unset($data1['cgst']);
 unset($data1['cgstp']);
 unset($data1['sgst']);
 unset($data1['sgstp']);
 unset($data1['igst']);
 unset($data1['igstp']);
 unset($data1['gstamt']);
 unset($data1['total']);
 unset($data1['expdate']);
 unset($data1['bno']);
 unset($data1['category']);
 $obj->addsales($inv,$data1,$data2);
}

else if($op=='item_view'){
    unset($data1['op']);
    $where = "sinv ='".$data1['sinv']."'";
    $obj->view_db('sales', $data1,$where);    
}

//View data into the the table 
else if($op=='gtotal')
{
 $obj->gtotal1($inv,$state); 
}

else if($op=='search'){
    $ph=$data1['ph'];
    $obj->client($ph);
}


// // Delete data into the table
// else if($op=='delete')
// {
//  unset($data1['op']);
//  $obj->delete_db('vendor', $data1);
// }

// // Select data into the table 
// else if($op=='select_condition')
// {
//  unset($data1['op']);
//  $where = "id =".$data1['idd'];
//  unset($data1['idd']);
//  $obj->select_db('vendor', $data1,$where);
// }

?>