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
        <h2>Hospital Charges Section</h2>

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'London')">Unit Section</button>
            <button class="tablinks" onclick="openCity(event, 'Paris')">Tax Category</button>
            <button class="tablinks" onclick="openCity(event, 'Tokyo')">Charge Type</button>
            <button class="tablinks" onclick="openCity(event, 'London1')">Charge Category</button>
            <button class="tablinks" onclick="openCity(event, 'Paris2')">Charges</button>

        </div>

        <div id="London" class="tabcontent">
            <h3>Unit Section</h3>
            <div style="padding-top: 20px;" ng-init="unit_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                class="fa-solid fa-plus"></i> Add Unit</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Unit Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="u in unit_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: lowercase;">{{u.unit_name}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter" ng-click="unit_edit(u.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger" title="Delete" ng-click="unit_delete(u.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" st="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Unit Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Unit Name</label>
                                        <input type="text" class="form-control" ng-model="unit_name" style="text-transform: lowercase;" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="unit_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <!-- Update model section -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" st="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" st="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Unit Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Unit Name</label>
                                        <input type="text" class="form-control" ng-model="unit_name" style="text-transform: lowercase;" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="unit_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 1st Tab -->
        </div>

        <div id="Paris" class="tabcontent">
            <h3>Tax Category</h3>
            <div style="padding-top: 20px;" ng-init="percent_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                                class="fa-solid fa-plus"></i> Add Tax Category</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Tax Name</th>
                                <th class="text-center">Percent(%)</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="p in percent_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{p.name}}</td>
                                <td class="text-center">{{p.percent}}</td>

                                <td class="text-center">
                                    <button class="btn btn-success" title="edit" data-toggle="modal" data-target="#myModal"
                                        ng-click="percent_edit(p.id)"><i class="fa-solid fa-pen-to-square"></i></button>

                                    <button class="btn btn-danger" title="Delete" ng-click="percent_delete(p.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg1" tabindex="-1" st="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Tax Category</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax Category Name</label>
                                        <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="name" required>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Percent(%)</label>
                                        <input type="text" class="form-control" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="percent" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="percent_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="myModal" tabindex="-1" st="dialog" aria-labelledby="myModalTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" st="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalTitle">Edit st</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax Category Name</label>
                                        <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="name" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Percent(%)</label>
                                        <input type="text" class="form-control" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="percent" required>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="percent_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of 2nd Tab -->

        </div>




        <div id="Tokyo" class="tabcontent">
            <h3>Charges Type</h3>
            <div style="padding-top: 20px;" ng-init="charge_type_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg2"><i
                                class="fa-solid fa-plus"></i> Add Charges Type</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Charge Type</th>
                                <th class="text-center">Appoinment</th>
                                <th class="text-center">OPD</th>
                                <th class="text-center">IPD</th>
                                <th class="text-center">Pathology</th>
                                <th class="text-center">Radiology</th>
                                <th class="text-center">Radiology</th>
                                <th class="text-center">Ambulance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in charge_type_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.charge_type}}</td>
                                <td class="text-center">{{x.appoinment}}</td>
                                <td class="text-center">{{x.opd}}</td>
                                <td class="text-center">{{x.ipd}}</td>
                                <td class="text-center">{{x.pathology}}</td>
                                <td class="text-center">{{x.radiology}}</td>
                                <td class="text-center">{{x.radiology}}</td>
                                <td class="text-center">{{x.ambulance}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter2" ng-click="charge_type_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger" title="Delete" ng-click="charge_type_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg2" tabindex="-1" st="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Charges Type Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Charge Type</label>
                                            <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="charge_type">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="Appointment" ng-model="appoinment">
                                            <label class="form-check-label" for="inlineCheckbox1">Appointment</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="OPD" ng-model="opd">
                                            <label class="form-check-label" for="inlineCheckbox1">OPD</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="IPD" ng-model="ipd">
                                            <label class="form-check-label" for="inlineCheckbox1">IPD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="Pathology" ng-model="pathology">
                                            <label class="form-check-label" for="inlineCheckbox1">Pathology</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="Radiology" ng-model="radiology">
                                            <label class="form-check-label" for="inlineCheckbox1">Radiology</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="Blood Bank" ng-model="blood_bank">
                                            <label class="form-check-label" for="inlineCheckbox1">Blood Bank</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="Ambulance" ng-model="ambulance">
                                            <label class="form-check-label" for="inlineCheckbox1">Ambulance</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="charge_type_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" st="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" st="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Charges Typer Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Charge Type</label>
                                        <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="charge_type">
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="Appointment" ng-model="appoinment">
                                        <label class="form-check-label" for="inlineCheckbox1">Appointment</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="OPD"
                                            ng-model="opd">
                                        <label class="form-check-label" for="inlineCheckbox1">OPD</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="IPD"
                                            ng-model="ipd">
                                        <label class="form-check-label" for="inlineCheckbox1">IPD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="Pathology" ng-model="pathology">
                                        <label class="form-check-label" for="inlineCheckbox1">Pathology</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="Radiology" ng-model="radiology">
                                        <label class="form-check-label" for="inlineCheckbox1">Radiology</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="Blood Bank" ng-model="blood_bank">
                                        <label class="form-check-label" for="inlineCheckbox1">Blood Bank</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="Ambulance" ng-model="ambulance">
                                        <label class="form-check-label" for="inlineCheckbox1">Ambulance</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="charge_type_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 3rd Tab -->
        </div>



        <div id="London1" class="tabcontent">
            <h3>Charges Category</h3>
            <div style="padding-top: 20px;" ng-init="charge_cat_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg3"><i
                                class="fa-solid fa-plus"></i> Add Charges Category</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Charges Type</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in charge_cat_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.charge_type}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.name}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.descp}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter3" ng-click="charge_cat_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger" title="Delete" ng-click="charge_cat_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg3" tabindex="-1" st="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Charges Category Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-6" ng-init="charge_type_view();">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charges Type</label>
                                        <select class="form-control" style="text-transform:capitalize;" ng-model="charge_type">
                                            <option ng-repeat="c in charge_type_data">{{c.charge_type}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Name</label>
                                        <input type="text" style="text-transform:capitalize;" class="form-control" ng-model="name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" style="text-transform:capitalize;" type="text" id="exampleFormControlTextarea1"
                                            ng-model="descp"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="charge_cat_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" st="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" st="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Charges Type Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6" ng-init="charge_type_view();">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charges Type</label>
                                        <select class="form-control" ng-model="charge_type" style="text-transform:capitalize;">
                                            <option ng-repeat="c in charge_type_data">{{c.charge_type}}</option>
                                            <input type="hidden" class="form-control" ng-model="idd">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Name</label>
                                        <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" type="text" style="text-transform:capitalize;" id="exampleFormControlTextarea1"
                                            ng-model="descp"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="charge_cat_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 4th Tab -->
        </div>


        <div id="Paris2" class="tabcontent">
            <h3>Charges </h3>
            <div style="padding-top: 20px;" ng-init="charge_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg4"><i
                                class="fa-solid fa-plus"></i> Add Charges</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center" width="7%">#</th>
                                <th class="text-center" width="15%">Charge Type</th>
                                <th class="text-center" width="15%">Charge Category</th>
                                <th class="text-center" width="5%">Unit</th>
                                <th class="text-center" width="15%">Charge Name</th>
                                <th class="text-center" width="5%">Tax</th>
                                <th class="text-center" width="5%">Percentage</th>
                                <th class="text-center" width="5%">Standard Charges</th>
                                <th class="text-center" width="15%">Description</th>
                                <th class="text-center" width="13%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="x in charge_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.charge_type}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.name_cat}}</td>
                                <td class="text-center" style="text-transform:lowercase;">{{x.unit}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.name}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.tax}}</td>
                                <td class="text-center">{{x.tax_per}}</td>
                                <td class="text-center">{{x.standard_charge}}</td>
                                <td class="text-center" style="text-transform:capitalize;">{{x.descp}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn-success" data-toggle="modal" title="Edit"
                                        data-target=".bd-example-modal-lg5" ng-click="charge_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="charge_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Add Charges</h2>
                        <div class="container" style="padding-bottom: 20px !important;"
                            ng-init="unit_view();charge_cat_view1();percent_view();">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charge Type</label>
                                        <select class="form-control" ng-model="charge_type" style="text-transform:capitalize;" ng-blur="searchtype();">
                                            <option ng-repeat="z in charge_cat_data1">{{z.charge_type}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charge Category</label>
                                        <select class="form-control" style="text-transform:capitalize;" ng-model="name_cat">
                                            <option ng-repeat="z in cdata">{{z.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Unit Type</label>
                                        <select class="form-control" style="text-transform:lowercase;" ng-model="unit">
                                            <option ng-repeat="u in unit_data">{{u.unit_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charges Name</label>
                                        <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="name"
                                            style=" text-transform: uppercase;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax Category</label>
                                        <select class="form-control" style="text-transform:capitalize;" ng-model="tax" ng-blur="tex();">
                                            <option ng-repeat="p in percent_data">{{p.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax</label>
                                        <input class="form-control" ng-model="tax_per" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Standard Charges</label>
                                        <input type="text" class="form-control" ng-model="standard_charge"
                                        maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" style="text-transform:capitalize;" type="text" id="exampleFormControlTextarea1"
                                            ng-model="descp"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="charge_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->

            <div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                        <div class="modal-header text-center" style="padding-bottom: 20px !important;">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Update Charge Section</b></h5>
                        </div>
                        <div class="container" 
                            ng-init="unit_view();charge_cat_view1();percent_view();">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charge Type</label>
                                        <select class="form-control" ng-model="charge_type" ng-blur="searchtype();" style="text-transform:capitalize;">
                                            <option ng-repeat="z in charge_cat_data1">{{z.charge_type}}</option>
                                        </select>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charge Category</label>
                                        <select class="form-control" ng-model="name_cat" style="text-transform:capitalize;">
                                            <option ng-repeat="z in cdata">{{z.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Unit Type</label>
                                        <select class="form-control" ng-model="unit" style="text-transform:capitalize;">
                                            <option ng-repeat="u in unit_data">{{u.unit_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Charges Name</label>
                                        <input type="text" class="form-control" ng-model="unit_name"
                                        style="text-transform:capitalize;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax Category</label>
                                        <select class="form-control" ng-model="tax" ng-blur="tex();" style="text-transform:capitalize;">
                                            <option ng-repeat="p in percent_data">{{p.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tax</label>
                                        <input class="form-control" ng-model="tax_per" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Standard Charges</label>
                                        <input type="text" class="form-control" ng-model="standard_charge"
                                             maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                            ng-model="descp" style="text-transform:capitalize;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="charge_update()">Update</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- End of 5th Tab -->
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Trigger click event on the button for the "Symtoms Header" tab
            document.querySelector(".tab button:nth-child(5)").click();
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

    </div>
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