<?php
session_start();
// Database configuration
include 'connect.php';
// Data from POST request
$name = $_POST['name'];
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$child_photo = $_POST['child_photo'];
$dob = $_POST['dob'];
$ph = $_POST['ph'];
$address = $_POST['address'];
$case_id = $_POST['case_id'];
$mother_name = $_POST['mother_name'];
$mother_photo = $_POST['mother_photo'];
$father_name = $_POST['father_name'];
$father_photo = $_POST['father_photo'];
$report = $_POST['report'];
$attachment = $_POST['attachment'];
// $user = $_SESSION['user'];
$user = 'admin';

// Prepare SQL statement
$sql = "INSERT INTO birth_record (case_id, name, gender, dob, ph,  mother_name, father_name, weight, child_photo, address, mother_photo, father_photo, report, attachment,  user) 
VALUES ('$case_id', '$name', '$gender', '$dob', '$ph', '$mother_name', '$father_name', '$weight', '$child_photo', '$address', '$mother_photo', '$father_photo', '$report', '$attachment', '$user')";

// Execute SQL statement
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    // header("location:../../admin/pages/birth&death_record.php");
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close connection
mysqli_close($con);
?>
