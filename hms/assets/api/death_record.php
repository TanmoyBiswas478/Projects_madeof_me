<?php
session_start();
// Database configuration
include 'connect.php';
// Data from POST request
$name = $_POST['name'];
$dod = $_POST['dod'];
$ph = $_POST['ph'];
$case_id = $_POST['case_id'];
$guardian = $_POST['guardian'];
$report = $_POST['report'];
$attachment = $_POST['attachment'];
// $user = $_SESSION['user'];
$user = 'admin';

// Prepare SQL statement
$sql = "INSERT INTO death_record (case_id, name, dod, ph, guardian, report, attachment,  user) 
VALUES ('$case_id', '$name', '$dod', '$ph', '$guardian', '$report', '$attachment', '$user')";

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
