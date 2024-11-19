<?php
session_start();
// Database configuration
include 'connect.php';

$location = $_POST["location"];
$patient_type = $_POST["patient_type"];
$patient_id = rand(1000,10000);
$mobile = $_POST["mobile"];
$referral_doctor = $_POST["referral_doctor"];
$patient_name = $_POST["patient_name"];
$father_name = $_POST["father_name"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$pin = $_POST["pin"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$blood_group = $_POST["blood_group"];
$email = $_POST["email"];
$whatsapp = $_POST["whatsapp"];
$marital = $_POST["marital"];
$n_id_type = $_POST["n_id_type"];
$nid = $_POST["nid"];
$status = 'pending';
$user = $_SESSION['user'];

// // Create connection
// $con = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }



// Prepare SQL statement
$sql = "INSERT INTO patient (location, patient_type, patient_id, mobile, referral_doctor, patient_name, father_name, address, city, state, pin, gender, age, blood_group, email, whatsapp,marital, n_id_type, nid, status, user) 
VALUES ('$location', '$patient_type', '$patient_id', '$mobile', '$referral_doctor', '$patient_name', '$father_name', '$address', '$city', '$state', '$pin', '$gender', '$age', '$blood_group', '$email', '$whatsapp','$marital', '$n_id_type', '$nid','$status', '$user')";

// Execute SQL statement
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header("location:../../admin/pages/patient_registration.php");

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($con);
?>