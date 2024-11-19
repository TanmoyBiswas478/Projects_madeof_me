<?php 
// *** Create the connection file ***
//$con=new mysqli("localhost","fortheye_admin","Soft@2017","fortheye_backery");
$con=new mysqli("localhost","root","","psudyog");
if($con->connect_error){
    die("Connection Failed....");
}
?>