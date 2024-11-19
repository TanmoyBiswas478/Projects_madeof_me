<?php 
include "connect.php";
$phone= $_POST['phone'];
$sname= $_POST['sname'];
$address= $_POST['address'];
$gender= $_POST['gender'];
$email= $_POST['email'];
$role= $_POST['role'];
$location= $_POST['location'];
$quali= $_POST['quali'];

// Generate a random employee ID
$empid=rand(1,100);

$filename=$_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];

// New file name with employee ID and ".jpg" extension
$new_filename = $empid . '.jpg';

$folder = "../../img/".$new_filename;

if (move_uploaded_file($tempname, $folder)){
   $img="http://127.0.0.1/attendence/img/".$new_filename;
   $sql="INSERT INTO reg(cid, name, ph, address, gender, email, role, location, quali, image_path) VALUES ('".$empid."','".$sname."','".$phone."','".$address."','".$gender."','".$email."','".$role."','".$location."','".$quali."','".$img."')";
   $res=mysqli_query($con,$sql) or die(mysqli_error($con));
}
else{
    echo "Error";
}
mysqli_close($con);
?>
