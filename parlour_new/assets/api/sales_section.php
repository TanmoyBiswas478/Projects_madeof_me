<?php 
session_start();
include 'sales_class.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']='Admin';
$data1['user']=$_SESSION['user'];
$data2['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new sales();  

// Insert the data into the table
if($op=='insert')
{
$data2=$data1;
$inv=$data1['invno'];
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
$data1['fy']=$year;
 unset($data1['op']);
 unset($data2['op']);
 unset($data2['ph']);
 unset($data2['wph']);
 unset($data2['name']);
 unset($data2['gstno']);
 unset($data2['state']);
 unset($data2['cid']);
 unset($data2['gender']);
 unset($data2['address']);

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
 unset($data1['sname']);
 unset($data1['asloat']);
 //unset($data1['category']);
 $obj->addsales($inv,$data1,$data2);
 $obj->view_db('sales',$inv); 

}

//View data into the the table 
else if($op=='gtotal')
{
    $data2=$data1;
    $inv=$data1['invno'];
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
    $data1['fy']=$year;
    $obj->gtotal1($inv, $state,$vname,$gstno); 
}

else if($op=='search'){
    $ph=$data1['ph'];
    $obj->client($ph);
}

else if($op=='service_search'){
    $service=$data1['service'];
    $type= $data1['type'];
    $query="select price,gst from service where iname='".$service."' and type='".$type."'";
    $obj->select_query($query);
}

else if($op=='sloat'){
    $as=$data1['as'];
    $sname= $data1['sname'];
    $doa=date("Y-m-d");
    $query="select count(*) as c from appoinment where asloat='".$as."' and sname='".$sname."' and doa='".$doa."'";
    $obj->select_query($query);
}








?>