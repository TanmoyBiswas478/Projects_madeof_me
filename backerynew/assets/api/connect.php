<?php 
// *** Create the connection file ***
$con=new mysqli("localhost","root","","backery");
if($con->connect_error){
    die("Connection Failed....");
}
?>