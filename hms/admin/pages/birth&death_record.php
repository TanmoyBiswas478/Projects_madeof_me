<?php
include '../../assets/api/connect.php';
session_start();
if (empty ($_SESSION['user'])) {
    echo "<script>window.location.href='../index.html';</script>";
} else {
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASR Hospitals</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- fontawesome link section  -->
    <link rel="stylesheet" href="../../assets/fw/css/all.min.css">
    <script src="../../assets/js/angular.min.js"></script>
    <style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
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
                    $res = mysqli_query($con, $sql) or die (mysqli_error($con));
                    while ($row = mysqli_fetch_assoc($res)) {
                        if (!empty ($row['submenu'])) {
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' st='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                            echo $row['menue'] . "</a>";
                            $sql1 = "SELECT * FROM navigation WHERE menue='" . $row['menue'] . "'";
                            $res1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" st="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'London')">Birth Record</button>
            <button class="tablinks" onclick="openCity(event, 'Paris')">Death Record</button>
            <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
        </div>
        <div id="London" class="tabcontent">
            <h3>Birth Record</h3>
            <div style="padding-top: 20px;" ng-init="birth_view();">
                <!-- <h2 class="text-center"><u>Birth Record Section</u></h2> -->

                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                class="fa-solid fa-plus"></i> Add Birth Records</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Case ID</th>
                                <th class="text-center" style=" text-transform: uppercase;">Child Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Gender</th>
                                <th class="text-center" style=" text-transform: uppercase;">Birth Date</th>
                                <th class="text-center" style=" text-transform: uppercase;">Mother's Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Father's Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="x in birth_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.case_id}}</td>
                                <td class="text-center">{{x.name}}</td>
                                <td class="text-center">{{x.gender}}</td>
                                <td class="text-center">{{x.dob}}</td>
                                <td class="text-center">{{x.mother_name}}</td>
                                <td class="text-center">{{x.father_name}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="View" data-toggle="modal"
                                        data-target="#exampleModalCenter" ng-click="birth_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Download" ng-click="birth_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Add Birth Details</h2>
                        <div class="container" style="padding-bottom: 20px !important;">
                            <form action="../../assets/api/birth_record.php" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Child Name</label>
                                            <input type="text" class="form-control" ng-model="name" name="name"
                                                style=" text-transform: uppercase;">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Gender</label>
                                            <select class="form-control" ng-model="gender" name="gender">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Weight</label>
                                            <input type="text" class="form-control" ng-model="weight" name="weight">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Upload Child Photo</label>
                                            <input type="file" class="form-control" ng-model="child_photo"
                                                name="child_photo">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Birth Date</label>
                                            <input type="date" class="form-control" ng-model="dob" name="dob">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Phone Number</label>
                                            <input type="text" class="form-control" ng-model="ph" name="ph">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Adderss</label>
                                            <input type="text" class="form-control" ng-model="address" name="address">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Case ID</label>
                                            <input type="text" class="form-control" ng-model="case_id" name="case_id">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Mother Name</label>
                                            <input type="text" class="form-control" ng-model="mother_name"
                                                name="mother_name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Upload Mother Photo</label>
                                            <input type="file" class="form-control" ng-model="mother_photo"
                                                name="mother_photo">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Father Name</label>
                                            <input type="text" class="form-control" ng-model="father_name"
                                                name="father_name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Upload Father Photo</label>
                                            <input type="file" class="form-control" ng-model="father_photo"
                                                name="father_photo">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Report</label>
                                            <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                                ng-model="report" name="report"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Attach Document </label>
                                            <input type="file" class="form-control" ng-model="attachment"
                                                name="attachment">
                                        </div>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success" id="myBtn">Submit</button> &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                        &nbsp;
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Birth Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Child Name</label>
                                        <input type="text" class="form-control" ng-model="name" name="name"
                                            style=" text-transform: uppercase;">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Gender</label>
                                        <select class="form-control" ng-model="gender" name="gender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Weight</label>
                                        <input type="text" class="form-control" ng-model="weight" name="weight">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Upload Child Photo</label>
                                        <input type="file" class="form-control" ng-model="child_photo"
                                            name="child_photo">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Date of Birth</label>
                                        <input type="date" class="form-control" ng-model="dob" name="dob">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Phone Number</label>
                                        <input type="text" class="form-control" ng-model="ph" name="ph">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Adderss</label>
                                        <input type="text" class="form-control" ng-model="address" name="address">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Case ID</label>
                                        <input type="text" class="form-control" ng-model="case_id" name="case_id">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Mother Name</label>
                                        <input type="text" class="form-control" ng-model="mother_name"
                                            name="mother_name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Upload Mother Photo</label>
                                        <input type="file" class="form-control" ng-model="mother_photo"
                                            name="mother_photo">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Father Name</label>
                                        <input type="text" class="form-control" ng-model="father_name"
                                            name="father_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Upload Father Photo</label>
                                        <input type="file" class="form-control" ng-model="father_photo"
                                            name="father_photo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Report</label>
                                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                            ng-model="report" name="report"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Attach Document </label>
                                        <input type="file" class="form-control" ng-model="attachment" name="attachment">
                                    </div>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    ng-click="birth_update()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="Paris" class="tabcontent">
            <h3>Death Record</h3>
            <div style="padding-top: 20px;" ng-init="death_view()">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                                class="fa-solid fa-plus"></i> Add Death Records</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Case ID</th>
                                <th class="text-center" style=" text-transform: uppercase;">Patient Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Guardian Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Death Date</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="y in death_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{y.case_id}}</td>
                                <td class="text-center">{{y.name}}</td>
                                <td class="text-center">{{y.guardian}}</td>
                                <td class="text-center">{{y.dod}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="View" data-toggle="modal"
                                        data-target="#exampleModalCenter1" ng-click="death_edit(y.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Download" ng-click="death_delete(y.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Add Death Record</h2>

                        <div class="container" style="padding-bottom: 20px !important;">
                            <form method="post" action="../../assets/api/death_record.php">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Case ID</label>
                                            <input type="text" class="form-control" ng-model="case_id" name="case_id"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Patient Name</label>
                                            <input type="text" class="form-control" ng-model="name" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Date of Death</label>
                                            <input type="date" class="form-control" ng-model="dod" name="dod">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Guardian Name</label>
                                            <input type="text" class="form-control" ng-model="guardian" name="guardian">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Phone number </label>
                                            <input type="text" class="form-control" ng-model="ph" name="ph">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Report</label>
                                            <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                                ng-model="report" name="report"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Attach Document </label>
                                            <input type="file" class="form-control" ng-model="attachment"
                                                name="attachment">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success" id="myBtn">Submit</button> &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                        &nbsp;
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalTitle">Update Death Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Case ID</label>
                                        <input type="text" class="form-control" ng-model="case_id" name="case_id">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Patient Name</label>
                                        <input type="text" class="form-control" ng-model="name" name="name">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Death Date</label>
                                        <input type="text" class="form-control" ng-model="dod" name="dod">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Guardian Name</label>
                                        <input type="text" class="form-control" ng-model="guardian" name="guardian">
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Phone number </label>
                                        <input type="text" class="form-control" ng-model="ph" name="ph">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Report</label>
                                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                            ng-model="report" name="report"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Attach Document </label>
                                        <input type="file" class="form-control" ng-model="attachment" name="attachment">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            ng-click="death_update()">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Trigger click event on the button for the "Symtoms Header" tab
        document.querySelector(".tab button:nth-child(2)").click();
    });

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>
    <!-- Bootstrap JS (optional if you need dropdowns, modals, etc.) -->
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
</body>

</html>