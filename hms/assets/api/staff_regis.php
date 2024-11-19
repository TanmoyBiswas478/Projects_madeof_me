<?php
session_start();
// Database configuration
include 'connect.php';

$staff_id = $_POST["staff_id"];
$role = $_POST["role"];
$designation = $_POST["designation"];
$dept = $_POST["dept"];
$name = $_POST["name"];
$father_name = $_POST["father_name"];
$mother_name = $_POST["mother_name"];
$gender = $_POST["gender"];
$marital_status = $_POST["marital_status"];
$blood = $_POST["blood"];
$dob = $_POST["dob"];
$doj = $_POST["doj"];
$ph = $_POST["phone"];
$emer_cont = $_POST["emer_cont"];
$email = $_POST["email"];
$c_add = $_POST["c_add"];
$p_add = $_POST["p_add"];
$quali = $_POST["quali"];
$experience = $_POST["experience"];
$specilization = $_POST["specilization"];
$note = $_POST["note"];
$pan = $_POST["pan"];
$reference_contact = $_POST["reference_contact"];
$user = $_SESSION['user'];

// File upload handling
$photo = $_FILES["photo"]["name"]; // Name of the file
$photo_tmp = $_FILES["photo"]["tmp_name"]; // Temporary location on the server

// Ensure the directory exists or create it
$upload_directory = "staff_images/";
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0777, true); // create the directory with full permissions
}

$photo_path = $upload_directory . basename($photo); // Final path where the file will be saved

if (move_uploaded_file($photo_tmp, $photo_path)) {
    // File uploaded successfully, continue with the database insertion
    // Prepare SQL statement
    $sql = "INSERT INTO staff (staff_id, role, designation, dept, name, mother_name, father_name, gender, marital_status, blood, dob, doj, phone, emer_cont, email, photo, c_add, p_add, quali, experience, specilization, note, pan, reference_contact, user) 
    VALUES ('$staff_id', '$role', '$designation', '$dept', '$name', '$mother_name', '$father_name', '$gender', '$marital_status', '$blood', '$dob', '$doj', '$ph', '$emer_cont', '$email', '$photo_path', '$c_add', '$p_add', '$quali', '$experience', '$specilization', '$note', '$pan', '$reference_contact', '$user')";

    // Execute SQL statement
    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
        // header("location:../../admin/pages/staff_regis.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
} else {
    echo "Failed to upload file.";
}

// Close connection
mysqli_close($con);
?>
