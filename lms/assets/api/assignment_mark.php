<?php 
session_start();
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$op=$data1['op'];
$_SESSION['user']="teacher";
$data1['user']=$_SESSION['user'];

// *** Create new object for class database
$obj=new database();  

// Insert the data into the table
if ($op == 'insert') {
    unset($data1['op']);
    
    $obj->insert_db('assignment_mark',$data1);
}


// View data into the the table 
else if($op=='view')
{
    unset($data1['op']);
$user = $_SESSION['name'];
$sql = "SELECT DISTINCT tname, bno , sdate , edate  FROM batch WHERE trname='$user'";
$obj->select_query($sql);

}

// Update data into the table 
else if($op=='edit')
{
 unset($data1['op']);
 $where = "id =".$data1['id'];
 unset($data1['idd']);
 $obj->update_db('assignment_mark', $data1,$where);
}

// Delete data into the table
else if($op=='delete')
{
 unset($data1['op']);
 $obj->delete_db('assignment_mark', $data1);
}
// Select data into the table 
else if($op=='select_condition')
{
 unset($data1['op']);
 $where = "id =".$data1['idd'];
 unset($data1['idd']);
 $obj->select_db('assignment_mark', $data1,$where);
}

else if($op=='sview')
{
 unset($data1['op']);
 $tname=$data1['tname'];
 $bno=$data1['bno'];
 $sql="select t.tname,r.cname,r.regno,r.bno from registration r,training t where t.sform=r.tname and r.bno='".$bno."' and t.tname='".$tname."'";
 $obj->select_query($sql);
}

?>