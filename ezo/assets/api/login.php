<?php 
session_start();
include 'connect.php';
$user=mysqli_real_escape_string($con,$_POST['user']);
$pass=mysqli_real_escape_string($con,$_POST['pass']);
$sql="select * from login where user='".$user."' and pass='".$pass."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$c=mysqli_num_rows($res);
if($c>0)
{
 while($row=mysqli_fetch_array($res))
  {
   $type=$row['type'];
   $name=$row['name'];
  }
  if($type=='admin')
  {
   $_SESSION['user']=$user;
   $_SESSION['type']=$type;
   $_SESSION['name']=$name;
   session_write_close();
   echo "<script>window.location.href='../../admin';</script>";
  }
  else if($type=='teacher')
  {
    $_SESSION['user']=$user;
    $_SESSION['type']=$type;
    $_SESSION['name']=$name;
    session_write_close();
    echo "<script>window.location.href='../../teacher';</script>";
  }
  else{
    $_SESSION['user']=$user;
    $_SESSION['type']=$type;
    $_SESSION['name']=$name;
    session_write_close();
    echo "<script>window.location.href='../../students';</script>";
  }
}
else{
    $_SESSION['type']="";
    session_write_close();
    echo "<script>alert('Sorry Userid and Password Mismatch');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
  }
 mysqli_close($con);
?>