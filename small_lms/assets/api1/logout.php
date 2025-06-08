<?php 
session_start();
$_SESSION = [];
session_destroy();
if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/'); // Expire the cookie
}
header("Location: ../../index.html");
exit();
?>
