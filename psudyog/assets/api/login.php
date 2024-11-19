<?php 
session_start();
include 'connect.php';
$user=$_POST['user'];
$pass=$_POST['pass'];
$sql="select * from login where user='".$user."' and pass='".$pass."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);

if($c==1){
  while($row=mysqli_fetch_assoc($res)){
    $type=$row['type'];
    $sname=$row['sname'];
  }
  if($type=='admin'){
    $_SESSION['type']=$type;
    $_SESSION['user']=$user;
    echo "<script>window.location.href='../../admin';</script>"; 
  }
  else if($type=='outlet'){
    $_SESSION['type']=$type;
    $_SESSION['user']=$user;
    $_SESSION['sname']=$sname;
    echo "<script>window.location.href='../../outlet';</script>"; 
  }
}
else{
    $_SESSION['type']='';
    echo "<script>alert('Sry Userid and Password Mismatch');</script>";
    echo "<script>window.location.href='../../login.html';</script>";
}
mysqli_close($con);
?>