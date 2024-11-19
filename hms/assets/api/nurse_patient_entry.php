<?php
session_start();
include "connect.php";

// Data from POST request
$patient_id = $_POST['patient_id'];
$patient_name = $_POST['patient_name'];
$referral_doctor = $_POST['referral_doctor'];
$consult_doctor = $_POST['consult_doctor'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$department = $_POST['department'];
$department_ward = $_POST['department_ward'];
$bed_type = $_POST['bed_type'];
$bed_no = $_POST['bed_no'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$bp = $_POST['bp'];
$pulse = $_POST['pulse'];
$temp = $_POST['temp'];
$resp = $_POST['resp'];
$symptoms_type = $_POST['symptoms_type'];
$symptoms_title = $_POST['symptoms_title'];
$symptoms_desc = $_POST['symptoms_desc'];
$description = $_POST['description'];
$note = $_POST['note'];
$any_allerg = $_POST['any_allerg'];
$prev_med_isu = $_POST['prev_med_isu'];
$user = $_SESSION['user'];


// Generate patient_id

// Prepare SQL statement
$sql = "INSERT INTO nurse_section (patient_id, patient_name, referral_doctor, consult_doctor, gender, age, department, department_ward, bed_type, bed_no, height, weight, bp, pulse, temp, resp, symptoms_type, symptoms_title, symptoms_desc, description, note, any_allerg, prev_med_isu, user) VALUES ('$patient_id', '$patient_name', '$referral_doctor', '$consult_doctor', '$gender', '$age', '$department', '$department_ward', '$bed_type', '$bed_no', '$height', '$weight', '$bp', '$pulse', '$temp', '$resp', '$symptoms_type', '$symptoms_title', '$symptoms_desc', '$description', '$note', '$any_allerg', '$prev_med_isu', '$user')";

// Execute SQL statement
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    $sql = "update appointment set status='0' where patient_id='" . $patient_id . "'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    header("location:../../admin/pages/nurse_view_patient.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close connection
mysqli_close($con);
?>