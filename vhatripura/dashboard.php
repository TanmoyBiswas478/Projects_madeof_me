<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Donation Section</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Updated FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            background: #fff;
            border: 2px solid #EAEAEC;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-top: 40px;
            padding: 20px;
            max-width: 95%;
        }

        .table-container {
            overflow-y: auto;
            font-size: 16px;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }

        .readonly-field {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex" style="background:#2B99EA; height: 60px; color: #fff; border-radius: 15px 15px 0 0;">
                    <div class="mr-auto p-3"><i class="fas fa-bars"></i> <b>Donation Section</b></div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top: 20px;">
            <div class="col-lg-6 text-left">
                <div class="form-group">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Search Keywords</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-container">
                <?php
                include "assets/api/connect.php";

                // Check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                // Check if form is submitted for updating donor
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
                    $id = $_POST['id'];  // Hidden field with donor ID
                    $amount = $_POST['amount'];  // New amount from the form

                    // Update donor amount in the database
                    $update_sql = "UPDATE donors SET amount='$amount' WHERE id='$id'";

                    if ($con->query($update_sql) === TRUE) {
                        echo "Donor updated successfully!";
                    } else {
                        echo "Error updating donor: " . $con->error;
                    }
                }

                // Fetch donor data from the database
                $sql = "SELECT id, name, email, address, phone, pin, pan, amount, remarks, payment_mode, file_path FROM donors";
                $result = $con->query($sql);

                echo '<table class="table table-bordered table-striped" style="font-size: 13px !important;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>PIN</th>
                        <th>PAN</th>
                        <th>Amount (INR)</th>
                        <th>Remarks</th>
                        <th>Payment Mode</th>
                        <th>File Path</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>';

                // Check if records exist
                if ($result->num_rows > 0) {
                    $index = 1; // Row counter
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                            <td>' . $index++ . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['address'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['pin'] . '</td>
                            <td>' . $row['pan'] . '</td>
                            <td>' . $row['amount'] . '</td>
                            <td>' . $row['remarks'] . '</td>
                            <td>' . $row['payment_mode'] . '</td>
                            <td><a href="' . $row['file_path'] . '" target="_blank">View</a></td>
                            <td>
                                <button class="btn btn-success edit-btn"
                                    data-id="' . $row['id'] . '"
                                    data-name="' . $row['name'] . '"
                                    data-email="' . $row['email'] . '"
                                    data-address="' . $row['address'] . '"
                                    data-phone="' . $row['phone'] . '"
                                    data-pin="' . $row['pin'] . '"
                                    data-pan="' . $row['pan'] . '"
                                    data-amount="' . $row['amount'] . '"
                                    data-remarks="' . $row['remarks'] . '"
                                    data-payment_mode="' . $row['payment_mode'] . '">
                                    <i class="fas fa-pen-to-square"></i> Edit
                                </button>
                            </td>
                          </tr>';
                    }
                } else {
                    echo '<tr><td colspan="12" class="text-center">No donors found.</td></tr>';
                }

                echo '</tbody></table>';

                // Close the database connection at the end
                $con->close();
                ?>

            </div>
        </div>
    </div>

    <!-- Modal for editing donor information -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Donation Amount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="id" id="donorId">

                        <!-- Donor Details (Read-only) -->
                        <div class="form-group">
                            <label for="name">Donor Name</label>
                            <input type="text" class="form-control readonly-field" id="name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control readonly-field" id="email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control readonly-field" id="address" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control readonly-field" id="phone" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pin">PIN Code</label>
                            <input type="text" class="form-control readonly-field" id="pin" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pan">PAN</label>
                            <input type="text" class="form-control readonly-field" id="pan" readonly>
                        </div>

                        <!-- Editable Amount Field -->
                        <div class="form-group">
                            <label for="amount">Amount (INR)</label>
                            <input type="number" class="form-control" name="amount" id="amount" required>
                        </div>

                        <!-- Remarks (Read-only) -->
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control readonly-field" id="remarks" readonly></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Script to handle modal opening and form submission -->
    <script>
        $(document).ready(function () {
            $('.edit-btn').on('click', function () {
                // Fill the modal with the donor's details
                $('#donorId').val($(this).data('id'));
                $('#name').val($(this).data('name'));
                $('#email').val($(this).data('email'));
                $('#address').val($(this).data('address'));
                $('#phone').val($(this).data('phone'));
                $('#pin').val($(this).data('pin'));
                $('#pan').val($(this).data('pan'));
                $('#amount').val($(this).data('amount'));
                $('#remarks').val($(this).data('remarks'));

                // Open the modal
                $('#editModal').modal('show');
            });
        });
    </script>
</body>

</html>
