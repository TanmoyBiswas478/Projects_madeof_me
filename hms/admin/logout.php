<?php 
include '../assets/api/connect.php';
session_start();
$user=$_SESSION['user'];
$sql="update login  set login_status='0' where user='".$user."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if($res){
    mysqli_close($con);
    session_destroy();
    echo "<script>window.location.href='../index.html';</script>";
}
?>