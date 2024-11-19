<?php
include '../../assets/api/connect.php';
session_start();
if (empty($_SESSION['user'])) {
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
    /*--------------------------------------------------------------
         # Profie Page
         --------------------------------------------------------------*/
    .profile .profile-card img {
        max-width: 120px;
    }

    .profile .profile-card h2 {
        font-size: 24px;
        font-weight: 700;
        color: #2c384e;
        margin: 10px 0 0 0;
    }

    .profile .profile-card h3 {
        font-size: 18px;
    }

    .profile .profile-card .social-links a {
        font-size: 20px;
        display: inline-block;
        color: rgba(1, 41, 112, 0.5);
        line-height: 0;
        margin-right: 10px;
        transition: 0.3s;
    }

    .profile .profile-card .social-links a:hover {
        color: #012970;
    }

    .profile .profile-overview .row {
        margin-bottom: 20px;
        font-size: 15px;
    }

    .profile .profile-overview .card-title {
        color: #012970;
    }

    .profile .profile-overview .label {
        font-weight: 600;
        color: rgba(1, 41, 112, 0.6);
    }

    .profile .profile-edit label {
        font-weight: 600;
        color: rgba(1, 41, 112, 0.6);
    }

    .profile .profile-edit img {
        max-width: 120px;
    }

    /* horizental scroll bar */
    /* Hide the default scrollbar */
    ::-webkit-scrollbar {
        display: none;
    }

    /* Style for the custom scrollbar */
    .scroll-container {
        width: 100%;
        overflow-x: auto;
        /* Enable horizontal scrolling */
        white-space: nowrap;
        /* Make sure items stay in a single line */
    }

    .scroll-item {
        display: inline-block;
        width: 200px;
        /* Example width for the items */
        height: 100px;
        /* Example height for the items */
        background-color: #f0f0f0;
        /* Example background color */
        margin-right: 10px;
        /* Example margin between items */
    }

    /* Style the scrollbar track */
    .scroll-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        /* Example track color */
    }

    /* Style the scrollbar thumb */
    .scroll-container::-webkit-scrollbar-thumb {
        background-color: #888;
        /* Example thumb color */
        border-radius: 5px;
        /* Example border radius */
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
                    
                    $sql = "SELECT * FROM navigation group by menue order by id";
                    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_assoc($res)) {
                        if (!empty($row['submenu'])) {
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                            echo $row['menue'] . "</a>";
                            $sql1 = "SELECT * FROM navigation WHERE menue='" . $row['menue'] . "'";
                            $res1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
                            if (mysqli_num_rows($res1) > 0) {
                                echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                    echo "<a class='dropdown-item' href=" . $row1['url'] . ">" . $row1['submenu'] . "</a>";
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
        <section class="breadcrumbs" style="padding : 20px !important;">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2"><b>Patient Profile Section</b></div>
                        <div class="p-2">
                            <!-- <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                           data-target=".bd-example-modal-lg">
                           <i class="fas fa-plus"></i>
                           Add Patient
                           </button> -->
                        </div>
                    </div>
                </div>
            </div>
            <section class="section profile" style="padding-top:20px">
                <div class="row">
                    <!-- <div class="col-xl-3">
                     </div> -->
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #f6f9ff;">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <div class="scroll-container">
                                    <button type="button" onclick="openTab('London')" class="btn btn-outline-success"
                                        style="border-radius: 15px;"><i class="fa-solid fa-user"></i> Overview</button>
                                    <button type="button" onclick="openTab('Paris')" class="btn btn-outline-success"
                                        style="border-radius: 15px;"><i class="fa-solid fa-user-nurse"></i>
                                        Profile</button>
                                    <button type="button" class="btn btn-outline-success" onclick="openTab('medicine')"
                                        style="border-radius: 15px;"><i class="fa-solid fa-file-prescription"></i>
                                        Leave</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Prescription')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Documents</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Consultant_Register')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Timeline</button>
                                </div>
                                <hr>
                                <div id="London" class="tab-content pt-2">
                                    <!-- 1st div start -->
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                            <img src="../../assets/images/1.jpg" alt="Profile"
                                                                class="rounded-circle">
                                                            <h2>ABCD XYZ</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card bg-white shadow" style="border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Over View
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Staff
                                                                    ID</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel"
                                                                    class="col-lg-12 ">Role</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel"
                                                                    class="col-lg-12">Designation</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel"
                                                                    class="col-lg-12 ">Department</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel"
                                                                    class="col-lg-12 ">Specialist</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">EPF
                                                                    No.</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Basic
                                                                    Salary</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Contract
                                                                    Type</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Work
                                                                    Shift</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Work
                                                                    Location</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label for="colFormLabel" class="col-lg-12 ">Date of
                                                                    Joining</label>
                                                                <div class="col-sm-10">
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 1st div end -->
                                </div>
                                <div id="Paris" class="tab-content pt-2" style="display: none;">
                                    <h3>Leave</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg1"><i class="fa-solid fa-plus"></i> Add
                                                Nurse Notes</button>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Leave Type</th>
                                                    <th class="text-center">Leave Date</th>
                                                    <th class="text-center">Days</th>
                                                    <th class="text-center">Apply Date</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="x in ">
                                                    <td class="text-center">{{$index+1}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center">
                                                        <button class="btn-success" title="edit" data-toggle="modal"
                                                            data-target="#exampleModalCenter3"
                                                            ng-click="n_id_type_edit(x.id)"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="btn-danger" title="Delete"
                                                            ng-click="n_id_type_delete(x.id)"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Client Model Section -->
                                        <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Nurse Note</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Date</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Nurse</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Note</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Comment</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button type="button" class="btn btn-success" id="myBtn"
                                                                    ng-click="n_id_type_entry()">Submit</button>
                                                                &nbsp;
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Exit</button>
                                                                &nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Update model section -->
                                        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update Nurse
                                                            Note
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Date</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                    <input type="hidden" class="form-control"
                                                                        ng-model="idd">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Nurse</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Note</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Comment</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal"
                                                            ng-click="n_id_type_update()">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="medicine" class="tab-content pt-2" style="display: none;">
                                    <h3>Leave</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="card text-dark mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Casual Leave()</div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card text-dark mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Privilege Leave (5)</div>
                                                    <div class="card-body">
                                                    <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Sick Leave (6)</div>
                                                    <div class="card-body">
                                                    <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Maternity Leave (2)</div>
                                                    <div class="card-body">
                                                    <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-3">
                                                <div class="card text-dark mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Paternity Leave. (30)</div>
                                                    <div class="card-body">
                                                    <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card text-dark mb-3" style="max-width: 18rem; border-radius: 15px;">
                                                    <div class="card-header">Fever Leave (12)</div>
                                                    <div class="card-body">
                                                    <h5 class="card-title">Used</h5>
                                                        <p class="card-text">Available</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-right">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Leave Type</th>
                                                    <th class="text-center">Leave Date</th>
                                                    <th class="text-center">Days</th>
                                                    <th class="text-center">Apply Date</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="x in ">
                                                    <td class="text-center">{{$index+1}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center">
                                                        <button class="btn-success" title="edit" data-toggle="modal"
                                                            data-target="#exampleModalCenter3"
                                                            ng-click="n_id_type_edit(x.id)"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="btn-danger" title="Delete"
                                                            ng-click="n_id_type_delete(x.id)"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Client Model Section -->
                                        <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Medicine</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Time</label>
                                                                    <input type="time" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Medicine
                                                                        Category</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Medicine
                                                                        Name</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Dosage</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Notes</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button type="button" class="btn btn-success" id="myBtn"
                                                                    ng-click="n_id_type_entry()">Submit</button>
                                                                &nbsp;
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Exit</button>
                                                                &nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="Consultant_Register" class="tab-content pt-2" style="display: none;">
                                    <h3>Consultant Register</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg3"><i class="fa-solid fa-plus"></i> Add
                                                Consultant Register</button>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Applied Date</th>
                                                    <th class="text-center">Instruction Date</th>
                                                    <th class="text-center">Consultant Doctor</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="x in ">
                                                    <td class="text-center">{{$index+1}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center">
                                                        <button class="btn-success" title="edit" data-toggle="modal"
                                                            data-target="#exampleModalCenter3"
                                                            ng-click="n_id_type_edit(x.id)"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="btn-danger" title="Delete"
                                                            ng-click="n_id_type_delete(x.id)"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Client Model Section -->
                                        <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Consultant Register</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Applied
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Instruction
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Consultant
                                                                        Doctor</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button type="button" class="btn btn-success" id="myBtn"
                                                                    ng-click="n_id_type_entry()">Submit</button>
                                                                &nbsp;
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Exit</button>
                                                                &nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Update model section -->
                                        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update
                                                            Consultant Register</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Applied
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                    <input type="hidden" class="form-control"
                                                                        ng-model="idd">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Instruction
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Consultant
                                                                        Doctor</label>
                                                                    <select type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal"
                                                            ng-click="n_id_type_update()">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="Lab_Investigation" class="tab-content pt-2" style="display: none;">
                                    <h3>Lab Investigation</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Test Name</th>
                                                    <th class="text-center">Lab</th>
                                                    <th class="text-center">Sample Collected</th>
                                                    <th class="text-center">Expected Time</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="x in ">
                                                    <td class="text-center">{{$index+1}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.n_id_type}}</td>
                                                    <td class="text-center">
                                                        <button class="btn-success" title="edit" data-toggle="modal"
                                                            data-target="#exampleModalCenter3"
                                                            ng-click="n_id_type_edit(x.id)"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="btn-danger" title="Delete"
                                                            ng-click="n_id_type_delete(x.id)"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </section>
        </section>
        <!-- End Breadcrumbs Section -->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="../controller/main.js"></script>
    <script>
    function openTab(tabName) {
        var i, tabcontent;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
    }
    </script>
</body>

</html>