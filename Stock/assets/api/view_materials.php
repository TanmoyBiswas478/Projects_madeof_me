<?php
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$data1 = json_decode(file_get_contents("php://input"), true);
$op = $data1['op'];
$tname = $data1['tname'] ?? '';

if ($op == 'view' && !empty($tname)) {
    $sql = "SELECT * FROM materials WHERE tname = '$tname'";
    $result = mysqli_query($con, $sql);
    $materials = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $materials[] = $row;
    }
    echo json_encode($materials);
} else {
    echo json_encode(["error" => "No materials found for this training name or no training name provided."]);
}

$con->close();
?>
