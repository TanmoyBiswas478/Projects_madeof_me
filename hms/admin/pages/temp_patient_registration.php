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
                    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_assoc($res)) {
                        if (!empty($row['submenue'])) {
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                            echo $row['menue'] . "</a>";
                            $sql1 = "SELECT * FROM permission WHERE menue='" . $row['menue'] . "' and ph='" . $user . "'";
                            $res1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
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
        <section class="breadcrumbs" style="padding : 20px !important;"
            ng-init="app_view();patient_view();dept_view();symptom_view();tpa_view();doctor_view();patient_old();location_view();nation_view();general_view();">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2" style="font-size:20px;"><b>General Registration Section</b></div>
                        <div class="p-2">
                            <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                ng-show="var" ng-click="patient_entry();">
                                <i class="fas fa-plus"></i>
                                Add Patient
                            </button>
                            <button class="btn text-dark" data-toggle="modal" ng-show="var1" ng-click="patient_view();"
                                style="background-color:#E5E4E2;">
                                <i class="fa-solid fa-users-viewfinder"></i>
                                View Patient
                            </button>
                        </div>
                    </div>
                </div>
                <!-- patient view section -->
                <div class="card-body" ng-show="var1">
                    <form method="post" action="../../assets/api/patient_reg.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-circle-info"></i>
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
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-location-dot"></i>
                                        Location</label>
                                    <select class="form-control" name="location" required>
                                        <option></option>
                                        <option ng-repeat="l in location_view_data">{{l.location_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-users"></i> Patient
                                        Type</label>
                                    <select class="form-control" name="patient_type" ng-model="patient_type" required>
                                        <option value=""></option>
                                        <option value="new">New Patient</option>
                                        <option value="old">Old Patient</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3" ng-show="patient_type === 'new'">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-mobile"></i> Mobile No</label>
                                    <input type="text" class="form-control" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="mobile" Required>
                                </div>
                            </div>
                            <div class="col-md-3" ng-show="patient_type === 'old'">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-id-badge"></i> Patient
                                        ID</label>
                                    <input type="text" class="form-control" name="patient_id" ng-model="patient_id"
                                        ng-blur="old_view();" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Referral
                                        Doctor Name</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Dr.</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup"
                                            style="text-transform: capitalize;" name="referral_doctor"
                                            ng-model="referral_doctor" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Patient Details section -->
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i> Patient
                                    Details</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:8px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user"></i> Patient
                                        Name</label>
                                    <input type="text" class="form-control" ng-model="patient_name"
                                        style="text-transform: uppercase;" name="patient_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-person-breastfeeding"></i>
                                        Father
                                        Name</label>
                                    <input type="text" class="form-control" ng-model="father_name"
                                        style="text-transform: capitalize;" name="father_name" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-venus-mars"></i>
                                        Gender</label>
                                    <select type="text" class="form-control" name="gender" ng-model="gender" required>
                                        <option></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-calendar-days"></i>
                                        Age</label>
                                    <input type="text" class="form-control" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="age" ng-model="age" required>
                                </div>
                            </div>
                        </div>
                        <!-- Patient Address Section -->
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-droplet"></i> Blood
                                        Group</label>
                                    <select type="text" class="form-control" style="text-transform: uppercase;"
                                        name="blood_group" ng-model="blood_group" required>
                                        <option></option>
                                        <option>a+</option>
                                        <option>a-</option>
                                        <option>b+</option>
                                        <option>b-</option>
                                        <option>o+</option>
                                        <option>o-</option>
                                        <option>ab+</option>
                                        <option>ab-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-address-card"></i>
                                        Address</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        name="address" ng-model="address" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-tree-city"></i> City</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        name="city" ng-model="city" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-map"></i> State</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        name="state" ng-model="state" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-map-pin"></i> Pin Code</label>
                                    <input type="text" class="form-control" maxlength="6"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="pin" ng-model="pin" required>
                                </div>
                            </div>
                        </div>
                        <!-- Other Section -->
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-database"></i> Other
                                    Details</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:8px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-envelope"></i> Email</label>
                                    <input type="text" class="form-control" style="text-transform: lowercase;"
                                        name="email" ng-model="email" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-brands fa-square-whatsapp"></i>
                                        WhatsApp
                                        No</label>
                                    <input type="text" class="form-control" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="whatsapp" ng-model="whatsapp" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                        Type</label>
                                    <select type="text" class="form-control" ng-model="n_id_type" name="n_id_type"
                                        required>
                                        <option></option>
                                        <option ng-repeat="n in nation_view_data">{{n.n_id_type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                        No</label>
                                    <input type="text" class="form-control" ng-model="nid" name="nid" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-infinity"></i> Marital
                                        Status</label>
                                    <select class="form-control" ng-model="marital" name="marital" required>
                                        <option></option>
                                        <option>Married</option>
                                        <option>Unmarried</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <!-- <div class="row">
                        <div class="col-lg-4">
                            <video id="videoElement" style="width: 200px; height: 200px;" autoplay></video>
                        </div>
                    </div> -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success" id="myBtn">Submit</button> &nbsp;
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    ng-click="patient_view();">Exit</button> &nbsp;
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- end of patient view section -->
            <!-- ***Update section*** -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12" style="font-size:20px;"><b><i
                                            class="fa-solid fa-circle-info"></i>
                                        Basic
                                        Details</b><br>
                                    <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                        <hr>
                                    </Div>
                                </div>
                            </div>
                            <div class="row" style="padding-top:8px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-location-dot"></i>
                                            Location</label>
                                        <select class="form-control" name="location" ng-model="location" required>
                                            <option></option>
                                            <option ng-repeat="l in location_view_data">{{l.location_name}}</option>
                                        </select>
                                        <input type="hidden" class="form-control" ng-model="idd">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-mobile"></i> Mobile
                                            No</label>
                                        <input type="text" class="form-control" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            name="mobile" ng-model="mobile" Required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-id-badge"></i> Patient
                                            ID</label>
                                        <input type="text" class="form-control" name="patient_id" ng-model="patient_id"
                                            ng-blur="old_view();" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Referral
                                            Doctor Name</label>
                                            <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Dr.</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup"
                                            style="text-transform: capitalize;" name="referral_doctor"
                                            ng-model="referral_doctor" required>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Patient Details section -->
                            <div class="row">
                                <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-book"></i>
                                        Patient
                                        Details</b><br>
                                    <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                        <hr>
                                    </Div>
                                </div>
                            </div>
                            <div class="row" style="padding-top:8px;">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-user"></i> Patient
                                            Name</label>
                                        <input type="text" class="form-control" ng-model="patient_name"
                                            style="text-transform: uppercase;" name="patient_name" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-person-breastfeeding"></i>
                                            Father
                                            Name</label>
                                        <input type="text" class="form-control" ng-model="father_name"
                                            style="text-transform: capitalize;" name="father_name" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-venus-mars"></i>
                                            Gender</label>
                                        <select type="text" class="form-control" name="gender" ng-model="gender"
                                            required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-calendar-days"></i>
                                            Age</label>
                                        <input type="text" class="form-control" maxlength="3"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            name="age" ng-model="age" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-droplet"></i> Blood
                                            Group</label>
                                        <select type="text" class="form-control" style="text-transform: uppercase;"
                                            name="blood_group" ng-model="blood_group" required>
                                            <option></option>
                                            <option>a+</option>
                                            <option>a-</option>
                                            <option>b+</option>
                                            <option>b-</option>
                                            <option>o+</option>
                                            <option>o-</option>
                                            <option>ab+</option>
                                            <option>ab-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-address-card"></i>
                                            Address</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            name="address" ng-model="address" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Patient Address Section -->
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-tree-city"></i>
                                            City</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            name="city" ng-model="city" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-map"></i> State</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize;"
                                            name="state" ng-model="state" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-map-pin"></i> Pin
                                            Code</label>
                                        <input type="text" class="form-control" maxlength="6"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            name="pin" ng-model="pin" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Other Section -->
                            <div class="row">
                                <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-database"></i>
                                        Other
                                        Details</b><br>
                                    <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                        <hr>
                                    </Div>
                                </div>
                            </div>
                            <div class="row" style="padding-top:8px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-envelope"></i>
                                            Email</label>
                                        <input type="text" class="form-control" style="text-transform: lowercase;"
                                            name="email" ng-model="email" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-brands fa-square-whatsapp"></i>
                                            WhatsApp
                                            No</label>
                                        <input type="text" class="form-control" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            name="whatsapp" ng-model="whatsapp" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                            Type</label>
                                        <select type="text" class="form-control" ng-model="n_id_type" name="n_id_type"
                                            required>
                                            <option></option>
                                            <option ng-repeat="n in nation_view_data">{{n.n_id_type}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                            No</label>
                                        <input type="text" class="form-control" ng-model="nid" name="nid" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><i class="fa-solid fa-infinity"></i> Marital
                                            Status</label>
                                        <select class="form-control" ng-model="marital" name="marital" required>
                                            <option></option>
                                            <option>Married</option>
                                            <option>Unmarried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                        <div class="col-lg-4">
                            <video id="videoElement" style="width: 200px; height: 200px;" autoplay></video>
                        </div>
                    </div> -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="myBtn"
                                        ng-click="general_update()">Update</button> &nbsp;
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- patient entry section -->
            <div class="card-body" ng-show="var">
                <table class="table table-bordered text-center">
                    <thead class="table-info">
                        <tr>
                            <th width="8%">#</th>
                            <th width="10%">Patient ID</th>
                            <th width="14%">Patient Name</th>
                            <th width="14%">Father Name</th>
                            <th width="5%">Age</th>
                            <th width="10%">Gender</th>
                            <th width="10%">Phone No</th>
                            <th width="9%">Blood Group</th>
                            <th width="15%">Referral Doctor</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="a in app_view_data">
                            <th>{{$index+1}}</th>
                            <td>{{a.patient_id}}</td>
                            <td style="text-transform: uppercase;">{{a.patient_name}}</td>
                            <td style="text-transform: capitalize;">{{a.father_name}}</td>
                            <td>{{a.age}}</td>
                            <td style="text-transform: capitalize;">{{a.gender}}</td>
                            <td>{{a.mobile}}</td>
                            <td style="text-transform: uppercase;">{{a.blood_group}}</td>
                            <td style="text-transform: capitalize;">{{a.referral_doctor}}</td>
                            <td class="text-center"><button class="btn-warning" title="edit" data-toggle="modal"
                                    data-target=".bd-example-modal-lg" ng-click="general_edit(a.id)"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end of patient entry section -->
    </div>
    </section><!-- End Breadcrumbs Section -->

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
</body>

</html>