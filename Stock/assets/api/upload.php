<?php
 include 'connect.php';

 $tname=$_POST['tname'];
 $bno=$_POST['bno'];
 $topic=$_POST['topic'];
 $file=$_FILES['file']['name'];
 $target = "../../materials/";
 $user='Admin';
 if (!file_exists($target)) {
    mkdir($target, 0777, true); // Create recursively
}
move_uploaded_file($_FILES["file"]["tmp_name"], $target . $file);

$sql = "INSERT INTO materials (tname,bno,topic,file,user) VALUES ('$tname','$bno','$topic','$file', '$user')";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if ($res) {
        echo "<script>alert('Data Insertion successfully....');</script>";
        echo "<script>window.location.href='http://localhost/lms/admin/#!/materials';</script>";
    } else {
        echo "<script>alert('Error occurred while processing. Please try again.');</script>";
        echo "<script>window.location.href='http://localhost/lms/admin/#!/materials';</script>";
    }
mysqli_close($con);
?>
