<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "software_admin"; // Replace with your MySQL username
    $password = "Soft@2017"; // Replace with your MySQL password
    $dbname = "software_soft";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Financial Year section 
    $month=date('m');
    $year=date('y');
    $dot=date('Y-m-d');
    if($month>='04')
    {
     $x=$year+1;
     $fy=$year."-".$x;
    }
    else
    {
     $x=$year-1;
     $fy=$x."-".$year;
    }

    // Retrieve form data
    $tname = $_POST['tname'];
    $duration=$_POST['duration'];
    $fees=$_POST['fees'];
    $iname = $_POST['iname'];
    $dept = $_POST['dept'];
    $year = $_POST['year'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $ph = $_POST['ph'];
    $wph = $_POST['wph'];
    $email = $_POST['email'];
    $tmode=$_POST['tmode'];
    $address = $_POST['address'];
    $paymode=$_POST['pay'];
    $ph1=$ph."_".$tname;

    // Get file extensions
    $aadhaar_img_extension = pathinfo($_FILES['aadhaar_img']['name'], PATHINFO_EXTENSION);
    $admit_img_extension = pathinfo($_FILES['admit_img']['name'], PATHINFO_EXTENSION);
    $marksheet_img_extension = pathinfo($_FILES['marksheet_img']['name'], PATHINFO_EXTENSION);
    $img_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    $sig_extension = pathinfo($_FILES['sig']['name'], PATHINFO_EXTENSION);
    $receipt_extension = pathinfo($_FILES['receipt']['name'], PATHINFO_EXTENSION);

     // Rename files with Aadhaar number as filename
    $aadhaar_img = $ph1 . '.' . $aadhaar_img_extension;
    $admit_img = $ph1 . '.' . $admit_img_extension;
    $marksheet_img = $ph1 . '.' . $marksheet_img_extension;
    $img = $ph1 . '.' . $img_extension;
    $sig = $ph1 . '.' . $sig_extension;
    $receipt = $ph1 . '.' . $receipt_extension;

    // Directory paths
    $target_dir_aadhaar = "../../aadhaar/";
    $target_dir_admit = "../../admit/";
    $target_dir_marksheet = "../../marksheet/";
    $target_dir_img = "../../img/";
    $target_dir_sig = "../../sig/";
    $target_dir_receipt = "../../receipt/";

    // Create directories if they don't exist
    if (!file_exists($target_dir_aadhaar)) {
        mkdir($target_dir_aadhaar, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_admit)) {
        mkdir($target_dir_admit, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_marksheet)) {
        mkdir($target_dir_marksheet, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_img)) {
        mkdir($target_dir_img, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_sig)) {
        mkdir($target_dir_sig, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_receipt)) {
        mkdir($target_dir_receipt, 0777, true); // Create recursively
    }

    // Move uploaded files
    move_uploaded_file($_FILES["aadhaar_img"]["tmp_name"], $target_dir_aadhaar . $aadhaar_img);
    move_uploaded_file($_FILES["admit_img"]["tmp_name"], $target_dir_admit . $admit_img);
    move_uploaded_file($_FILES["marksheet_img"]["tmp_name"], $target_dir_marksheet . $marksheet_img);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir_img . $img);
    move_uploaded_file($_FILES["sig"]["tmp_name"], $target_dir_sig . $sig);
    move_uploaded_file($_FILES["reeceipt"]["tmp_name"], $target_dir_receipt . $receipt);

    // SQL insert query
    $sql = "INSERT INTO registration (fy,tname,duration,fees,iname, dept, year,cname, fname, mname, dob, gender, ph, wph, email,tmode, address, aadhaar_img, admit_img, marksheet_img, img, sig,paymode, receipt) 
            VALUES ('$fy','$tname','$duration','$fees','$iname', '$dept', '$year', '$name', '$fname', '$mname', '$dob', '$gender', '$ph', '$wph', '$email','$tmode','$address', '$aadhaar_img', '$admit_img', '$marksheet_img', '$img', '$sig','$paymode','$receipt')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successfully Completed....');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    } else {
        echo "<script>alert('Error occurred while processing. Please try again.');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    }

    // Close connection
    $conn->close();
} else {
    echo "<script>alert('Form not submitted.');</script>";
    echo "<script>window.location.href='../../index.html';</script>";
}
?>
