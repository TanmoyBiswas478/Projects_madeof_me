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
            //         $sql = "SELECT * FROM permission where ph='" . $user . "' group by menue order by id";
            //         $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            //         while ($row = mysqli_fetch_assoc($res)) {
            //             if (!empty($row['submenue'])) {
            //                 echo "<li class='nav-item dropdown'>";
            //                 echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
            //                 echo $row['menue'] . "</a>";
            //                 $sql1 = "SELECT * FROM permission WHERE menue='" . $row['menue'] . "' and ph='" . $user . "'";
            //                 $res1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
            //                 if (mysqli_num_rows($res1) > 0) {
            //                     echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
            //                     while ($row1 = mysqli_fetch_assoc($res1)) {
            //                         echo "<a class='dropdown-item' href=" . $row1['url'] . ">" . $row1['submenue'] . "</a>";
            //                         echo "<div class='dropdown-divider'></div>";
            //                     }
            //                     echo "</div>";
            //                 }
            //                 echo "</li>";
            //             } else {
            //                 echo "<li class='nav-item'>";
            //                 echo "<a class='nav-link' href=" . $row['url'] . ">" . $row['menue'] . "</a>";
            //                 echo "</li>";
            //             }
            //         }
            //         if ($user == 'Super Admin') {
            //             echo '<li class="nav-item dropdown">
            //    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //    Settings
            //    </a>
            //    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            //    <a class="dropdown-item" href="menu.php">Menue Section</a>
            //    <div class="dropdown-divider"></div>
            //    <a class="dropdown-item" href="permission.php">User Peremission</a>
            //    <div class="dropdown-divider"></div>
            //    <a class="dropdown-item" href="create_user.php">Create Users</a>
            //    <div class="dropdown-divider"></div>
            //    <a class="dropdown-item" href="active_user.php">Active Users</a>
            //    </div>
            //    </li>';
            //         }
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
            ng-init="app_admit_view();symptom_head_view();bed_type_view();bed_view();ward_view();patient_view();dept_view();symptom_view();tpa_view();doctor_view();patient_old();general_view();payment_view();nation_view();ipd_view();">
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
                                    ng-blur="ipd_search();">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Registration
                                    Type</label>
                                    
                                    <div class="input-group-text">IPD</div>
                            </div>
                        </div>
                        <div class="col-md-3"  >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Referral Doctor</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Dr.</div>
                                    </div>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        name="referral_doctor" id="referral_doctor" ng-model="referral_doctor"
                                        list="referrallist" required>
                                    <datalist id="referrallist">
                                        <option>Tanmoy Biswas</option>
                                        <option>Sani Shil</option>
                                        <option>Mrinmoy Biswas</option>
                                    </datalist>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"  >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Consultant Doctor</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Dr.</div>
                                    </div>
                                    <select type="text" class="form-control" id="textInput"
                                        style="text-transform: uppercase;" ng-model="con_doctor" required>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- *OPD -->

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
                    <div class="row"  >
                        <div class="col-lg-12" style="font-size:20px;">
                            <b><i class="fa-solid fa-hands-holding-child"></i> Guardian
                                Details</b><br>
                            <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </Div>
                        </div>
                    </div>
                    <!-- Guardian Section -->
                    <div>
                        <div class="row" style="padding-top:8px"  >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-person-breastfeeding"></i>
                                        Guardian Name</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        ng-model="gurdian_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-infinity"></i> Relationship
                                        With
                                        Guardian</label>
                                    <select class="form-control" ng-model="relationship">
                                        <option></option>
                                        <option>Father</option>
                                        <option>Mother</option>
                                        <option>Wife</option>
                                        <option>Brother</option>
                                        <option>Sister</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-address-card"></i> Guardian
                                        Address</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        ng-model="gurdian_address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-address-card"></i> Guardian
                                        Mobile</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;"
                                        ng-model="gar_mobile" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                        </div>
                        <div class="row"  >
                            <div class="col-lg-12" style="font-size:20px;">
                                <b><i class="fa-solid fa-building"></i>
                                    Department Details</b><br>
                                <Div style="border: none; height: 2px; color: #333; background-color: #333;">
                                    <hr>
                                </Div>
                            </div>
                        </div>
                        <!-- Department Section -->
                        <div class="row" style="padding-top:8px"  >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-building"></i> Department
                                    </label>
                                    <select type="text" class="form-control" name="department" ng-model="department"
                                        ng-blur="ward_search()">
                                        <option ng-repeat="y in dept_view_data" value="{{y.dept_id}}">{{y.dept_name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-building"></i> Ward</label>
                                    <select type="text" class="form-control" name="department_ward"
                                        ng-model="department_ward" ng-blur="bed_type_search()">
                                        <option></option>
                                        <option ng-repeat="z in wdata">{{z.w_no}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-bed"></i> Bed Type</label>
                                    <select type="text" class="form-control" name="bed_type" ng-model="bed_type"
                                        ng-blur="bed_no_search()">
                                        <option></option>
                                        <option ng-repeat="b in btdata">{{b.bed_type}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-bed"></i> Bed No</label>
                                    <select type="text" class="form-control" name="bed_no" ng-model="bed_no">
                                        <option></option>
                                        <option ng-repeat="l in bed_no_data">{{l.bed_no}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group"  >
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-truck-medical"></i>
                                        Payment Mode</label>
                                    <select type="text" class="form-control" ng-model="pay_mode">
                                        <option></option>
                                        <option ng-repeat="p in payment_view_data">{{p.payment_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-user-doctor"></i>
                                        Payment Package</label>
                                    <select class="form-control" id="exampleFormControlSelect1"
                                        style="text-transform: capitalize;" ng-model="pay_pack">
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-user-doctor"></i>
                                        Advance Payment</label>
                                    <input type="text" class="form-control" id="exampleFormControlSelect1"
                                        ng-model="adv_pay">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-user-doctor"></i>
                                        Due Payment</label>
                                    <input type="text" class="form-control" id="exampleFormControlSelect1"
                                        ng-model="due">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptom
                                        Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="symptoms_type"
                                        ng-model="symptoms_type" ng-blur="symptoms_type_search()">
                                        <option></option>
                                        <option ng-repeat="s in symptom_view_data">{{s.symptoms_type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptom
                                        Head</label>
                                    <input class="form-control" id="exampleFormControlSelect1" name="symptoms_title"
                                        ng-model="symptoms_title" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptoms
                                        Description</label>
                                    <textarea class="form-control" id="exampleFormControlSelect1" name="symptoms_desc"
                                        ng-model="symptoms_desc" readonly></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group"  >
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-pen"></i> Note</label>
                                    <textarea class="form-control" style="text-transform: capitalize;"
                                        id="exampleFormControlTextarea1" ng-model="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-success" id="myBtn"
                                ng-click="ipd_regis();patient_entry()">Register</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of patient view section -->
            <!-- patient entry section -->
            <div class="card-body" ng-show="var1">
            <div class="row">
                    <div class="col-lg-9"></div>
                    <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="search" placeholder="Search">
                            </div>
                        </div>
                </div>
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
                        <tr ng-repeat="a in ipd_view_data | filter:search">
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