<?php
session_start(); 
include 'connect.php';
$user=$_POST['user'];
$pass=$_POST['pass'];

$sql="select * from login where user='".$user."' and pass='".$pass."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
if($c>0){
  while($row=mysqli_fetch_array($res)){
    $type=$row['type'];
    $cname=$row['cname'];
  }
  if($type=='admin'){
    $_SESSION['type']=$type;
    $_SESSION['cname']=$cname;
    echo "<script>window.location.href='../../admin';</script>";
  }
  else{

  }
  

}
else{
    $_SESSION['type'] = '';
    echo "<script>alert('Sorry, User ID and Password Mismatch');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}

mysqli_close($con);
?>