<?php 
session_start();
include 'connect.php';

$user = mysqli_real_escape_string($con, $_POST['user']);
$pass = mysqli_real_escape_string($con, $_POST['pass']);

$sql = "SELECT * FROM login WHERE user='$user' AND pass='$pass'";
$res = mysqli_query($con, $sql) or die(mysqli_error($con));

if (mysqli_num_rows($res) > 0) {
    $_SESSION['user'] = $user;
    session_write_close();
    echo "<script>window.location.href='../../pages';</script>";
} else {
    echo "<script>alert('Invalid username or password');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}

mysqli_close($con);
?>
