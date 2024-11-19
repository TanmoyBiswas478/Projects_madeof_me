<?php 
include 'connect.php';
$sql="update login  set login_status='0' where user='Super Admin'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if($res){
    echo 'logout Sucessful';
}
mysqli_close($con);
?>