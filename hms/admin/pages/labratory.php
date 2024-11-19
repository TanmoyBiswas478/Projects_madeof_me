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
                    
                    // $sql = "SELECT * FROM navigation group by menue order by id";
                    // $res = mysqli_query($con, $sql) or die(mysqli_error($con));
                    // while ($row = mysqli_fetch_assoc($res)) {
                    //     if (!empty($row['submenu'])) {
                    //         echo "<li class='nav-item dropdown'>";
                    //         echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                    //         echo $row['menue'] . "</a>";
                    //         $sql1 = "SELECT * FROM navigation WHERE menue='" . $row['menue'] . "'";
                    //         $res1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
                    //         if (mysqli_num_rows($res1) > 0) {
                    //             echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                    //             while ($row1 = mysqli_fetch_assoc($res1)) {
                    //                 echo "<a class='dropdown-item' href=" . $row1['url'] . ">" . $row1['submenu'] . "</a>";
                    //                 echo "<div class='dropdown-divider'></div>";
                    //             }
                    //             echo "</div>";
                    //         }
                    //         echo "</li>";
                    //     } else {
                    //         echo "<li class='nav-item'>";
                    //         echo "<a class='nav-link' href=" . $row['url'] . ">" . $row['menue'] . "</a>";
                    //         echo "</li>";

                    //     }
                    // }
                    // if ($user == 'Super Admin') {
                    //     echo '<li class="nav-item dropdown">
                    //             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //               Settings
                    //             </a>
                    //             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    //               <a class="dropdown-item" href="menu.php">Menue Section</a>
                    //               <div class="dropdown-divider"></div>
                    //               <a class="dropdown-item" href="permission.php">User Peremission</a>
                    //               <div class="dropdown-divider"></div>
                    //               <a class="dropdown-item" href="create_user.php">Create Users</a>
                    //               <div class="dropdown-divider"></div>
                    //               <a class="dropdown-item" href="active_user.php">Active Users</a>
                    //               </div>
                    //               </li>';
                    //            }
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
        <section class="breadcrumbs" style="padding : 20px !important;">
            <div class="card" ng-init="patient_view();">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2"><b>Labratory Test Section</b></div>
                        <div class="p-2">
                            <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                data-target=".bd-example-modal-lg" ng-show="var" ng-click="patient_entry();">
                                <i class="fas fa-plus"></i>
                                Add Lab Test
                            </button>
                            <button class="btn text-dark" data-toggle="modal" data-target=".bd-example-modal-lg"
                                ng-show="var1" ng-click="patient_view();" style="background-color:#E5E4E2;">
                                <i class="fa-solid fa-users-viewfinder"></i>
                                View Lab Test
                            </button>
                        </div>
                    </div>
                </div>
                <!-- patient view section -->
                <div class="card-body" ng-show="var1">
                    <div class="row">
                        <div class="col-lg-12" style="font-size:20px;"><b><i class="fa-solid fa-circle-info"></i> Case
                                Details</b><br>
                            <div style="border: none; height: 2px; color: #333; background-color: #333;">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:6px;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-child"></i>
                                    Referred By<span style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                            class="fa-solid fa-star-of-life"></i></span></label>
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-users"></i> Collection
                                    Centre<span style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                            class="fa-solid fa-star-of-life"></i></span></label>
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-user-nurse"></i> Sample Collection
                                    Nurse</label>
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:2px;justify-content: center; align-items: center;">
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 65px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #87CEFA; color: black; padding: 5px; border: 1px solid black; width: 50px; height: 60px;"><i
                                        class="fa-solid fa-flask"></i><br>LAB</label>
                            </div>
                        </div>
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 65px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #FBD5AB; color: black; padding: 5px; border: 1px solid black; width: 50px; height: 60px;"><i
                                        class="fa-solid fa-ear-listen"></i><br>USG</label>
                            </div>
                        </div>
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 130px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #A0D6B4; color: black; padding: 5px; border: 1px solid black; width: 110px; height: 60px;"><i
                                        class="fa-solid fa-x-ray"></i><br>Digital
                                    X-Ray</label>
                            </div>
                        </div>
                        <div class="col-md-1.9">
                            <div class="form-group"
                                style="border: 1px solid black; width: 80px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #FBE7A1; color: black; padding: 5px; border: 1px solid black; width: 60px; height: 60px;"><i
                                        class="fa-solid fa-x-ray"></i><br>X-Ray</label>
                            </div>
                        </div>
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 150px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #E0FFFF; color: black; padding: 2px; border: 1px solid black; width: 130px; height: 60px;"><i
                                        class="fa-solid fa-flask"></i><br>Out-Source
                                    Lab</label>
                            </div>
                        </div>
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 65px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #FFFACD; color: black; padding: 5px; border: 1px solid black; width: 50px; height: 60px;"><i
                                        class="fa-solid fa-heart-pulse"></i><br>ECG</label>
                            </div>
                        </div>
                        <div class="col-md-1.8">
                            <div class="form-group"
                                style="border: 1px solid black; width: 90px; height: 80px; display: flex; justify-content: center; align-items: center;">
                                <button type="button" id="Btn" label for="exampleInputEmail1"
                                    style="background-color: #FCDFFF; color: black; padding: 5px; border: 1px solid black; width: 70px; height: 60px;"><i
                                        class="fa-solid fa-expand"></i><br>CT Scan</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-top:3px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-magnifying-glass"></i> Lab
                                    Investigation</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-brands fa-cc-amazon-pay"></i> Paid<span
                                        style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                            class="fa-solid fa-star-of-life"></i></span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><label for="exampleInputEmail1"
                                        style="justify-content: center; align-items: center;"></i>(%)</label>
                                    Discount<span style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                            class="fa-solid fa-star-of-life"></i></span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="font-size:20px;"> Payment Details</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"></i> Total Rs.</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Discount</label>
                                <label for="exampleInputEmail1"></i> (%)</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="justify-content: center; align-items: center;"><i
                                        class="fa-solid fa-money-bill-1-wave"></i> Amount Recieved</label>
                                <label for="exampleInputEmail1"
                                    style="justify-content: center; align-items: center;"></i></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fa-solid fa-hand-holding-dollar"></i>
                                    Collection Charge</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1"><i class="fa-regular fa-rectangle-list"></i> Total
                                Balance</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1"><i class="fa-solid fa-wallet"></i> Mode</label>
                            <select type="text" class="form-control">
                                <option>Cash</option>
                                <option>UPI</option>
                                <option>NEFT/RTGS</option>
                                <option>Others</option>
                        </div>
                    </div>
                </div>
                <!-- Submission Section -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" id="takePictureBtn" ng-click="openCamera()">Take
                            Picture</button> &nbsp;
                        <!-- <button type="button" class="btn btn-primary" id="takePictureBtn"
                                ng-click="takePicture()">Take Picture</button> &nbsp; -->
                        <!-- <button type="button" class="btn btn-warning" id="retakeBtn" style="display: none;"
                                ng-click="retakePicture()">Retake</button> &nbsp; -->
                        <button type="button" class="btn btn-success" id="myBtn"
                            ng-click="takePicture();patient_entry()">Submit</button> &nbsp;
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
                    <th width="15%">Patient Name</th>
                    <th width="15%">Guardian Name</th>
                    <th width="5%">Age</th>
                    <th width="10%">Phone No</th>
                    <th width="15%">Referral Doctor</th>
                    <th width="10%">Bed Group</th>
                    <th width="7%">Bed ID</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><button class="btn-warning" title="edit" data-toggle="modal"
                            data-target="#exampleModalCenter" ng-click="doctor_edit(x.id)"><i
                                class="fa-solid fa-pen-to-square"></i></button>
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