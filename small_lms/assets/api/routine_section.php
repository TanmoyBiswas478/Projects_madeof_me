<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if($op=='insert')
{
 unset($data1['op']);
 $obj->insert_db('routine', $data1);
}

// View data into the the table 
else if($op=='view')
{
 $obj->view_db('routine'); 
}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('routine', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('routine', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('routine', $data1,$where);
}

else if($op=='tview'){
    $sql="select distinct(t.tname) tname from registration r,training t where r.tname=t.sform";
    $obj->select_query($sql);
}

else if($op=='dview')
{
 $sql="select days from days";
 $obj->select_query($sql);
}

else if($op=='sview')
{
 $sql="select sloat from slot order by id asc";
 $obj->select_query($sql);
}

else if($op=='bview')
{
 $tname=$data1['tname'];
 $sql="select bno from batch where tname='".$tname."'";
 $obj->select_query($sql);
}

else if($op=='d_view')
{
 $tname=$data1['tname'];
 $bno=$data1['bno'];
 $sql="select sdate,edate from batch where tname='".$tname."' and bno='".$bno."'";
 $obj->select_query($sql);
}

else if($op=='t_view')
{
 $sql="select distinct(tname) tname from routine where teacher='".$_SESSION['name']."'";
 $obj->select_query($sql);
}
?>