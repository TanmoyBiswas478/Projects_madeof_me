<?php
session_start();
include 'db.php'; // Include your database connection file
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$data = json_decode(file_get_contents("php://input"), true);

$op = isset($data['op']) ? $data['op'] : '';
$obj = new database();

if ($op == 'insert') {
    // Insert a new appointment
    $appointment_no = $data['appointment_no'];
    $appointment_date = $data['appointment_date'];
    $phone_no = $data['phone_no'];
    $customer_name = $data['customer_name'];
    $customer_type = $data['customer_type'];
    $service_man = $data['service_man'];

    $query = "INSERT INTO appointment (appointment_no, appointment_date, phone_no, customer_name, customer_type, service_man) 
              VALUES ('$appointment_no', '$appointment_date', '$phone_no', '$customer_name', '$customer_type', '$service_man')";
    $result = $obj->execute_query($query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Appointment added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add appointment"]);
    }

} else if ($op == 'view') {
    // View appointments
    $result = $obj->view_db('appointment');
    echo json_encode($result);

} else if ($op == 'edit') {
    // Update appointment details
    $id = $data['id'];
    $appointment_no = $data['appointment_no'];
    $appointment_date = $data['appointment_date'];
    $phone_no = $data['phone_no'];
    $customer_name = $data['customer_name'];
    $customer_type = $data['customer_type'];
    $service_man = $data['service_man'];

    $query = "UPDATE appointment SET 
              appointment_no = '$appointment_no', 
              appointment_date = '$appointment_date',
              phone_no = '$phone_no',
              customer_name = '$customer_name',
              customer_type = '$customer_type',
              service_man = '$service_man'
              WHERE id = '$id'";
    $result = $obj->execute_query($query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Appointment updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update appointment"]);
    }
}
?>
