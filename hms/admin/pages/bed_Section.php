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
            <button class="tablinks" onclick="openCity(event, 'London')">Department</button>
            <button class="tablinks" onclick="openCity(event, 'Paris')">Floor</button>
            <button class="tablinks" onclick="openCity(event, 'UK')">Ward</button>
            <button class="tablinks" onclick="openCity(event, 'Japan')">Bed Type</button>
            <button class="tablinks" onclick="openCity(event, 'US')">Bed Entry</button>
            <!-- <button class="tablinks" onclick="openCity(event, 'Russia')">Bed Status</button> -->
            <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
        </div>

        <div id="London" class="tabcontent">
            <h3>Department</h3>
            <div style="padding-top: 20px;" ng-init="dept_view()">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add Department</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Department ID</th>
                                <th class="text-center" style=" text-transform: uppercase;">Department Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Department Head</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in dept_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.dept_id}}</td>
                                <td class="text-center">{{x.dept_name}}</td>
                                <td class="text-center">{{x.dept_head}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter" ng-click="dept_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="dept_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Department Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department ID</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" ng-model="dept_id" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department Name</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;" ng-model="dept_name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department Head</label>
                                        <textarea class="form-control" ng-model="dept_head" style="text-transform: capitalize;"></textarea required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" ng-click="dept_entry()"><i class="fa-solid fa-floppy-disk"></i> Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Exit</button> &nbsp;
                                </div>
                            </div>

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
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Menue Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">

                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department ID</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            ng-model="dept_id" required>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department Name</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            ng-model="dept_name" required>
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Department Head</label>
                                    <textarea class="form-control" ng-model="dept_head" style="text-transform: capitalize;"></textarea required>
                                </div>
                            </div>
                            
                                <div class="modal-footer">
                                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                        ng-click="dept_update()">Update</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- End of 1st Tab -->
        </div>

        <div id="Paris" class="tabcontent">
            <h3>Floor</h3>
            <div style="padding-top: 20px;" ng-init="floor_view();">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                                class="fa-solid fa-plus"></i> Add Floor</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Floor Name</th>
                                <th class="text-center" style=" text-transform: uppercase;">Description</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in floor_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.name}}</td>
                                <td class="text-center">{{x.description}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter1" ng-click="floor_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="floor_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg1" tabindex="-1" st="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Floor Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Floor Name<span
                                                style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                    class="fa-solid fa-star-of-life"></i></span></label>
                                        <input type="text" class="form-control" ng-model="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                            ng-model="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="floor_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalTitle">Update Floor Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Floor Name <span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <input type="text" class="form-control" ng-model="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Description</label>
                                        <textarea class="form-control" type="text" id="exampleFormControlTextarea1" ng-model="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="floor_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of 2nd Tab -->


        <div id="UK" class="tabcontent">
            <h3>Ward</h3>
            <div style="padding-top: 20px;" ng-init="ward_view();">
                <!-- <h2 class="text-center"><u>Ward Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg2"><i class="fa-solid fa-plus"></i> Add Ward</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Department ID</th>
                                <th class="text-center" style=" text-transform: uppercase;">Ward Section</th>
                                <th class="text-center" style=" text-transform: uppercase;">Ward No.</th>
                                <th class="text-center" style=" text-transform: uppercase;">Ward Floor</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in ward_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.dept_id}}</td>
                                <td class="text-center">{{x.w_section}}</td>
                                <td class="text-center">{{x.w_no}}</td>
                                <td class="text-center">{{x.w_floor}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter2" ng-click="ward_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="ward_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
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
                        <h2 class="text-center">Ward Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput"> Department<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="dept_id" required>
                                            <option ng-repeat="y in dept_view_data" value="{{y.dept_id}}">{{y.dept_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Floor<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="w_floor" required>
                                            <option></option>
                                            <option ng-repeat="f in floor_view_data">{{f.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward No. <span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <input type="text" class="form-control" ng-model="w_no" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Section<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="w_section" required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Child</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="ward_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Ward Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput"> Department<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="dept_id" required>
                                            <option></option>
                                            <option ng-repeat="y in dept_view_data">{{y.dept_id}}</option>
                                        </select>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Floor<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="w_floor" required>
                                            <option></option>
                                            <option ng-repeat="f in floor_view_data">{{f.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward No. <span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <input type="text" class="form-control" ng-model="w_no" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Section<span style="color:red; font-size: 8px; vertical-align: text-top;"><i class="fa-solid fa-star-of-life"></i></span></label>
                                        <select type="text" class="form-control" ng-model="w_section" required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Child</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="dept_update()">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 3rd Tab -->
        </div>


        <div id="Japan" class="tabcontent">
            <h3>Bed Type</h3>
            <div style="padding-top: 20px;" ng-init="dept_view()">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg3"><i class="fa-solid fa-plus"></i> Add Bed Type</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Bed Type</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in bed_type_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.bed_type}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter3" ng-click="bed_type_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="bed_type_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Bed Type Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed Type</label>
                                        <input type="text" class="form-control" ng-model="bed_type" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="bed_type_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Bed Type Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed Type</label>
                                        <input type="text" class="form-control" ng-model="bed_type" required>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="bed_type_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 4th Tab -->
        </div>


        <div id="US" class="tabcontent">
            <h3>Bed Entry</h3>
            <div style="padding-top: 20px;" ng-init="dept_view()">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container" ng-init="bed_view();">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg4"><i class="fa-solid fa-plus"></i> Add Bed</button>
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Bed No</th>
                                <th class="text-center" style=" text-transform: uppercase;">Bed Type</th>
                                <th class="text-center" style=" text-transform: uppercase;">Ward Section</th>
                                <th class="text-center" style=" text-transform: uppercase;">Ward No</th>
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="x in bed_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.bed_no}}</td>
                                <td class="text-center">{{x.bed_type}}</td>
                                <td class="text-center">{{x.w_section}}</td>
                                <td class="text-center">{{x.w_no}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="Edit" data-toggle="modal" data-target="#exampleModalCenter4" ng-click="bed_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="bed_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" ng-init="ward_view();bed_type_view()">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Bed Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed No</label>
                                        <input type="text" class="form-control" style=" text-transform: uppercase;" ng-model="bed_no">

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed Type</label>
                                        <select class="form-control" ng-model="bed_type">
                                            <option ng-repeat="z in bed_type_data">{{z.bed_type}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward No</label>
                                        <select class="form-control" ng-model="w_no" ng-blur="wardno_search()">
                                            <option ng-repeat="w in ward_view_data">{{w.w_no}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Section</label>
                                        <select class="form-control" ng-model="w_section">
                                            <option ng-repeat="y in wnodata">{{y.w_section}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn" ng-click="bed_entry()">Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="formGroupExampleInput">Bed No</label>
                                        <input type="text" class="form-control" style=" text-transform: uppercase;" ng-model="name">
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed Type</label>
                                        <select class="form-control" ng-model="bed_type">
                                            <option ng-repeat="z in bed_type_data">{{z.bed_type}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward No</label>
                                        <select class="form-control" ng-model="w_no" ng-blur="wardno_search()">
                                            <option ng-repeat="w in ward_view_data">{{w.w_no}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ward Section</label>
                                        <select class="form-control" ng-model="w_section">
                                            <option ng-repeat="y in wnodata">{{y.w_section}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="bed_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End of 5th Tab -->
        </div>


        <div id="Russia" class="tabcontent">
            <h3>Bed Status</h3>
            <div style="padding-top: 20px;" ng-init="dept_view()">
                <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
                <div class="container">
                    <!-- <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg5"><i class="fa-solid fa-plus"></i> Add Department</button>
                    </p> -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-warning text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center" style=" text-transform: uppercase;">Bed No</th>
                                <th class="text-center" style=" text-transform: uppercase;">Bed Status</th>
                                <!-- <th class="text-center" style=" text-transform: uppercase;">Department Head</th> -->
                                <th class="text-center" style=" text-transform: uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in dept_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{x.dept_id}}</td>
                                <td class="text-center">{{x.dept_name}}</td>
                                <td class="text-center">{{x.dept_head}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter5" ng-click="dept_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="dept_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Model Section -->
            <!-- <div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Bed Status Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed No</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" ng-model="dept_id" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Bed Status</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;" ng-model="dept_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" ng-click="dept_entry()"><i class="fa-solid fa-floppy-disk"></i> Submit</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Exit</button> &nbsp;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Update Model Section  -->
            <div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Menue Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">

                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department ID</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                            ng-model="dept_id" required>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Department Name</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            ng-model="dept_name" required>
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Department Head</label>
                                    <textarea class="form-control" ng-model="dept_head" style="text-transform: capitalize;"></textarea required>
                                </div>
                            </div>
                            
                                <div class="modal-footer">
                                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                        ng-click="dept_update()">Update</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- End of 6th Tab -->
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




    </div>
    <!-- Bootstrap JS (optional if you need dropdowns, modals, etc.) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../controller/main.js"></script>
</body>

</html>