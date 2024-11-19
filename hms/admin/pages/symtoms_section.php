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
        <h2>Symptom Section</h2>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Symptom_Type')">Symptom Type</button>
            <button class="tablinks" onclick="openTab(event, 'Symptom_Head')">Symptom Head</button>
        </div>

        <div id="Symptom_Type" class="tabcontent">
            <h3>Symptom Type</h3>
            <div style="padding-top: 20px;" ng-init="symptom_view()">
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                class="fa-solid fa-plus"></i> Add Symptom Type</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center"> Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in symptom_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.symptoms_type}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter" ng-click="symptom_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="symptom_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Symptom Type Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Type</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_type" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="symptom_entry()">Submit</button>
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
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Symptom Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Type</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_type" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="symptom_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="Symptom_Head" class="tabcontent">
            <h3>Symptom Head</h3>
            <div style="padding-top: 20px;" ng-init="symptom_head_view()">
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                                class="fa-solid fa-plus"></i> Add Symptom Head</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center">#</th>
                                <th class="text-center"> Symptom Head</th>
                                <th class="text-center"> Symptom Type</th>
                                <th class="text-center"> Symptom Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in symptom_head_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.symptoms_head}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.symptoms_type}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.symptoms_description}}
                                </td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter1" ng-click="symptom_head_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="symptom_head_delete(x.id)"><i
                                            class="fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Symptom Head Entry Section</h2>
                        <div class="container" style="padding-bottom: 20px !important;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Type</label>
                                        <select type="text" class="form-control" ng-model="symptoms_type"
                                            style="text-transform: capitalize;" required>
                                            <option ng-repeat="x in symptom_view_data">{{x.symptoms_type}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Head</label>
                                        <input type="text" class="form-control" ng-model="symptoms_head"
                                            style="text-transform: capitalize;" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Description</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_description" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="symptom_head_entry()">Submit</button>
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
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Symptom Head</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom type</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_type" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Head</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_head" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Symptom Description</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            ng-model="symptoms_description" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="symptom_head_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="../controller/main.js"></script>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>