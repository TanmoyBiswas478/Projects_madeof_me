<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donate Us Section</title>
  <!-- Make sure the CSS path is correct -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Optional: You can use this custom CSS to add more styling */
    .centered-heading {
      text-align: center;
      margin-top: 20px; /* Add some space above */
    }
  </style>
</head>
<body>
  <?php
    // Database connection settings
    $host = "localhost"; // Database host (usually localhost)
    $username = "root";  // Your database username
    $password = "";      // Your database password
    $dbname = "vha";  // Your database name

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Variables to store form data
    $name = $email = $address = $phone = $pin = $pan = $amount = $remarks = "";
    $message = "";

    // File upload directory
    $target_dir = "uploads/";

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get form data
      $name = $_POST["name"];
      $email = $_POST["email"];
      $address = $_POST["message"];
      $phone = $_POST["phone"];
      $pin = $_POST["pin"];
      $pan = $_POST["pan"];
      $amount = $_POST["amount"];
      $remarks = $_POST["remarks"];
      $payment_mode = "Online"; // Example of setting a static value for the payment mode

      // Handle the file upload
      if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only certain file formats (e.g., PDF, DOCX, JPG, PNG)
        $allowed_types = ["pdf", "doc", "docx", "jpg", "jpeg", "png"];
        if (in_array($file_type, $allowed_types)) {
          // Move the file to the target directory
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $file_path = $target_file; // File successfully uploaded, save the path
          } else {
            $message = "Sorry, there was an error uploading your file.";
          }
        } else {
          $message = "Sorry, only PDF, DOC, DOCX, JPG, JPEG, and PNG files are allowed.";
        }
      } else {
        $file_path = null; // No file uploaded
      }

      // Insert data into the donations table
      $sql = "INSERT INTO donors (name, email, address, phone, pin, pan, amount, remarks, payment_mode, file_path)
              VALUES ('$name', '$email', '$address', '$phone', '$pin', '$pan', '$amount', '$remarks', '$payment_mode', '$file_path')";

      if ($conn->query($sql) === TRUE) {
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Make sure no further code is executed after the redirect
      } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    // Close the database connection
    $conn->close();
  ?>

  <!-- Display success or error message -->
  <?php if ($message): ?>
    <div class="alert alert-info" role="alert">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <!-- Form Section -->
  <main>
    <div class="container">
      <h2 class="text-center">Donate Us Section</h2><br>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Donor Name *" required>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email *" required>
          </div>
        </div>

        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Address *" required></textarea>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 form-group">
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Donor Phone No *" required maxlength="10">
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="text" class="form-control" name="pin" id="pin" placeholder="Pin Code *" required maxlength="6">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 form-group">
            <input type="text" name="pan" class="form-control" id="pan" placeholder="Donor PAN *" required maxlength="10">
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount *" required>
          </div>
        </div>

        <div class="form-group mt-3">
          <textarea class="form-control" name="remarks" rows="5" placeholder="Remarks *" required></textarea>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 form-group">
            <input type="text" name="payment_mode" class="form-control" id="payment_mode" placeholder="Payment Mode" value="Online" readonly>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="file" class="form-control" name="file_path" id="file" required>
          </div>
        </div>

        <div class="text-center mt-3">
          <button class="btn btn-warning" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </main>

  <!-- Ensure you load the Bootstrap JS and its dependencies if needed -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
