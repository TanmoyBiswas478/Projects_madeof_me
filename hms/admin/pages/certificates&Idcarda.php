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


        <!-- <h2>Human Resource Section</h2> -->


        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Certificate')">Certificate</button>
            <button class="tablinks" onclick="openCity(event, 'Pacent Id Card')">Patient Id Card</button>
            <button class="tablinks" onclick="openCity(event, 'Staff Id Card')">Staff Id Card</button>
            <button class="tablinks" onclick="openCity(event, 'ID Templates')">ID Templates</button>

        </div>

        <div id="Certificate" class="tabcontent" style="padding : -0px">
            <!-- <h3>Certificate</h3>
            <div style="padding-top: 20px;" ng-init="role_view()"> -->
            <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
            <!-- ======= Breadcrumbs Section ======= -->
            <section class="breadcrumbs" style="padding : 2px !important;">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        Certificate Section
                    </div>


                    <!-- Client Model Section -->
                    <div class="modle-container">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i> Select
                                    Criteria</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Type</label>
                                        <select class="form-control" ng-model="Changeit">
                                            <option>IPD</option>
                                            <option>OPD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Id Template</label>
                                        <select class="form-control" ng-model="Changeit">
                                            <option ng-repeat="z in Changeit_data">{{z.Changeit }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-success" id="myBtn"
                                    ng-click="unit_name_entry()">Search</button> &nbsp;
                            </div>
                        </div>


                    </div>



                    <!-- <h2 class="text-center"><u>Add Section</u></h2> -->
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i>Pacent
                                List</b><br>
                            <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </Div>
                        </div>
                    </div>

                    <div class="container">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="table-warning text-dark">
                                    <th class="text-center">#</th>
                                    <th class="text-center" style=" text-transform: uppercase;">OPD/IPD NO</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Pacent Name</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Age</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Gender</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Mobile Number</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Check Box</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr ng-repeat="x in unit_name_view">
                                    <td class="text-center">{{$index+1}}</td>
                                    <td class="text-center">{{x.unit_name}}</td>
                                    <td class="text-center">{{x.unit_name}}</td>
                                    <td class="text-center">{{x.unit_name}}</td>
                                    <td class="text-center">{{x.unit_name}}</td>
                                    <td class="text-center">
                                        <input type="checkbox" name="s" id="soc">
                                        <label for="soc">Check Box</label>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-success" title="Edit" data-toggle="modal"
                                            data-target="#exampleModalCenter" ng-click="unit_name_delete(x.id)"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        <!-- <button class="btn-danger" title="Delete" ng-click="unit_name_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Update Model Section  -->

            <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Role Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Role Name</label>
                                        <input type="text" class="form-control" ng-model="rolename" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer"> -->
            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
            <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="role_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- End of 1st Tab  -->
        </div>


        <div id="Pacent Id Card" class="tabcontent" style="padding : -0px">
            <!-- <h3>Pacent Id Card Section</h3> -->
            <!-- <div style="padding-top: 20px;" ng-init="role_view()"> -->
            <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
            <!-- ======= Breadcrumbs Section ======= -->
            <section class="breadcrumbs" style="padding : 2px !important;">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        Patient ID Section
                    </div>


                    <!-- Client Model Section -->
                    <div class="modle-container">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i> Select
                                    Criteria</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Patient ID</label>
                                        <!-- <select class="form-control" ng-model="Changeit"> -->
                                        <!-- <option type="search"></option>
                                        <option ng-repeat=" z in Changeit_data">{{z.Changeit }}</option> -->
                                        <input type="text" list="it"
                                            class="form-control ng-pristine ng-valid ng-empty ng-touched"
                                            ng-model="search" ng-blur="receipe_insert_test()">
                                        <!-- </select> -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Id Template</label>
                                        <select class="form-control" ng-model="Changeit">
                                            <option ng-repeat="z in Changeit_data">{{z.Changeit }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-success" id="myBtn"
                                ng-model="search">Search</button> &nbsp;
                            </div>
                        </div> -->


                    </div>



                    <!-- <h2 class="text-center"><u>Add Section</u></h2> -->
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i>Patient
                                List</b><br>
                            <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </Div>
                        </div>
                    </div>

                    <div class="container" ng-init="patient_id_view();">
                        <table class="table table-bordered text-center">
                            <thead class="table-info">
                                <tr>
                                    <th width="8%">#</th>
                                    <th width="10%">Patient ID</th>
                                    <th width="15%">Patient Name</th>
                                    <th width="15%">Guardian Name</th>
                                    <th width="5%">Age</th>
                                    <th width="15%">Gender</th>
                                    <th width="10%">Phone No</th>
                                    <th width="10%">Bed Group</th>
                                    <th width="7%">Bed ID</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="a in patient_id_view_data | filter: search">
                                    <th>{{$index+1}}</th>
                                    <td>{{a.patient_id}}</td>
                                    <td style="text-transform: uppercase;">{{a.patient_name}}</td>
                                    <td style="text-transform: capitalize;">{{a.father_name}}</td>
                                    <td>{{a.age}}</td>
                                    <td style="text-transform: capitalize;">{{a.gender}}</td>
                                    <td>{{a.mobile}}</td>
                                    <td style="text-transform: uppercase;">{{a.bed_type}}</td>
                                    <td style="text-transform: uppercase;">{{a.bed_no}}</td>
                                    <td class="text-center"><button class="btn-warning" title="Generate ID"
                                            data-toggle="modal" data-target="#exampleModalCenter" ng-click=""><i
                                                class="fa-regular fa-id-card"></i></button>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-success" id="myBtn" ng-click="unit_name_entry()">Search</button> &nbsp;
                        </div>
                    </div> -->

                    </div>
                </div>
            </section>
        </div>
        <div id="Staff Id Card" class="tabcontent" style="padding : -0px">
            <!-- <h3>Staff Id Card Section</h3>
        <div style="padding-top: 20px;" ng-init="role_view()"> -->
            <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
            <!-- ======= Breadcrumbs Section ======= -->
            <section class="breadcrumbs" style="padding : 2px !important;">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        Staff ID Section
                    </div>


                    <!-- Client Model Section -->
                    <div class="modle-container">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i> Select
                                    Criteria</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Role</label>
                                        <input type="text"
                                            class="form-control ng-pristine ng-valid ng-empty ng-touched" ng-model="search">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Id Template</label>
                                        <select class="form-control" ng-model="Changeit">
                                            <option ng-repeat="z in Changeit_data">{{z.Changeit }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



                    <!-- <h2 class="text-center"><u>Add Section</u></h2> -->
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i>Patient
                                List</b><br>
                            <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </Div>
                        </div>
                    </div>

                    <div class="container">
                        <table class="table table-bordered table-striped" ng-init="staff_view();">
                            <thead>
                                <tr class="table-info text-dark">
                                    <th class="text-center">#</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Staff ID</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Name</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Role</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Designation</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Depertment</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Gender</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Phone</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Email</th>
                                    <th class="text-center" style=" text-transform: uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr ng-repeat="x in staff_data | filter: search">
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
                                            data-target="#exampleModalCenter" ng-click="unit_name_delete(x.id)"><i class="fa-solid fa-print"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Update Model Section  -->
            <!-- <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Department Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department Name</label>
                                        <input type="text" class="form-control" ng-model="rolename" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer"> -->
            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
            <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="role_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- End of 3rd Tab -->
        </div>


        <div id="ID Templates" class="tabcontent">
            <h3>National IDs Section</h3>
            <div class="container">
                <p class="text-right">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg3"><i
                            class="fa-solid fa-plus"></i> Add Template</button>
                </p>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="table-warning text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center" style=" text-transform: uppercase;">Template Type</th>
                            <th class="text-center" style=" text-transform: uppercase;">Id Template</th>
                            <th class="text-center" style=" text-transform: uppercase;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="x in unit_name_view">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{x.unit_name}}</td>
                            <td class="text-center">{{x.unit_name}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="Edit" data-toggle="modal"
                                    data-target="#exampleModalCenter3" ng-click="unit_name_delete(x.id)"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="unit_name_delete(x.id)"><i
                                        class="fa-sharp fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Client Model Section -->
        <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h2 class="text-center">Add Template Section</h2>
                    <div class="container" style="padding-bottom: 20px !important;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Template Type</label>
                                    <input type="text" class="form-control" ng-model="unit_name"
                                        style=" text-transform: uppercase;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Template</label>
                                    <input type="file" class="form-control" ng-model="unit_name"
                                        style=" text-transform: uppercase;">
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-success" id="myBtn"
                                    ng-click="unit_name_entry()">Submit</button> &nbsp;
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Template Update Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Template Type</label>
                                    <input type="text" class="form-control" ng-model="unit_name"
                                        style=" text-transform: uppercase;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Template</label>
                                    <input type="file" class="form-control" ng-model="unit_name"
                                        style=" text-transform: uppercase;">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            ng-click="n_id_type_update()">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of 4th Tab -->



        <script>
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