<?php
include 'connect.php';

// Get input data
$data = json_decode(file_get_contents("php://input"));
$state = $data->state ?? ''; // Ensure $state is set to avoid errors
$scode = substr($state, 0, 2); // Extract first 2 characters

// Use prepared statement to secure query
$sql = "SELECT State FROM state WHERE code = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    // Bind the parameter and execute the query
    $stmt->bind_param("s", $scode); // "s" indicates the type is string
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if results exist
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $state = $row['State']; // Assign the full state name
    } else {
        $state = 'Tripura'; // Fallback to default state name
    }

    $stmt->close(); // Close the statement
} else {
    die("Statement preparation failed: " . $con->error);
}

// Output the result as JSON
$output = [$state]; // Ensuring it's an array with the state name
echo json_encode($output);

// Close the database connection
$con->close();
?>
