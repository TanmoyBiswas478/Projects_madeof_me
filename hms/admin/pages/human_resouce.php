<?php
include '../../assets/api/connect.php';
session_start();
if (empty($_SESSION['user'])) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Home <span class="sr-only">(current)</span></a>
                    </li>

                    <?php

                    $sql =
                        "SELECT * FROM navigation group by menue order by id";
                    $res = mysqli_query($con, $sql) or
                        die(mysqli_error($con));
                    while ($row = mysqli_fetch_assoc($res)) {
                        if (!empty($row['submenu'])) {
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' href='#'
                                id='navbarDropdown' st='button'
                                data-toggle='dropdown' aria-haspopup='true'
                                aria-expanded='false'>";
                            echo $row['menue'] . "</a>";
                            $sql1 = "SELECT * FROM navigation WHERE menue='" .
                                $row['menue'] . "'";
                            $res1 = mysqli_query($con, $sql1) or
                                die(mysqli_error($con));
                            if (mysqli_num_rows($res1) > 0) {
                                echo "<div class='dropdown-menu'
                                aria-labelledby='navbarDropdown'>";
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                    echo "<a class='dropdown-item'
                                    href=" . $row1['url'] . ">" . $row1['submenu'] . "</a>";
                                    echo "<div class='dropdown-divider'></div>";
                                }
                                echo "</div>";
                            }
                            echo "</li>";
                        } else {
                            echo "<li class='nav-item'>";
                            echo "<a class='nav-link'
                                href=" . $row['url'] . ">" . $row['menue'] . "</a>";
                            echo "</li>";
                        }
                    }
                    if ($user == 'Super Admin') {
                        echo '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                                id="navbarDropdown" st="button"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Settings
                            </a>
                            <div class="dropdown-menu"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="menu.php">Menue
                                    Section</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="permission.php">User Peremission</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="create_user.php">Create Users</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="active_user.php">Active Users</a>
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

        <h2>Human Resource Section</h2>

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Location')">Location</button>
            <button class="tablinks" onclick="openCity(event, 'Doctor')">National IDs</button>
            <button class="tablinks" onclick="openCity(event, 'Staff')">Doctor Section</button>
            <button class="tablinks" onclick="openCity(event, 'qualification')">Qualification Section</button>
            <button class="tablinks" onclick="openCity(event, 'Specialist')">Specialist</button>
            <button class="tablinks" onclick="openCity(event, 'Designation')">Designation</button>
            <!-- <button class="tablinks" onclick="openCity(event, 'Department')">Department</button> -->

        </div>

        <div id="Location" class="tabcontent">
            <h3>Location Create Section</h3>
            <div class="container" ng-init="location_view();">
                <p class="text-right">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg7"><i class="fa-solid fa-plus"></i> Add location</button>
                </p>
                <table class="table table-bordered ">
                    <thead>
                        <tr class="table-info text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">Location Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in location_view_data">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center" style="text-transform:capitalize;">{{x.location_name}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter" ng-click="location_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="location_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Client Model Section -->
                <div class="modal fade bd-example-modal-lg7" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <h2 class="text-center">Location Entry Section</h2>
                            <div class="container" style="padding-bottom: 20px !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Location Name</label>
                                            <input type="text" class="form-control" style="text-transform:capitalize;" ng-model="location_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-success" id="myBtn" ng-click="location_entry()">Submit</button> &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update model section -->
                <div class="modal fade bd-example-modal-lg7" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Location Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">location Name</label>
                                            <input type="text" style="text-transform:capitalize;" class="form-control" ng-model="location_name" required>
                                            <input type="hidden" class="form-control" ng-model="idd">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="location_update()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="Specialist" class="tabcontent">
            <h3>Specialist</h3>
            <div style="padding-top: 20px;" ng-init="specialist_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add
                            Specialist</button>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in specialist_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.specialist}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter" ng-click="specialist_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="specialist_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Specialist Entry
                            Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Specialist
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="specialist" id="textInput" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="specialist_entry()">Submit</button>
                                    &nbsp;
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
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Specialist
                                Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Specialist
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="specialist" id="textInput" required>

                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="specialist_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Specialist section  -->
        </div>

        <div id="Designation" class="tabcontent">
            <h3>Designation Section</h3>
            <div style="padding-top: 20px;" ng-init="designation_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i class="fa-solid fa-plus"></i> Add
                            Designation</button>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style="text-transform: capitalize;">Designation
                                    Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="d in designation_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{d.designation}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter1" ng-click="designation_edit(d.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="designation_delete(d.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Designation Entry
                            Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Designation
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="designation" id="textInput" required>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="designation_entry()">Submit</button>
                                    &nbsp;
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
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update
                                Designation Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Designation
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="designation" id="textInput" required>

                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="designation_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Designation Section  -->
        </div>

        <div id="Department" class="tabcontent">
            <h3>Department Section</h3>
            <div style="padding-top: 20px;" ng-init="dept_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg2"><i class="fa-solid fa-plus"></i> Add
                            Department</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Department ID</th>
                                <th class="text-center">Department Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in dept_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: uppercase;">{{x.dept_id}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.dept_name}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter2" ng-click="dept_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="dept_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Department Entry
                            Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department
                                            ID</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" ng-model="dept_id" style="text-transform: uppercase;" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;" ng-model="dept_name" style="text-transform: capitalize;" id="textInput" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="dept_entry()">Submit</button>
                                    &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Department
                                Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department
                                            ID</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" ng-model="dept_id" style="text-transform: uppercase;" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department
                                            Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="dept_name" id="textInput" required>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="dept_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Department Section -->
        </div>

        <div id="Doctor" class="tabcontent">
            <h3>National IDs Section</h3>
            <div class="container" ng-init="nation_view();">
                <p class="text-right">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg3"><i class="fa-solid fa-plus"></i> Add National
                        ID</button>
                </p>
                <table class="table table-bordered ">
                    <thead>
                        <tr class="table-info text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">National ID Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in nation_view_data">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center" style="text-transform: capitalize;">{{x.n_id_type}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter3" ng-click="n_id_type_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="n_id_type_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Client Model Section -->
                <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <h2 class="text-center">National ID Entry Section</h2>
                            <div class="container" style="padding-bottom: 20px !important;">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">National
                                                ID Type</label>
                                            <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="n_id_type" id="textInput" required>
                                            <p id="errorMessage" style="color: red; display: none;">Please
                                                enter text only.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-success" id="myBtn" ng-click="n_id_type_entry()">Submit</button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                        &nbsp;
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Update model section -->
                <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">National ID Type
                                    Update Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">National
                                                ID Type</label>
                                            <input type="text" class="form-control" style="text-transform: capitalize;" ng-model="n_id_type" id="textInput" required>
                                            <input type="hidden" class="form-control" ng-model="idd">
                                            <p id="errorMessage" style="color: red; display: none;">Please
                                                enter text only.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="n_id_type_update()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="Staff" class="tabcontent">
            <h3>Doctor Section</h3>
            <div style="padding-top: 20px;" ng-init="doctor_view()">
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg4"><i class="fa-solid fa-plus"></i> Add Doctor</button>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Registration No</th>
                                <th class="text-center">Doctor Name</th>
                                <th class="text-center">Mobile No</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Qualification</th>
                                <th class="text-center">Specialization</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in doctor_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: uppercase;">{{x.regis_no}}</td>
                                <td class="text-center" style="text-transform: uppercase;">{{x.name}}</td>
                                <td class="text-center">{{x.mobile}}</td>
                                <td class="text-center" style="text-transform: lowercase;">{{x.email}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.qulification}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.specialization}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target=".bd-example-modal-lg11" ng-click="doctor_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="doctor_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Doctor Entry Section -->
                    <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <h2 class="text-center">Doctor Entry Section</h2>
                                <div class="container" style="padding-bottom: 20px !important;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Registration No</label>
                                                <input type="text" class="form-control" id="formGroupExampleInput" ng-model="regis_no" style="text-transform: uppercase;" required>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Doctor Name</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Dr.</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="textInput" style="text-transform: uppercase;" ng-model="name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Address</label>
                                                <textarea class="form-control" ng-model="doctoraddress" style="text-transform: capitalize;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Phone No</label>
                                                <input type="text" class="form-control" ng-model="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="ph" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Email</label>
                                                <input type="email" class="form-control" id="formGroupExampleInput" style="text-transform: lowercase;" ng-model="email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Specialization</label>
                                                <select type="text" class="form-control" style="text-transform: capitalize;" id="textInput" ng-model="specialization" required>
                                                    <option ng-repeat="s in specialist_data">{{s.specialist}}</option>
                                                </select>
                                                <p id="errorMessage" style="color: red; display: none;">Please enter text only.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Degree</label>
                                                <select type="text" class="form-control" style="text-transform: capitalize;" ng-model="qulification" id="textInput" required>
                                                    <option></option>
                                                    <option ng-repeat="q in qualification_view_data">{{q.qulif}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="button" class="btn btn-success" ng-click="doctor_entry()">Submit</button> &nbsp;
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Update Section -->
                    <div class="modal fade bd-example-modal-lg11" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-content">
                                    <h2 class="text-center">Doctor Entry Section</h2>
                                    <div class="container" style="padding-bottom: 20px !important;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Registration No</label>
                                                    <input type="text" class="form-control" id="formGroupExampleInput" ng-model="regis_no" style="text-transform: uppercase;" required>
                                                    <input type="hidden" class="form-control" ng-model="idd">
                                                </div>
                                            </div>
                                            <!-- -->
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Doctor Name</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Dr.</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="textInput" style="text-transform: uppercase;" ng-model="name" required>
                                                        <p id="errorMessage" style="color: red; display: none;">Please enter text only.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Address</label>
                                                    <textarea class="form-control" ng-model="doctoraddress" style="text-transform: capitalize;" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Phone No</label>
                                                    <input type="text" class="form-control" ng-model="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="ph" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Email</label>
                                                    <input type="email" class="form-control" id="formGroupExampleInput" style="text-transform: lowercase;" ng-model="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Specialization</label>
                                                    <select type="text" class="form-control" style="text-transform: capitalize;" id="textInput" ng-model="specialization" required>
                                                        <option ng-repeat="s in specialist_data">{{s.specialist}}</option>
                                                    </select>
                                                    <p id="errorMessage" style="color: red; display: none;">Please enter text only.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Degree</label>
                                                    <select type="text" class="form-control" style="text-transform: capitalize;" ng-model="qulification" id="textInput" required>
                                                        <option></option>
                                                        <option ng-repeat="q in qualification_view_data">{{q.qulif}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-success" ng-click="doctor_update()">Submit</button> &nbsp;
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="qualification" class="tabcontent">
            <h3>Qualification Section</h3>
            <div style="padding-top: 20px;" ng-init="qualification_view();">
            </div>
            <div class="container">
                <p class="text-right">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg12"><i class="fa-solid fa-plus"></i> Add Qualification</button>
                </p>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-info text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center" style="text-transform: uppercase;">Qualification</th>
                            <th class="text-center" style="text-transform: uppercase;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in qualification_view_data">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{x.qulif}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="edit" data-toggle="modal" data-target=".bd-example-modal-lg13" ng-click="qualification_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="qualification_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="modal fade bd-example-modal-lg12" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <h2 class="text-center">Qualification Entry Section</h2>
                            <div class="container" style="padding-bottom: 20px !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Qualification Name</label>
                                            <input type="text" class="form-control" ng-model="qulif" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-success" id="myBtn" ng-click="qualification_entry()">Submit</button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Section -->

                <div class="modal fade bd-example-modal-lg13" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Qualification Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Qualification Name</label>
                                            <input type="text" class="form-control" ng-model="qulif" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="qualification_update()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




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
        <script>
            function validateTextInput(event) {
                const input = event.target.value;
                const pattern = /^[A-Za-z\s]+$/; // Regular expression to match only text and spaces
                const errorMessage = document.getElementById("errorMessage");

                if (!pattern.test(input)) {
                    errorMessage.style.display = "block";
                    event.target.value = ""; // Clear the input field if it contains any invalid characters
                } else {
                    errorMessage.style.display = "none";
                }
            }
        </script>
        <!-- Bootstrap JS (optional if you need dropdowns, modals, etc.) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="../controller/main.js"></script>
</body>

</html>