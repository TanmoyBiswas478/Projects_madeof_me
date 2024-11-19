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
        <section class="breadcrumbs" style="padding : 20px !important;" ng-init="nurse_patient_view();">
            <div class="card" ng-init="patient_view();">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2"><b>Patient List Section</b></div>
                        <div class="p-2">
                            <button class="btn text-dark" data-toggle="modal" data-target=".bd-example-modal-lg"
                                ng-show="var1" ng-click="patient_view();" style="background-color:#E5E4E2;">
                                <i class="fa-solid fa-users-viewfinder"></i>
                                View Patient
                            </button>
                        </div>

                    </div>
                </div>
                <!-- patient view section -->
                    <div class="card-body" ng-show="var1">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user"></i> Patient ID</label>
                                    <input type="text" class="form-control" ng-model="patient_id" name="patient_id"
                                        readonly>
                                    <input type="hidden" class="form-control" ng-model="idd">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user"></i> Patient
                                        Name</label>
                                    <input type="text" class="form-control" name="patient_name" ng-model="patient_name"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Referral
                                        Doctor Name</label>
                                    <input type="text" class="form-control" name="referral_doctor"
                                        ng-model="referral_doctor" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-user-doctor"></i> Consult
                                        Doctor Name</label>
                                    <input type="text" class="form-control" name="consult_doctor"
                                        ng-model="consult_doctor" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-venus-mars"></i>
                                        Gender</label>
                                    <input type="text" class="form-control" name="gender" ng-model="gender" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-calendar-days"></i>
                                        Age</label>
                                    <input type="text" class="form-control" ng-model="age" name="age" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-building"></i> Department
                                        Ward</label>
                                    <input type="text" class="form-control" name="department" ng-model="department"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-building"></i> Department
                                        Ward</label>
                                    <input type="text" class="form-control" name="department_ward"
                                        ng-model="department_ward" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-bed"></i> Bed Type</label>
                                    <input type="text" class="form-control" name="bed_type" ng-model="bed_type"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><i class="fa-solid fa-bed"></i> Bed ID</label>
                                    <select type="text" class="form-control" name="bed_no" ng-model="bed_no">
                                        <option></option>
                                        <option ng-repeat="c in b_no_data">{{c.bed_no}}></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-up-long"></i>
                                        Height (cm)</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="height"
                                        maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-weight-scale"></i>
                                        Weight (kg)</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="weight"
                                        maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-droplet"></i> BP</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="bp"
                                        maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-heart-pulse"></i>
                                        Pulse</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="pulse"
                                        maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i
                                            class="fa-solid fa-temperature-three-quarters"></i> Temperature</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="temp">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-head-side-cough"></i>
                                        Respiration</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="resp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptoms
                                        Type</label>
                                    <input class="form-control" id="exampleFormControlSelect1" name="symptoms_type"
                                        ng-model="symptoms_type" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptoms
                                        Title</label>
                                    <input class="form-control" id="exampleFormControlSelect1" name="symptoms_title"
                                        ng-model="symptoms_title" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-disease"></i> Symptoms
                                        Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="symptoms_desc"
                                        ng-model="symptoms_desc" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-pen-nib"></i> Doctor's
                                        Note</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        ng-model="description" name="description" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-pen-nib"></i>
                                        Note</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        name="note"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-hand-dots"></i> Any
                                        Known
                                        Allergies</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        name="any_allerg"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"><i class="fa-solid fa-viruses"></i> Previous
                                        Medical Issue</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        name="prev_med_isu"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-success" id="myBtn">Accept</button> &nbsp;
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    ng-click="patient_view();">Exit</button> &nbsp;
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end of patient view section -->
            <!-- patient entry section -->
            <div class="card-body" ng-show="var">
                <table class="table table-bordered text-center">
                    <thead class="table-info">
                        <tr>
                            <th width="8%">#</th>
                            <th width="10%">Patient ID</th>
                            <th width="13%">Patient Name</th>
                            <th width="12%">Guardian Name</th>
                            <th width="5%">Age</th>
                            <th width="10%">Phone No</th>
                            <th width="15%">Referral Doctor</th>
                            <th width="10%">Bed Group</th>
                            <th width="7%">Bed ID</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in nurse_patient_data">
                            <th>{{$index+1}}</th>
                            <td>{{x.patient_id}}</td>
                            <td>{{x.patient_name}}</td>
                            <td>{{x.gurdian_name}}</td>
                            <td>{{x.age}}</td>
                            <td>{{x.mobile}}</td>
                            <td>{{x.referral_doctor}}</td>
                            <td>{{x.bed_type}}</td>
                            <td>{{x.bed_no}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="Admit Patient" data-toggle="modal"
                                    data-target="#exampleModalCenter" ng-show="var"
                                    ng-click="patient_entry();nurse_view(x.id)"><i
                                        class="fa-solid fa-folder-plus"></i></button>
                                        <button class="btn-danger" title="Reject" data-toggle="modal"
                                    data-target="#exampleModalCenter" ng-click=""><i class="fa-solid fa-ban"></i></button>
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