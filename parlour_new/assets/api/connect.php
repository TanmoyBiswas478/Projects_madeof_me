<?php 
// *** Create the connection file ***
$con=new mysqli("localhost","root","","parlour");
if($con->connect_error){
    die("Connection Failed....");
}
?>