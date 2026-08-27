<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "admission";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $iname = $_POST['iname'];
    $dept = $_POST['dept'];
    $year = $_POST['year'];
    $tname = $_POST['tname'];
    $aadhaar = $_POST['aadhaar'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $ph = $_POST['ph'];
    $wph = $_POST['wph'];
    $cast = $_POST['cast'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Get file extensions
    $aadhaar_img_extension = pathinfo($_FILES['aadhaar_img']['name'], PATHINFO_EXTENSION);
    $prtc_img_extension = pathinfo($_FILES['prtc_img']['name'], PATHINFO_EXTENSION);
    $cast_img_extension = pathinfo($_FILES['cast_img']['name'], PATHINFO_EXTENSION);
    $img_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    $sig_extension = pathinfo($_FILES['sig']['name'], PATHINFO_EXTENSION);
    $thumb_extension = pathinfo($_FILES['thumb']['name'], PATHINFO_EXTENSION);

    // Validation: Check if any of the uploaded files are not image files (JPG, JPEG, PNG)
    if (
        !in_array($aadhaar_img_extension, array('jpg', 'jpeg', 'png')) ||
        !in_array($prtc_img_extension, array('jpg', 'jpeg', 'png')) ||
        !in_array($cast_img_extension, array('jpg', 'jpeg', 'png')) ||
        !in_array($img_extension, array('jpg', 'jpeg', 'png')) ||
        !in_array($sig_extension, array('jpg', 'jpeg', 'png')) ||
        !in_array($thumb_extension, array('jpg', 'jpeg', 'png'))
    ) {
        echo "<script>alert('Only JPG, JPEG, and PNG files are allowed.');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
        exit; // Stop further execution
    }

    // Rename files with Aadhaar number as filename
    $aadhaar_img = $aadhaar . '.' . $aadhaar_img_extension;
    $prtc_img = $aadhaar . '.' . $prtc_img_extension;
    $cast_img = $aadhaar . '.' . $cast_img_extension;
    $img = $aadhaar . '.' . $img_extension;
    $sig = $aadhaar . '.' . $sig_extension;
    $thumb = $aadhaar . '.' . $thumb_extension;

    // Directory paths
    $target_dir_aadhaar = "../../aadhaar/";
    $target_dir_prtc = "../../prtc/";
    $target_dir_cast = "../../cast/";
    $target_dir_img = "../../img/";
    $target_dir_sig = "../../sig/";
    $target_dir_thumb = "../../thumb/";

    // Create directories if they don't exist
    if (!file_exists($target_dir_aadhaar)) {
        mkdir($target_dir_aadhaar, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_prtc)) {
        mkdir($target_dir_prtc, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_cast)) {
        mkdir($target_dir_cast, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_img)) {
        mkdir($target_dir_img, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_sig)) {
        mkdir($target_dir_sig, 0777, true); // Create recursively
    }
    if (!file_exists($target_dir_thumb)) {
        mkdir($target_dir_thumb, 0777, true); // Create recursively
    }

    // Move uploaded files
    move_uploaded_file($_FILES["aadhaar_img"]["tmp_name"], $target_dir_aadhaar . $aadhaar_img);
    move_uploaded_file($_FILES["prtc_img"]["tmp_name"], $target_dir_prtc . $prtc_img);
    move_uploaded_file($_FILES["cast_img"]["tmp_name"], $target_dir_cast . $cast_img);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir_img . $img);
    move_uploaded_file($_FILES["sig"]["tmp_name"], $target_dir_sig . $sig);
    move_uploaded_file($_FILES["thumb"]["tmp_name"], $target_dir_thumb . $thumb);

    // SQL insert query
    $sql = "INSERT INTO reg (iname, dept, year, tname, aadhaar, name, fname, mname, dob, gender, ph, wph, cast, email, address, aadhaar_img, prtc_img, cast_img, img, sig, thumb, doe) 
            VALUES ('$iname', '$dept', '$year', '$tname', '$aadhaar', '$name', '$fname', '$mname', '$dob', '$gender', '$ph', '$wph', '$cast', '$email', '$address', '$aadhaar_img', '$prtc_img', '$cast_img', '$img', '$sig', '$thumb', NOW())";

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
