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
            ng-init="app_admit_view();symptom_head_view();bed_type_view();bed_view();ward_view();patient_view();dept_view();symptom_view();tpa_view();doctor_view();patient_old();general_view();payment_view();nation_view();lab_dept_view();">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2" style="font-size:20px;"><b>Patient Registration Section</b></div>
                        <div class="p-2">
                            <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                ng-show="var" ng-click="patient_entry();">
                                <i class="fas fa-plus"></i>
                                Patient List
                            </button>
                            <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                ng-show="var1" ng-click="patient_view();">
                                <i class="fas fa-plus"></i>
                                Patient Registration
                            </button>
                        </div>
                    </div>
                </div>
                <!-- patient view section -->
                <div class="card-body" ng-show="var">
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;">
                            <b><i class="fa-solid fa-circle-info"></i>
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
                                <label for="exampleInputEmail1"><i class="fa-solid fa-id-badge"></i> Patient
                                    ID</label>
                                <input type="text" class="form-control" ng-model="patient_id"
                                    ng-blur="old_patient_view();">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Registration
                                    Type</label>
                                    <div class="input-group-text">Out Patient Diagnostic</div>
                            </div>
                        </div>
                    </div>
                    <!-- Patient Details section -->
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;">
                            <b><i class="fa-solid fa-book"></i> Patient
                                Details</b><br>
                            <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </Div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:8px;">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-user"></i> Patient
                                    Name</label>
                                <input type="text" class="form-control" style="text-transform: uppercase;"
                                    ng-model="patient_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-person-breastfeeding"></i>
                                    Father
                                    Name</label>
                                <input type="text" class="form-control" style="text-transform: capitalize;"
                                    ng-model="father_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-mobile"></i> Mobile No</label>
                                <input type="text" class="form-control" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    ng-model="mobile" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-venus-mars"></i>
                                    Gender</label>
                                <input type="text" class="form-control" ng-model="gender" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-calendar-days"></i>
                                    Age</label>
                                <input type="text" class="form-control" maxlength="3"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    ng-model="age" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Patient Address Section -->
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-droplet"></i> Blood
                                    Group</label>
                                <input type="text" class="form-control" style="text-transform: uppercase;"
                                    name="blood_group" ng-model="blood_group" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-address-card"></i>
                                    Address</label>
                                <input type="text" class="form-control" style="text-transform: capitalize;"
                                    ng-model="address" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-tree-city"></i> City</label>
                                <input type="text" class="form-control" style="text-transform: capitalize;"
                                    ng-model="city" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-map"></i> State</label>
                                <input type="text" class="form-control" style="text-transform: capitalize;"
                                    ng-model="state" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-map-pin"></i> Pin Code</label>
                                <input type="text" class="form-control" maxlength="6"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    ng-model="pin" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Other Section -->
                    <div ng-show="regis_type == 'Lab Test'">
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
                                        name="email" ng-model="email" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-brands fa-square-whatsapp"></i>
                                        WhatsApp
                                        No</label>
                                    <input type="text" class="form-control" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="whatsapp" ng-model="whatsapp" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                        Type</label>
                                    <input type="text" class="form-control" ng-model="n_id_type" name="n_id_type"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-id-card-clip"></i> ID
                                        No</label>
                                    <input type="text" class="form-control" ng-model="nid" name="nid" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-infinity"></i> Marital
                                        Status</label>
                                    <input class="form-control" ng-model="marital" name="marital" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div ng-show="regis_type == 'Lab Test'">
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;">
                                <b><i class="fa-solid fa-database"></i> Lab Test</b><br>
                                <div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:8px">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead class="table-info text-center">
                                        <tr>
                                            <th width="5%">SL.</th>
                                            <th width="20%">Department</th>
                                            <th width="20%">Test Name</th>
                                            <th width="5%">Quantity</th>
                                            <th width="20%">Discount</th>
                                            <th width="20%">Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <form action="#" method="POST" id="add_form"> -->
                                        <!-- only this part is repeat -->
                                        <tr>
                                            <th class="text-center">#</th>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <select class="custom-select" ng-model="lab_dept"
                                                        ng-blur="lab_dept_search()">
                                                        <option></option>
                                                        <option ng-repeat="k in lab_dept_data">{{k.lab_dept}}</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <select class="custom-select" ng-model="test"
                                                        ng-blur="test_search()">
                                                        <option></option>
                                                        <option ng-repeat="n in tests_data">{{n.test}}</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <select class="custom-select" ng-model="quantity">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" ng-model="discount">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" ng-model="totalAmount"
                                                        readonly>
                                                </div>
                                            </td>
                                            <!-- upto this -->
                                            <td class="text-center" d-grid><button type="button"
                                                    class="btn btn-success "><i class="fa-solid fa-plus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-right"><b>Grand Total:</b></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" ng-model="grandTotal"
                                                        readonly>
                                                </div>
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="font-size:20px;">
                                <b><i class="fa-solid fa-database"></i> Billing Section</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <div class="row" style="padding-top:8px">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discount (%)</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discount</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Payment Mode</label>
                                    <select type="text" class="form-control">
                                        <option></option>
                                        <option>Cash</option>
                                        <option>Online</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Amount Recieve</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Due Payment</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Total Amount</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-success" id="myBtn"
                                ng-click="patient_regis();patient_entry()">Register</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of patient view section -->
            <!-- patient entry section -->
            <div class="card-body" ng-show="var1">
                <table class="table table-bordered text-center">
                    <thead class="table-info">
                        <tr>
                            <th width="8%">#</th>
                            <th width="10%">Patient ID</th>
                            <th width="15%">Patient Name</th>
                            <th width="15%">Guardian Name</th>
                            <th width="5%">Age</th>
                            <th width="5%">Gender</th>
                            <th width="10%">Phone No</th>
                            <th width="15%">Referral Doctor</th>
                            <th width="10%">Blood Group</th>
                            <th width="7%">Bed ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="a in app_admit_view_data">
                            <th>{{$index+1}}</th>
                            <td>{{a.patient_id}}</td>
                            <td style="text-transform: uppercase;">{{a.patient_name}}</td>
                            <td style="text-transform: capitalize;">{{a.father_name}}</td>
                            <td>{{a.age}}</td>
                            <td style="text-transform: capitalize;">{{a.gender}}</td>
                            <td>{{a.mobile}}</td>
                            <!-- <td>{{a.referral_doctor}}</td> -->
                            <td style="text-transform: capitalize;">{{a.referral_doctor}}</td>
                            <td style="text-transform: uppercase;">{{a.blood_group}}</td>
                            <td style="text-transform: uppercase;">{{a.bed_no}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end of patient entry section -->
    </div>
    </section><!-- End Breadcrumbs Section -->
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
</body>

</html>