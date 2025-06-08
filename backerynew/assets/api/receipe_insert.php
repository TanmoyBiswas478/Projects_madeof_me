<?php 
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data1=json_decode(file_get_contents("php://input"),true);

$_SESSION['user']="Admin";

$string =$data1['iname'];
$ono=$data1['ono'];
$doe=date('Y-m-d');

// **** Separate section is here ****
if (preg_match('/^([^\(]+)\((\d+)\s*([^\)]+)?\)$/', $string, $matches)) {
    // $matches[1] will contain $x
    $x = trim($matches[1]);

    // $matches[2] will contain $y
    $y = trim($matches[2]);

    // $matches[3] will contain $z (optional)
    $z = isset($matches[3]) ? trim($matches[3]) : null;
    } 
    $iname=$x;
    $cqty=$y;
    $cunit=$z;
    $user=$_SESSION['user'];

    $sql = "SELECT pname, qty, unit FROM receipe WHERE iname='".$iname."' AND cqty='".$cqty."' AND cunit='".$cunit."'";
$res_query = mysqli_query($con, $sql) or die(mysqli_error($con));

while ($row = mysqli_fetch_assoc($res_query)) {
    $sql1 = "INSERT INTO receipe_temp(oid, odate, iname, cqty, cunit, pname, qty, unit)
             VALUES('".$ono."','".$doe."','".$iname."','".$cqty."','".$cunit."','".$row['pname']."','".$row['qty']."','".$row['unit']."')";
    $res_insert = mysqli_query($con, $sql1);
    
    if (!$res_insert) {
        die(mysqli_error($con));
    }
}

   mysqli_close($con);


?>