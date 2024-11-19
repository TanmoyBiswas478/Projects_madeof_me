<?php
date_default_timezone_set('Asia/Kolkata');

//Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gstsoftmis";

$servername = "localhost";
$username = "fortheye_admin";
$password = "Soft@2017";
$dbname = "fortheye_easygst";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$sname = "M/s ".ucwords($_POST['sname']);
$gstno = strtoupper($_POST['gstno']);
$panno = strtoupper($_POST['panno']);
$address = ucwords($_POST['address']);
$ph = $_POST['ph'];
$email = strtolower($_POST['email']);
$trade = $_POST['trade'];

// Calculate expiry date
$expdate = new DateTime();
$expdate->modify('+1 month');
$expdate = $expdate->format('Y-m-d');

// Insert data into shop table
$sql = "INSERT INTO shop (sname, gstno, panno, address, phone, email, trade, expdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error preparing the statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssssssss", $sname, $gstno, $panno, $address, $ph, $email, $trade, $expdate);

if (mysqli_stmt_execute($stmt)) {
    //echo "Record inserted successfully";

    // Email content
   $sname="test mail";
   $to = "works9927@gmail.com";
   $subject = "GST Registration";
   $message = "NEW Registration done on ".$sname;
   $headers = "From: bishtamaid@gmail.com";

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
    echo "<script>alert('Record inserted successfully');</script>";
    echo "<script>window.location.href='../../admin/#!/gstreg';</script>";

} else {
    echo "Error executing the statement: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
