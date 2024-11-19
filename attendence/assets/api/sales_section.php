<?php 
session_start();
include 'sales_class.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$data2=$data1;

$op=$data1['op'];
$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];
$data2['user']=$_SESSION['user'];

// // *** Create new object for class database
$obj=new sales();  
// Insert the data into the table
if($op=='insert')
{
 $inv=$data1['invno'];
 $invdate=$data1['invdate'];
 unset($data1['op']);
 unset($data2['op']);
 unset($data2['name']);
 unset($data2['ph']);
 unset($data2['cid']);
 unset($data2['gender']);
 unset($data2['address']);
 unset($data2['gstno']);
 unset($data2['state']);
 unset($data1['product']);
 unset($data1['sname']);
 unset($data1['asloat']);
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
 unset($data1['bno']);
//  unset($data1['category']);
 $obj->addsales($inv,$data1,$data2);
 $obj->view_db('sales',$inv); 

}

//View data into the the table 
else if($op=='gtotal')
{
 $inv=$data1['inv'];
 $obj->gtotal1($inv); 
}

if($op=='search'){
    $ph=$data1['ph'];
    $obj->client($ph);
}

else if($op=='service'){
    $obj->service();

}

else if($op=='service_search'){
    $service=$data1['service'];
    $type=$data1['type'];
    $obj->service_search($service,$type);

}

?>