<?php
include '../../assets/api/connect.php';
session_start();
if (empty ($_SESSION['user'])) {
    echo "<script>window.location.href='../index.html';</script>";
} else {
    $user = $_SESSION['user'];
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Section</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- fontawesome link section  -->
    <link rel="stylesheet" href="../../assets/fw/css/all.min.css">
    <script src="../../assets/js/angular.min.js"></script>
    <style>
        .input-fields {
            display: none;
        }
    </style>
</head>

<body>
    <div ng-app="myApp" ng-controller="personCtrl">
        <!-- Navbar section  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ASR Hospitals</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <?php
                                    $sql = "SELECT * FROM permission where ph='" . $user . "' group by menue order by id";
                                    $res = mysqli_query($con, $sql) or die (mysqli_error($con));
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if (!empty ($row['submenue'])) {
                                            echo "<li class='nav-item dropdown'>";
                                            echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                                            echo $row['menue'] . "</a>";
                                            $sql1 = "SELECT * FROM permission WHERE menue='" . $row['menue'] . "' and ph='" . $user . "'";
                                            $res1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                                            if (mysqli_num_rows($res1) > 0) {
                                                echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                                    echo "<a class='dropdown-item' href=" . $row1['url'] . ">" . $row1['submenue'] . "</a>";
                                                    echo "<div class='dropdown-divider'></div>";
                                                }
                                                echo "</div>";
                                            }
                                            echo "</li>";
                                        } else {
                                            echo "<li class='nav-item'>";
                                            echo "<a class='nav-link' href=" . $row['url'] . ">" . $row['menue'] . "</a>";
                                            echo "</li>";
                    
                                        }
                                    }
                                    if ($user == 'Super Admin') {
                                        echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Settings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="menu.php">Menue Section</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="permission.php">User Peremission</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="create_user.php">Create Users</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="active_user.php">Active Users</a>
                        </div>
                      </li>';
                                    }
                    ?>
                    <li class='nav-item'>
                        <a class='nav-link' href="../logout.php">Logout</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    Welcome to Admin
                </form>
            </div>
        </nav>
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs" style="padding : 20px !important;" ng-init="patient_view();staff_view();">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2" style="font-size:20px;"><b>Staff Section</b></div>
                        <div class="p-2">
                            <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                data-target=".bd-example-modal-lg" ng-show="var" ng-click="patient_entry();">
                                <i class="fas fa-plus"></i>
                                Add Staff
                            </button>
                            <button class="btn text-dark" data-toggle="modal" data-target=".bd-example-modal-lg"
                                ng-show="var1" ng-click="patient_view();" style="background-color:#E5E4E2;">
                                <i class="fa-solid fa-users-viewfinder"></i>
                                View Staff
                            </button>
                        </div>
                    </div>
                </div>
                <!-- patient view section -->
                <div class="card-body" ng-show="var1"
                    ng-init="role_view();designation_view();dept_view();specialist_view();">
                    <form action="../../assets/api/staff_regis.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;">
                                <b><i class="fa-solid fa-circle-info"></i>
                                    Basic
                                    Details</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:8px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Staff ID</label>
                                    <input type="text" class="form-control" name="staff_id"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Role</label>
                                    <select class="form-control" name="role" required>
                                        <option></option>
                                        <option ng-repeat="r in role_view_data">{{r.rolename}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Designation</label>
                                    <select class="form-control" name="designation" required>
                                        <option></option>
                                        <option ng-repeat="r in designation_data">{{r.designation}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Depertment</label>
                                    <select class="form-control" name="dept" required>
                                        <option></option>
                                        <option ng-repeat="x in dept_view_data">{{x.dept_name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Father Name</label>
                                    <input type="text" class="form-control" name="father_name"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Mother Name</label>
                                    <input type="text" class="form-control" name="mother_name"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Gender</label>
                                    <select class="form-control" name="gender" required>
                                        <option></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Marital Status</label>
                                    <select class="form-control" name="marital_status" required>
                                        <option> </option>
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Widow</option>
                                        <option>Seperated</option>
                                        <option>Not Specified</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Blood Group</label>
                                    <select class="form-control" name="blood" required>
                                        <option></option>
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Date of Birth</label>
                                    <input type="date" class="form-control" name="dob" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Date of Join</label>
                                    <input type="date" class="form-control" name="doj" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Emergency Contact</label>
                                    <input type="text" class="form-control" name="emer_cont" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Staff Photo</label>
                                    <input type="file" class="form-control" name="photo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Pan Number</label>
                                    <input type="text" class="form-control" name="pan"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Reference Contact</label>
                                    <input type="text" class="form-control" name="reference_contact"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Qualification</label>
                                    <input type="text" class="form-control" style=" text-transform: uppercase;"
                                        name="quali" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Work Experience</label>
                                    <input type="text" class="form-control" name="experience"
                                        style=" text-transform: uppercase;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Specialization</label>
                                    <select class="form-control" name="specilization" required>
                                        <option></option>
                                        <option ng-repeat="z in specialist_data">{{z.specialist}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Note</label>
                                    <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                        name="note" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Current Address</label>
                                    <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                        name="c_add" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Permanent</label>
                                    <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                        name="p_add" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="mr-auto p-2" style="font-size:20px;"><b>Add More Details</b></div>
                                    <div class="p-2">
                                        <button class="btn text-dark" style="background-color:#E5E4E2;"
                                            data-toggle="modal" data-target=".bd-example-modal-lg" id="toggleButton">+
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body input-fields" id="inputFields">
                                <div class="row">
                                    <div class="col-lg-12" style="font-size:20px;">
                                        <b><i class="fa-solid fa-circle-info"></i>
                                            Payroll</b><br>
                                        <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                            <hr>
                                        </Div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">EPF No</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Basic Salary</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Contract Type</label>
                                            <select class="form-control" ng-model="bed_type">
                                                <option> </option>
                                                <option>Permanent</option>
                                                <option>Probation</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Work Shift</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Work Location</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="font-size:20px;">
                                        <b><i class="fa-solid fa-circle-info"></i>
                                            Leaves</b><br>
                                        <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                            <hr>
                                        </Div>
                                    </div>
                                </div>
                                <!-- leaves part Start-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Casual Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Privelage Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Sick Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Maternity Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Paternity Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Fever Leave</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="font-size:20px;">
                                        <b><i class="fa-solid fa-circle-info"></i>
                                            Bank Account Details</b><br>
                                        <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                            <hr>
                                        </Div>
                                    </div>
                                </div>
                                <!-- Bank section Start-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Account Holder Name</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Bank Account No</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Bank Name</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">IFSC Code</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Branch Name</label>
                                            <input type="text" class="form-control" ng-model="unit_name"
                                                style=" text-transform: uppercase;" ng-model="unit_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="font-size:20px;">
                                        <b><i class="fa-solid fa-circle-info"></i>
                                            Upload Documents</b><br>
                                        <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                            <hr>
                                        </Div>
                                    </div>
                                </div>
                                <!-- upload part Start -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Resume </label>
                                            <input type="file" class="form-control" ng-model="unit_name_temp1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Joining Letter</label>
                                            <input type="file" class="form-control" ng-model="unit_name_temp1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Other Documents</label>
                                            <input type="file" class="form-control" ng-model="unit_name_temp1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-success" id="myBtn">Save</button>
                                &nbsp;
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end of patient view section -->
            <!-- patient entry section -->
            <div class="card-body" ng-show="var">
                <table class="table table-bordered text-center">
                    <thead class="table-info">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Staff ID</th>
                            <th width="14%">Name</th>
                            <th width="10%">Role</th>
                            <th width="8%">Designation</th>
                            <th width="10%">Department</th>
                            <th width="10%">Gender</th>
                            <th width="9%">Phone</th>
                            <th width="15%">Email</th>
                            <th width="9%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in staff_data">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{x.staff_id}}</td>
                            <td class="text-center">{{x.name}}</td>
                            <td class="text-center">{{x.role}}</td>
                            <td class="text-center">{{x.designation}}</td>
                            <td class="text-center">{{x.dept}}</td>
                            <td class="text-center">{{x.gender}}</td>
                            <td class="text-center">{{x.phone}}</td>
                            <td class="text-center">{{x.email}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="Edit" data-toggle="modal"
                                    data-target="#exampleModalCenter" ng-click="unit_name_delete(x.id)"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="unit_name_delete(x.id)"><i
                                        class="fa-sharp fa-solid fa-trash"></i></button>
                                <button class="btn-warning" title="Profile" ng-click="unit_name_delete(x.id)"><i
                                        class="fa-solid fa-address-card"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end of patient entry section -->
    </div>
    </section><!-- End Breadcrumbs Section -->
    </div>
    <script>
        document.getElementById('toggleButton').addEventListener('click', function () {
            var inputFields = document.querySelector('.input-fields');
            var button = document.getElementById('toggleButton');

            // Toggle visibility
            if (inputFields.style.display === 'none') {
                inputFields.style.display = 'block';
                button.textContent = '-';
            } else {
                inputFields.style.display = 'none';
                button.textContent = '+';
            }
        });
    </script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="../controller/main.js"></script>
</body>

</html>