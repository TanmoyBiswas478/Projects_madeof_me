<?php 
session_start();
include 'connect.php';
$user=$_POST['user'];
$pass=$_POST['pass'];

$sql="select * from login where user='".$user."' and pass='".$pass."' and login_status='0'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
if($c==1)
{
  $_SESSION['user']=$user;
  $sql="update login  set login_status='1' where user='".$user."' and pass='".$pass."'";
  $res=mysqli_query($con,$sql) or die(mysqli_error($con));
  echo "<script>window.location.href='../../admin';</script>"; 
}
else{
    $_SESSION['type']='';
    echo "<script>alert('Sry Userid and Password Mismatch');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}
mysqli_close($con);

?>