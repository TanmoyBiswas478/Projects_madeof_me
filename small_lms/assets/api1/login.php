<?php 
session_start();
include 'connect.php';
// Get and sanitize input
$user = trim($_POST['user']);
$pass = trim($_POST['pass']);
$doe = date("Y-m-d");
// Input validation
if (empty($user) || empty($pass)) {
    echo "<script>alert('User ID and Password cannot be empty');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
    exit();
}

if (!preg_match("/^[a-zA-Z0-9_]{3,30}$/", $user)) {
    echo "<script>alert('Invalid User ID format');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
    exit();
}

if (strlen($pass) < 6 || strlen($pass) > 50) {
    echo "<script>alert('Password must be between 6 and 50 characters');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
    exit();
}

// Prepare the SQL statement
$sql = "SELECT * FROM login WHERE user = ? AND pass = ?";
$stmt = $con->prepare($sql);

// Bind parameters
$stmt->bind_param("ss", $user, $pass);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$c = $result->num_rows;

if ($c == 1) {
    $row = $result->fetch_assoc();
    $type = $row['type'];
    $sname = $row['sname'];
    $expdate = $row['expdate'];

    if ($type == 'admin') {
        $_SESSION['type'] = $type;
        $_SESSION['user'] = $user;
        $_SESSION['sname']=$sname;
        echo "<script>window.location.href='../../admin';</script>"; 
    } elseif ($type == 'outlet') {
        $_SESSION['type'] = $type;
        $_SESSION['user'] = $user;
        $_SESSION['sname']=$sname;
        echo "<script>window.location.href='../../outlet';</script>"; 
    } elseif ($type == 'Shop') {
        $_SESSION['type'] = $type;
        $_SESSION['user'] = $user;
        $_SESSION['sname'] = $sname;

        // Check if the expiration date has passed
        if (strtotime($expdate) < strtotime($doe)) {
            // Redirect to payment page
            echo "<script>window.location.href='../../payment.html';</script>";
        } else {
            // Redirect to shop page
            echo "<script>window.location.href='../../shop';</script>";
        }
    }
} else {
    $_SESSION['type'] = '';
    echo "<script>alert('Sorry, User ID and Password Mismatch');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}

// Close the statement and connection
$stmt->close();
$con->close();
?>
