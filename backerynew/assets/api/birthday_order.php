<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "backery");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data and sanitize
$ono = $conn->real_escape_string($_POST['ono']);
$odate = $conn->real_escape_string($_POST['odate']);
$rdate = $conn->real_escape_string($_POST['rdate']);
$ph = $conn->real_escape_string($_POST['ph']);
$name = $conn->real_escape_string($_POST['name']);
$wph = $conn->real_escape_string($_POST['wph']);
$qty = $conn->real_escape_string($_POST['qty']);
$unit = $conn->real_escape_string($_POST['unit']);
$rate = $conn->real_escape_string($_POST['rate']);
$other_chrg = $conn->real_escape_string($_POST['other_chrg']);
$disc = $conn->real_escape_string($_POST['disc']);
$gst = $conn->real_escape_string($_POST['gst']);
$gstrs = $conn->real_escape_string($_POST['gstrs']);
$total = $conn->real_escape_string($_POST['total']);
$note = $conn->real_escape_string($_POST['note']);
$cflav = $conn->real_escape_string($_POST['cflav']);
$fflav = $conn->real_escape_string($_POST['fflav']);
$shape = $conn->real_escape_string($_POST['shape']);
$ctype = $conn->real_escape_string($_POST['ctype']);
$cream = $conn->real_escape_string($_POST['cream']);
$color = $conn->real_escape_string($_POST['color']);
$advance = $conn->real_escape_string($_POST['advance']);
$balance = $conn->real_escape_string($_POST['balance']);
$user = $conn->real_escape_string($_POST['user']);

// SQL Insert Query
$sql = "INSERT INTO ordertb (ono, odate, rdate, ph, name, wph, qty, unit, rate, other_chrg, disc, gst, gstrs, total, note, cflav, fflav, shape, ctype, cream, color, advance, balance, user) VALUES 
('$ono', '$odate', '$rdate', '$ph', '$name', '$wph', '$qty', '$unit', '$rate', '$other_chrg', '$disc', '$gst', '$gstrs', '$total', '$note', '$cflav', '$fflav', '$shape', '$ctype', '$cream', '$color', '$advance', '$balance', '$user')";

// Execute SQL Query and Check for Errors
if ($conn->query($sql) === TRUE) {
    echo "Order successfully recorded.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
