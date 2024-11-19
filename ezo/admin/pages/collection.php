<?php
// // Database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Initialize collection variables
// $todayCollection = $monthlyCollection = $yearlyCollection = 0;

// // Get today's date
// $todayDate = date('Y-m-d');

// // Get the first and last day of the current month
// $firstDayOfMonth = date('Y-m-01');
// $lastDayOfMonth = date('Y-m-t');

// // Get the first and last day of the current year
// $firstDayOfYear = date('Y-01-01');
// $lastDayOfYear = date('Y-12-31');

// // Today's Collection
// $todaySql = "SELECT SUM(amount) AS total FROM donors WHERE DATE(doe) = '$todayDate'";
// $todayResult = $conn->query($todaySql);
// if (!$todayResult) {
//     die("Error in Today's Collection Query: " . $conn->error . "<br>SQL: " . $todaySql);
// }
// if ($todayResult->num_rows > 0) {
//     $row = $todayResult->fetch_assoc();
//     $todayCollection = $row['total'] ? $row['total'] : 0;
// }

// // Monthly Collection
// $monthlySql = "SELECT SUM(amount) AS total FROM donors WHERE DATE(doe) BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'";
// $monthlyResult = $conn->query($monthlySql);
// if (!$monthlyResult) {
//     die("Error in Monthly Collection Query: " . $conn->error . "<br>SQL: " . $monthlySql);
// }
// if ($monthlyResult->num_rows > 0) {
//     $row = $monthlyResult->fetch_assoc();
//     $monthlyCollection = $row['total'] ? $row['total'] : 0;
// }

// // Yearly Collection
// $yearlySql = "SELECT SUM(amount) AS total FROM donors WHERE DATE(doe) BETWEEN '$firstDayOfYear' AND '$lastDayOfYear'";
// $yearlyResult = $conn->query($yearlySql);
// if (!$yearlyResult) {
//     die("Error in Yearly Collection Query: " . $conn->error . "<br>SQL: " . $yearlySql);
// }
// if ($yearlyResult->num_rows > 0) {
//     $row = $yearlyResult->fetch_assoc();
//     $yearlyCollection = $row['total'] ? $row['total'] : 0;
// }

// // Close connection
// $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Summary</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Collection Summary</h2>
        <div class="row">
            <!-- Today's Collection -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        Today's Collection
                    </div>
                    <div class="card-body">
                        <h3>INR <?php echo number_format($todayCollection, 2); ?></h3>
                    </div>
                </div>
            </div>

            <!-- Monthly Collection -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">
                        Monthly Collection
                    </div>
                    <div class="card-body">
                        <h3>INR <?php echo number_format($monthlyCollection, 2); ?></h3>
                    </div>
                </div>
            </div>

            <!-- Yearly Collection -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header bg-info text-white">
                        Yearly Collection
                    </div>
                    <div class="card-body">
                        <h3>INR <?php echo number_format($yearlyCollection, 2); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
