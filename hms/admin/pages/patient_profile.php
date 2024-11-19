<?php
// include '../../assets/api/connect.php';
// session_start();
// if (empty($_SESSION['user'])) {
//     echo "<script>window.location.href='../index.html';</script>";
// } else {
//     $user = $_SESSION['user'];
// }

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
    <style>
    /*--------------------------------------------------------------
# Resume
--------------------------------------------------------------*/
    .resume .resume-title {
        font-size: 26px;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 20px;
        color: #45505b;
    }

    .resume .resume-item {
        padding: 0 0 20px 20px;
        margin-top: -2px;
        border-left: 2px solid #0563bb;
        position: relative;
    }

    .resume .resume-item h4 {
        line-height: 18px;
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
        font-family: "Poppins", sans-serif;
        color: #0563bb;
        margin-bottom: 10px;
    }

    .resume .resume-item h5 {
        font-size: 16px;
        background: #f7f8f9;
        padding: 5px 15px;
        display: inline-block;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .resume .resume-item ul {
        padding-left: 20px;
    }

    .resume .resume-item ul li {
        padding-bottom: 10px;
    }

    .resume .resume-item:last-child {
        padding-bottom: 0;
    }

    .resume .resume-item::before {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50px;
        left: -9px;
        top: 0;
        background: #fff;
        border: 2px solid #0563bb;
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
    //                 $sql = "SELECT * FROM permission where ph='" . $user . "' group by menue order by id";
    //                 $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    //                 while ($row = mysqli_fetch_assoc($res)) {
    //                     if (!empty($row['submenue'])) {
    //                         echo "<li class='nav-item dropdown'>";
    //                         echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
    //                         echo $row['menue'] . "</a>";
    //                         $sql1 = "SELECT * FROM permission WHERE menue='" . $row['menue'] . "' and ph='" . $user . "'";
    //                         $res1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
    //                         if (mysqli_num_rows($res1) > 0) {
    //                             echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
    //                             while ($row1 = mysqli_fetch_assoc($res1)) {
    //                                 echo "<a class='dropdown-item' href=" . $row1['url'] . ">" . $row1['submenue'] . "</a>";
    //                                 echo "<div class='dropdown-divider'></div>";
    //                             }
    //                             echo "</div>";
    //                         }
    //                         echo "</li>";
    //                     } else {
    //                         echo "<li class='nav-item'>";
    //                         echo "<a class='nav-link' href=" . $row['url'] . ">" . $row['menue'] . "</a>";
    //                         echo "</li>";

    //                     }
    //                 }
    //                 if ($user == 'Super Admin') {
    //                     echo '<li class="nav-item dropdown">
    //     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //       Settings
    //     </a>
    //     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    //       <a class="dropdown-item" href="menu.php">Menue Section</a>
    //       <div class="dropdown-divider"></div>
    //       <a class="dropdown-item" href="permission.php">User Peremission</a>
    //       <div class="dropdown-divider"></div>
    //       <a class="dropdown-item" href="create_user.php">Create Users</a>
    //       <div class="dropdown-divider"></div>
    //       <a class="dropdown-item" href="active_user.php">Active Users</a>
    //     </div>
    //   </li>';
    //                 }
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
                                        Nurse Note</button>
                                    <button type="button" class="btn btn-outline-success" onclick="openTab('medicine')"
                                        style="border-radius: 15px;"><i class="fa-solid fa-file-prescription"></i>
                                        Medicine</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Prescription')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Prescription</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Consultant_Register')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Consultant Register</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Lab_Investigation')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Lab Investigation</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Operations')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Operations</button>
                                    <button type="button" class="btn btn-outline-success" onclick="openTab('Charges')"
                                        style="border-radius: 15px;"><i class="fa-solid fa-flask-vial"></i>
                                        Charges</button>
                                    <button type="button" class="btn btn-outline-success" onclick="openTab('Payments')"
                                        style="border-radius: 15px;"><i class="fa-solid fa-flask-vial"></i>
                                        Payments</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Bed_History')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Bed History</button>
                                    <button type="button" class="btn btn-outline-success" onclick="openTab('Timeline')"
                                        style="border-radius: 15px;"><i class="fa-solid fa-flask-vial"></i>
                                        Timeline</button>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="openTab('Treatment_History')" style="border-radius: 15px;"><i
                                            class="fa-solid fa-flask-vial"></i>
                                        Treatment History</button>
                                </div>
                                <hr>
                                <div id="London" class="tab-content pt-2">
                                    <!-- 1st div start -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div
                                                            class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                            <img src="../../assets/images/1.jpg" alt="Profile"
                                                                class="rounded-circle">
                                                            <h2>ABCD XYZ</h2>
                                                            <h3>Patient ID: 1234</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card-body">
                                                            <p class="card-text">Case ID:7085</p>
                                                            <p class="card-text">Admission Date: 25-12-2023</p>
                                                            <p class="card-text">Bed No: 10</p>
                                                            <p class="card-text">Guardian Name: ASDF</p>
                                                            <p class="card-text">Age: 23</p>
                                                            <p class="card-text">Gender: Male</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Medication
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Medicine Name</th>
                                                                        <th>Dose</th>
                                                                        <th>Time</th>
                                                                        <th>Remarks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 1st div end -->
                                    <!-- 2nd div start -->
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card-body">
                                                            <h6><i class="fa-solid fa-tag"></i> Known Allergies</h6>
                                                            <li></li>
                                                            <hr>
                                                            <h6><i class="fa-solid fa-tag"></i> Finding</h6>
                                                            <li></li>
                                                            <hr>
                                                            <h6><i class="fa-solid fa-tag"></i> Symptoms</h6>
                                                            <li></li>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Prescription
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">Prescription NO</th>
                                                                        <th width="20%">Date</th>
                                                                        <th width="60%">Finding</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2nd div end -->
                                    <!-- 3rd div start -->
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Consultant Register
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Applied Date</th>
                                                                        <th>Consultant Doctor</th>
                                                                        <th>Instruction</th>
                                                                        <th>Instruction Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Lab Investigation
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Test Name</th>
                                                                        <th>Lab</th>
                                                                        <th>Sample Collected</th>
                                                                        <th>Expected Date</th>
                                                                        <th>Approved By</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 3rd div end -->
                                    <!-- 4th div start -->
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-user-nurse"></i> Nurse
                                                        Note
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date and Time</th>
                                                                        <th>Nurse Name</th>
                                                                        <th>Note</th>
                                                                        <th>Comment</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Operation
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Reference No</th>
                                                                        <th>Operation Date</th>
                                                                        <th>Operation Name</th>
                                                                        <th>Operation Category</th>
                                                                        <th>OT Technician</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 4th div end -->
                                    <!-- 5th div start -->
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>Time
                                                        Line
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date and Time</th>
                                                                        <th>instraction</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Charges
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Name</th>
                                                                        <th>Charge Type</th>
                                                                        <th>Charge Category</th>
                                                                        <th>Qty</th>
                                                                        <th>Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 5th div end -->
                                    <!-- 6th div start -->
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i
                                                            class="fa-solid fa-notes-medical"></i>Payment
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Transaction ID</th>
                                                                        <th>Date</th>
                                                                        <th>Note</th>
                                                                        <th>Payment Mode</th>
                                                                        <th>Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card bg-white shadow"
                                                style="height: 280px; border-radius: 20px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><i class="fa-solid fa-notes-medical"></i>
                                                        Bed History
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Bed Group</th>
                                                                        <th>Bed</th>
                                                                        <th>Form Date</th>
                                                                        <th>To Date</th>
                                                                        <th>Active</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th></th>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 6th div end -->
                                </div>
                                <div id="Paris" class="tab-content pt-2" style="display: none;">
                                    <h3>Nurse Notes</h3>
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
                                                    <th class="text-center">Date and Time</th>
                                                    <th class="text-center">Nurse</th>
                                                    <th class="text-center">Note</th>
                                                    <th class="text-center">Comment</th>
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
                                    <h3>Medicine</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg2"><i class="fa-solid fa-plus"></i> Add
                                                Medicine</button>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Medicine Name</th>
                                                    <th class="text-center">Does1</th>
                                                    <th class="text-center">Does2</th>
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
                                <div id="Operations" class="tab-content pt-2" style="display: none;">
                                    <h3>Operations</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg4"><i class="fa-solid fa-plus"></i> Add
                                                Operations</button>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Reference No</th>
                                                    <th class="text-center">Operation Date</th>
                                                    <th class="text-center">Operation Name</th>
                                                    <th class="text-center">Operation Category</th>
                                                    <th class="text-center">OT Technician</th>
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
                                        <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Operations</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Category</label>
                                                                    <select type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Name</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Assistant
                                                                        Consultant 1</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Assistant
                                                                        Consultant 2</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="formGroupExampleInput">Anesthetist</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Anesthetist
                                                                        Type</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">OT
                                                                        Technician</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">OT
                                                                        Assistant</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Remarks</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Result</label>
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
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update
                                                            Operations</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Category</label>
                                                                    <select type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                        <option></option>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Name</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Operation
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Assistant
                                                                        Consultant 1</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Assistant
                                                                        Consultant 2</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="formGroupExampleInput">Anesthetist</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Anesthetist
                                                                        Type</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">OT
                                                                        Technician</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">OT
                                                                        Assistant</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Remarks</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Result</label>
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
                                <div id="Payments" class="tab-content pt-2" style="display: none;">
                                    <h3>Payments</h3>
                                    <div class="container" ng-init="nation_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg5"><i class="fa-solid fa-plus"></i> Add
                                                Payments</button>
                                        </p>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Transaction No</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Note</th>
                                                    <th class="text-center">Payment Mode</th>
                                                    <th class="text-center">Paid Amount</th>
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
                                        <div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Payments</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Amount</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Payment
                                                                        Mode</label>
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
                                                                    <label for="formGroupExampleInput">Note</label>
                                                                    <textarea type="date" class="form-control"
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
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update
                                                            Payments</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Amount</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Payment
                                                                        Mode</label>
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
                                                                    <label for="formGroupExampleInput">Note</label>
                                                                    <textarea type="date" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
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
                                </div>
                                <div id="Bed_History" class="tab-content pt-2" style="display: none;">
                                    <h3>Bed History</h3>
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
                                                    <th class="text-center">Bed Group</th>
                                                    <th class="text-center">Bed</th>
                                                    <th class="text-center">Form Date</th>
                                                    <th class="text-center">To Date</th>
                                                    <th class="text-center">Bed Status</th>
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
                                <div id="Timeline" class="tab-content pt-2" style="display: none;">
                                    <h3>Timeline</h3>
                                    <div class="container" ng-init="timeline_view();">
                                        <p class="text-right">
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg6"><i class="fa-solid fa-plus"></i> Add
                                                Timeline</button>
                                        </p>
                                        <!-- <table class="table table-bordered ">
                                            <thead>
                                                <tr class="table-info text-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Attachment</th>
                                                    <th class="text-center">User</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="x in timeline_data">
                                                    <td class="text-center">{{$index+1}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.doe}}</td>
                                                    <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.title}}</td>
                                                        <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.descc}}</td>
                                                        <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.file}}</td>
                                                        <td class="text-center" style="text-transform: capitalize;">
                                                        {{x.user}}</td>
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
                                        </table> -->
                                        <section id="resume" class="resume">
                                            <div class="row" ng-repeat="x in timeline_data">
                                                <div class="col-lg-12">
                                                    <h3 class="resume-title">{{x.doe}}</h3>
                                                    <div class="resume-item pb-0">
                                                        <h4>{{x.title}}</h4>
                                                        <p><em>{{x.descc}}</em></p>
                                                        <ul>
                                                            <li>Instructor: {{x.user}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Client Model Section -->
                                        <div class="modal fade bd-example-modal-lg6" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <h2 class="text-center">Add Timeline</h2>
                                                    <div class="container" style="padding-bottom: 20px !important;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Title</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="title" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Attach
                                                                        Doucment</label>
                                                                    <input type="file" class="form-control"
                                                                        ng-model="file" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="formGroupExampleInput">Description</label>
                                                                    <textarea type="text" class="form-control"
                                                                        ng-model="descc" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button type="button" class="btn btn-success" id="myBtn"
                                                                    ng-click="timeline_entry()">Submit</button>
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
                                                            Payments</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Title</label>
                                                                    <input type="text" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput">Attach
                                                                        Doucment</label>
                                                                    <input type="file" class="form-control"
                                                                        ng-model="n_id_type" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="formGroupExampleInput">Description</label>
                                                                    <textarea type="date" class="form-control"
                                                                        ng-model="n_id_type" required></textarea>
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
                                </div>
                                <div id="Treatment_History" class="tab-content pt-2" style="display: none;">
                                    <h3>Treatment History</h3>
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
                                                    <th class="text-center">IPD NO</th>
                                                    <th class="text-center">Symptoms</th>
                                                    <th class="text-center">Consultant</th>
                                                    <th class="text-center">Bed</th>
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