<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $con=mysqli_connect("localhost","root","","small_lms") or die(mysqli_error($con));

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Retrieve form data
    $course_name = $_POST['course_name'];
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $c_fees = $_POST['c_fees'];
    $regno = $_POST['regno'];
    $app_date = $_POST['app_date'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $s_ph = $_POST['s_ph'];
    $pay = $_POST['pay'];

    // Validate file uploads
    $img_extension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
    $pay_ss_extension = strtolower(pathinfo($_FILES['pay_ss']['name'], PATHINFO_EXTENSION));


    // Create unique filenames
    $unique_id = time();
    $img = $s_ph . '_' . $unique_id . '.' . $img_extension;
    $pay_ss = $s_ph . '_' . $unique_id . '.' . $pay_ss_extension;

    // Directory paths
    $target_dir_img = "../../img/";
    $target_dir_pay_ss = "../../pay_ss/";

    // Create directories if they don't exist
    if (!file_exists($target_dir_img)) {
        mkdir($target_dir_img, 0777, true);
    }
    if (!file_exists($target_dir_pay_ss)) {
        mkdir($target_dir_pay_ss, 0777, true);
    }

    // Move uploaded files
    if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir_img . $img)) {
        die("<script>alert('Image upload failed!'); window.location.href='../../index.html';</script>");
    }
    if (!move_uploaded_file($_FILES["pay_ss"]["tmp_name"], $target_dir_pay_ss . $pay_ss)) {
        die("<script>alert('Payment receipt upload failed!'); window.location.href='../../index.html';</script>");
    }

    // Use prepared statements to insert data safely
    $stmt = $con->prepare("INSERT INTO registration (course_name, sname, fname, c_fees, regno, app_date, dob, gender, s_ph, img, pay, pay_ss) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissssssss", $course_name, $sname, $fname, $c_fees, $regno, $app_date, $dob, $gender, $s_ph, $img, $pay, $pay_ss);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successfully Completed....');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    } else {
        echo "<script>alert('Error occurred while processing. Please try again.');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    }

    // Close connections
    $stmt->close();
    $con->close();
} else {
    echo "<script>alert('Form not submitted.');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}
?>
