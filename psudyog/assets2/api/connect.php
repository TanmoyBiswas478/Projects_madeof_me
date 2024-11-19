<?php 
// *** Create the connection file ***
//$con=new mysqli("localhost","u333956788_easygst","Soft@2017","u333956788_easygst");
$con=new mysqli("localhost","root","","psudyog");
if($con->connect_error){
    die("Connection Failed....");
}
?>