<?php 
session_start();
include 'connect.php';
$user = $_POST['user'];
$pass = $_POST['pass'];
$doe = date("Y-m-d");
$sql = "SELECT * FROM login WHERE user='".$user."' AND pass='".$pass."'";
$res = mysqli_query($con, $sql) or die(mysqli_error($con));
$c = mysqli_num_rows($res);

if ($c == 1) {
    while ($row = mysqli_fetch_assoc($res)) {
        $type = $row['type'];
        $sname = $row['sname'];
        $expdate = $row['expdate'];
    }

    if ($type == 'admin') {
        $_SESSION['type'] = $type;
        $_SESSION['user'] = $user;
        echo "<script>window.location.href='../../admin';</script>"; 
    } elseif ($type == 'outlet') {
        $_SESSION['type'] = $type;
        $_SESSION['user'] = $user;
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

mysqli_close($con);
?>
