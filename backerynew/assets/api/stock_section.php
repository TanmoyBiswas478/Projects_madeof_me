<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$obj=new database();

$op=$data1['op'];

if($op=='view_stock')
{
 $query= "SELECT `product`,`hsn`,sum(`qty`) qty,`unit`,`expdate`,`rate`,`srate`,`gst`,(sum(`qty`)*rate) stock_value FROM `stock` where status='Not Expair' GROUP by product";
 $obj->select_query($query);
}

else if($op=='stock_exp')
{
 $query= "SELECT `product`,`hsn`,sum(`qty`) qty,`unit`,`expdate`,`rate`,`srate`,`gst`,(sum(`qty`)*rate) stock_value FROM `stock` where status='Expair' GROUP by product order by product ASC";
 $obj->select_query($query);
}

else if($op=='item_view')
{
 $query= "SELECT distinct(product) product FROM stock GROUP by product order by product ASC";
 $obj->select_query($query);
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
 $query= "SELECT * FROM outlet_stock where status='Not Expair' order by product ASC";
 $obj->select_query($query); 
}

else if($op=='ostock_view1'){
    $query= "SELECT distinct(product) product FROM outlet_stock order by product ASC";
    $obj->select_query($query); 
   }

else if($op=='select_product')
{
 unset($data1['op']);
 $product=$data1['product'];
 $query= "select * from outlet_stock where product='".$product."'";
 $obj->select_query($query);
}

else if($op=='select_condition_outlet')
{
 unset($data1['op']);
 $date1=date('Y-m-01');
 $date2=date('Y-m-t');
 $where = "expdate between '".$date1."' and '".$date2."'  order by expdate";
 $obj->select_db('outlet_stock', $data1,$where);
}

?>