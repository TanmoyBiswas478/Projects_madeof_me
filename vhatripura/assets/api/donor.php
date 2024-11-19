<?php
include "connect.php";

// Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$pin = $_POST['pin'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pan = $_POST['pan'];
$amount = $_POST['amount'];
$remarks = $_POST['remarks'];
$payment_mode = $_POST['payment_mode'];

// Check if a file was uploaded
if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] == 0) {
    $target_dir = "../../uploads/"; // Ensure this folder exists and is writable
    $target_file = $target_dir . basename($_FILES["file_path"]["name"]);

    // Move uploaded file
    if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO donors (name, address, pin, phone, email, pan, amount, remarks, payment_mode, file_path)
                VALUES ('$name', '$address', '$pin', '$phone', '$email', '$pan', '$amount', '$remarks', '$payment_mode', '$target_file')";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($res) {
            echo "<script>alert('Data Inserted successfully....');</script>";
            echo "<script>window.location.href='../../donateus.html';</script>";
        } else {
            echo "Failed to insert data.";
            echo "<script>window.location.href='../../donateus.html';</script>";
        }
    } else {
        echo "Failed to move the uploaded file.";
        echo "<script>window.location.href='../../donateus.html';</script>";
    }
} else {
    echo "<script>alert('File upload error')</script>";
    echo "<script>window.location.href='../../donateus.html';</script>";
}

mysqli_close($con);
?>
