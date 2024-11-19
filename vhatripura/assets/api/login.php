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
    $name=$row['name'];
  }
  if($type=='Admin'){
    $_SESSION['type']=$type;
    $_SESSION['name']=$name;
    echo "<script>window.location.href='../../dashboard1.html';</script>";
  }
}
else{
    $_SESSION['type'] = '';
    echo "<script>alert('Sorry, User ID and Password Mismatch');</script>";
    echo "<script>window.location.href='../login.html';</script>";
}

mysqli_close($con);
?>