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
        <h2>Referral Section</h2>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Referral_Payment')">Referral Payment</button>
            <button class="tablinks" onclick="openTab(event, 'Referral_Person')">Referral Person</button>
        </div>
        <div id="Referral_Payment" class="tabcontent">
            <h3>Referral Payment</h3>
            <div style="padding-top: 20px;" ng-init="referral_view()">
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                class="fa-solid fa-plus"></i> Add Referral Section</button>
                    </p>
                    <div class="container" ng-init="referral_view();">
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
                                    <th class="text-center">Referrer Name</th>
                                    <th class="text-center">Patient Name</th>
                                    <th class="text-center">Bill No</th>
                                    <th class="text-center">Bill Amount</th>
                                    <th class="text-center">Commission Percentage (%)</th>
                                    <th class="text-center">Commission Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="x in referral_view_data">
                                    <td class="text-center">{{$index+1}}</td>
                                    <td class="text-center">{{$ref_name}}</td>
                                    <td class="text-center">{{$name}}</td>
                                    <td class="text-center">{{$bill_no}}</td>
                                    <td class="text-center">{{$bill_amount}}</td>
                                    <td class="text-center">{{$com_percentage}}</td>
                                    <td class="text-center">{{$com_amount}}</td>
                                    <td class="text-center">
                                        <button class="btn-success" title="edit" data-toggle="modal"
                                            data-target="#exampleModalCenter3" ng-click="referral_edit(x.id)"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn-danger" title="Delete" ng-click="referral_delete(x.id)"><i
                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h2 class="text-center">Referral Payment Entry Section</h2>
                        <div class="container">
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="">
                                            <div class="card-header">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Search</label>
                                                    <input type="text" class="form-control"
                                                        style="text-transform: capitalize;" name="patient_list"
                                                        id="patient_list" ng-model="patient_list" list="patientlist"
                                                        required>
                                                    <datalist id="patientlist">
                                                        <option>Tanmoy Biswas</option>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Patient Type</label>
                                                            <input type="text" class="form-control"
                                                                style="text-transform: capitalize;" name="p_type"
                                                                ng-model="p_type" list="ptype" required>
                                                            <datalist id="ptype">
                                                                <option>OPD</option>
                                                                <option>IPD</option>
                                                                <option>Pharmacy</option>
                                                                <option>Pathology</option>
                                                                <option>Radioogy</option>
                                                                <option>Blood Bank</option>
                                                                <option>Ambulance</option>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Bill No/Case ID</label>
                                                            <select type="text" class="form-control" ng-model="bill_no"
                                                                required>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Patient Bill
                                                                Amount</label>
                                                            <input type="text" class="form-control"
                                                                ng-model="bill_amount" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Payee</label>
                                                            <select type="text" class="form-control" ng-model="ref_name"
                                                                required>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Commission Percentage
                                                                (%)</label>
                                                            <input type="text" class="form-control"
                                                                ng-model="com_percentage" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Commission Amount</label>
                                                            <input type="text" class="form-control"
                                                                ng-model="com_amount" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="referral_entry()">Save</button>
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Referral Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Search</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            name="patient_list" id="patient_list" ng-model="patient_list"
                                            list="patientlist" required>
                                        <datalist id="patientlist">
                                            <option>Tanmoy Biswas</option>
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Patient Type</label>
                                                <input type="text" class="form-control"
                                                    style="text-transform: capitalize;" name="p_type" ng-model="p_type"
                                                    list="ptype" required>
                                                <datalist id="ptype">
                                                    <option>OPD</option>
                                                    <option>IPD</option>
                                                    <option>Pharmacy</option>
                                                    <option>Pathology</option>
                                                    <option>Radioogy</option>
                                                    <option>Blood Bank</option>
                                                    <option>Ambulance</option>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Bill No/Case ID</label>
                                                <select type="text" class="form-control" ng-model="bill_no" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Patient Bill Amount</label>
                                                <input type="text" class="form-control" ng-model="bill_amount" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Payee</label>
                                                <select type="text" class="form-control" ng-model="ref_name" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Commission Percentage (%)</label>
                                                <input type="text" class="form-control" ng-model="com_percentage"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Commission Amount</label>
                                                <input type="text" class="form-control" ng-model="com_amount" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="referral_update()">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="Referral_Person" class="tabcontent">
            <h3>Referral Person</h3>
            <div style="padding-top: 20px;" ng-init="ref_person_view()">
                <div class="container">
                    <p class="text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                                class="fa-solid fa-plus"></i> Add Referral Person</button>
                    </p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-info text-dark">
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center" width="8%"> Referrer Name</th>
                                <th class="text-center" width="15%"> Category</th>
                                <th class="text-center" width="10%"> Commision</th>
                                <th class="text-center" width="10%"> Referrer Contact</th>
                                <th class="text-center" width="14%"> Contact Person Name</th>
                                <th class="text-center" width="12%"> Contact Person Phone</th>
                                <th class="text-center" width="15%"> Address</th>
                                <th class="text-center" width="19%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in ref_person_view_data">
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.ref_name}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.category}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.com}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.ref_ph}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.con_person_name}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.con_person_ph}}</td>
                                <td class="text-center" style="text-transform: capitalize;">{{x.address}}</td>
                                <td class="text-center">
                                    <button class="btn-success" title="edit" data-toggle="modal"
                                        data-target="#exampleModalCenter1" ng-click="ref_person_edit(x.id)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-danger" title="Delete" ng-click="ref_person_delete(x.id)"><i
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
                        <h2 class="text-center">Referral Person Entry Section</h2>
                        <div class="container" style="padding-bottom: 5px !important;">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="name">Referrer Name</label>
                                            <span class="req"> *</span>
                                            <input name="name" placeholder="" type="text" class="form-control"
                                                ng-model="ref_name">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="referrer_contact">Referrer Contact</label>
                                            <input name="referrer_contact" placeholder="" type="text"
                                                class="form-control" ng-model="ref_ph">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="person_name">Contact Person Name</label>
                                            <input name="person_name" placeholder="" type="text" class="form-control"
                                                ng-model="con_person_name">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="person_phone">Contact Person Phone</label>
                                            <input name="person_phone" placeholder="" type="text" class="form-control"
                                                autocomplete="off" ng-model="con_person_ph">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="category">Category</label>
                                            <span class="req"> *</span>
                                            <select name="category" class="form-control" ng-model="category">
                                                <option>Select Category</option>
                                                <option>District Hospital (DH)</option>
                                                <option>OPD Department</option>
                                                <option>IPD Department</option>
                                                <option>Clinical Services within the Community</option>
                                                <option>Valuing the Benefit of Clinical Services</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Standard Commission (%)</label>
                                                <input type="text" class="form-control" name="com" ng-model="com"
                                                    id="commission" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" placeholder="" type="text" class="form-control"
                                                ng-model="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Commission for Modules (%)</label>
                                    <span class="req"> *</span>
                                    <button type="button" class="plusign" onclick="apply_to_all()"
                                        autocomplete="off">Apply To All</button>
                                    <div class="">
                                        <div class="form-group">
                                            <div class="row">
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="1"
                                                        ng-model="opd" name="opd">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">OPD</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_1"
                                                            ng-model="opd" name="opd"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="2"
                                                        ng-model="ipd">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">IPD</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_2"
                                                            autocomplete="off" ng-model="ipd"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="3"
                                                        ng-model="pharmacy">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Pharmacy</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_3"
                                                            autocomplete="off" ng-model="pharmacy"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="4"
                                                        ng-model="pathology">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Pathology</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_4"
                                                            autocomplete="off" ng-model="pathology"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="5"
                                                        ng-model="radiology">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Radiology</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_5"
                                                            autocomplete="off" ng-model="radiology"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="6"
                                                        ng-model="blood_bank">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Blood Bank</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_6"
                                                            autocomplete="off" ng-model="blood_bank"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="7"
                                                        ng-model="ambulance">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Ambulance</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_7"
                                                            autocomplete="off" ng-model="ambulance"></div>
                                                </div>
                                            </div>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-success" id="myBtn"
                                            ng-click="ref_person_entry()">Save</button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                        &nbsp;
                                    </div>
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Referred Person</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="name">Referrer Name</label>
                                            <span class="req"> *</span>
                                            <input name="name" placeholder="" type="text" class="form-control"
                                                ng-model="ref_name">
                                            <input type="hidden" class="form-control" ng-model="idd">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="referrer_contact">Referrer Contact</label>
                                            <input name="referrer_contact" placeholder="" type="text"
                                                class="form-control" ng-model="ref_ph">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="person_name">Contact Person Name</label>
                                            <input name="person_name" placeholder="" type="text" class="form-control"
                                                ng-model="con_person_name">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="person_phone">Contact Person Phone</label>
                                            <input name="person_phone" placeholder="" type="text" class="form-control"
                                                autocomplete="off" ng-model="con_person_ph">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="category">Category</label>
                                            <span class="req"> *</span>
                                            <select name="category" class="form-control" ng-model="category">
                                                <option>Select Category</option>
                                                <option>District Hospital (DH)</option>
                                                <option>OPD Department</option>
                                                <option>IPD Department</option>
                                                <option>Clinical Services within the Community</option>
                                                <option>Valuing the Benefit of Clinical Services</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Standard Commission (%)</label>
                                                <input type="text" class="form-control" name="com" ng-model="com"
                                                    id="commission" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" placeholder="" type="text" class="form-control"
                                                ng-model="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Commission for Modules (%)</label>
                                    <span class="req"> *</span>
                                    <button type="button" class="plusign" onclick="apply_to_all()"
                                        autocomplete="off">Apply To All</button>
                                    <div class="">
                                        <div class="form-group">
                                            <div class="row">
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="1"
                                                        ng-model="opd">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">OPD</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_1"
                                                            ng-model="opd"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="2"
                                                        ng-model="ipd">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">IPD</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_2"
                                                            autocomplete="off" ng-model="ipd"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="3"
                                                        ng-model="pharmacy">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Pharmacy</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_3"
                                                            autocomplete="off" ng-model="pharmacy"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="4"
                                                        ng-model="pathology">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Pathology</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_4"
                                                            autocomplete="off" ng-model="pathology"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="5"
                                                        ng-model="radiology">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Radiology</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_5"
                                                            autocomplete="off" ng-model="radiology"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="6"
                                                        ng-model="blood_bank">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Blood Bank</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_6"
                                                            autocomplete="off" ng-model="blood_bank"></div>
                                                </div>
                                                <div id="module_commission">
                                                    <input type="hidden" name="referral_type_id[]" value="7"
                                                        ng-model="ambulance">
                                                    <div class="col-sm-7 col-xs-7">
                                                        <label class="apply-label">Ambulance</label>
                                                    </div>
                                                    <div class="col-sm-5 col-xs-5"><input class="commissionInput"
                                                            type="text" name="module_commission[]" id="type_id_7"
                                                            autocomplete="off" ng-model="ambulance"></div>
                                                </div>
                                            </div>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                ng-click="ref_person_update()">Update</button>
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
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
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

        function apply_to_all() {
            commission = $("#commission").val();
            $(".commissionInput").val(commission);
        }

        function apply_to_all_edit() {
            commission = $("#commissionEdit").val();
            $(".commissionInputEdit").val(commission);
        }
    </script>
</body>

</html>