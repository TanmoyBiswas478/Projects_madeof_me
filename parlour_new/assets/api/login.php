<?php 
session_start();
include 'connect.php';
$user=$_POST['user'];
$pass=$_POST['pass'];
$sql="select * from login where user='".$user."' and pass='".$pass."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
// $sql1="UPDATE stock SET status = 'Expair' WHERE expdate < CURDATE()";
// $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));

// $sql1="UPDATE outlet_stock SET status = 'Expair' WHERE expdate < CURDATE()";
// $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));

if($c==1){
  while($row=mysqli_fetch_assoc($res)){
    $type=$row['type'];
  }
  if($type=='admin'){
    $_SESSION['type']=$type;
    $_SESSION['user']=$user;
    echo "<script>window.location.href='../../admin';</script>"; 
  }
  else if($type=='outlet'){
    $_SESSION['type']=$type;
    $_SESSION['user']=$user;
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