<?php
 include 'connect.php';

 $tname=$_POST['tname'];
 $bno=$_POST['bno'];
 $teacher=$_POST['teacher'];
 $file=$_FILES['file']['name'];
 $target = "../../assignment/";
 $user='Admin';
 if (!file_exists($target)) {
    mkdir($target, 0777, true); // Create recursively
}
move_uploaded_file($_FILES["file"]["tmp_name"], $target . $file);

$sql = "INSERT INTO assignment (tname,bno,teacher,file,user) VALUES ('$tname','$bno','$teacher','$file', '$user')";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if ($res) {
        echo "<script>alert('Data Insertion successfully....');</script>";
        echo "<script>window.location.href='../../teacher/#!/assign';</script>";
    } else {
        echo "<script>alert('Error occurred while processing. Please try again.');</script>";
        echo "<script>window.location.href='../../teacher/#!/assign';</script>";
    }
mysqli_close($con);
?>
