<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$_SESSION['user']="Admin";
$data1['user']=$_SESSION['user'];
$idd=$data1['idd'];

$sql="select tname from registration where id='".$idd."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $tname=$row['tname'];
}

$sql="select max(bno) bno from batch where tname=(select tname from training where sform='".$tname."')";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $bno=$row['bno'];
}

$sql="SELECT MAX(CAST(SUBSTRING(regno,5, length(regno)-4) AS UNSIGNED)) regno FROM registration where tname='".$tname."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $regno=$row['regno'];
}
$tname=$tname."000";
if (empty($i)) {
    $regno =$tname."1";
   } else {
      $$regno = $$regno + 1;
      $$regno = $regno.$i;
  }

  $sql="update registration set regno='".$regno."',bno='".$bno."' where id='".$idd."'";
  $res=mysqli_query($con,$sql) or die(mysqli_error($con));

?>
