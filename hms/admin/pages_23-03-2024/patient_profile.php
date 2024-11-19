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
    <style>
    /*--------------------------------------------------------------
# Profie Page
--------------------------------------------------------------*/
    .profile .profile-card img {
        max-width: 120px;
    }

    .profile .profile-card h2 {
        font-size: 24px;
        font-weight: 700;
        color: #2c384e;
        margin: 10px 0 0 0;
    }

    .profile .profile-card h3 {
        font-size: 18px;
    }

    .profile .profile-card .social-links a {
        font-size: 20px;
        display: inline-block;
        color: rgba(1, 41, 112, 0.5);
        line-height: 0;
        margin-right: 10px;
        transition: 0.3s;
    }

    .profile .profile-card .social-links a:hover {
        color: #012970;
    }

    .profile .profile-overview .row {
        margin-bottom: 20px;
        font-size: 15px;
    }

    .profile .profile-overview .card-title {
        color: #012970;
    }

    .profile .profile-overview .label {
        font-weight: 600;
        color: rgba(1, 41, 112, 0.6);
    }

    .profile .profile-edit label {
        font-weight: 600;
        color: rgba(1, 41, 112, 0.6);
    }

    .profile .profile-edit img {
        max-width: 120px;
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
                    //                 echo "<a class='dropdown-item' href=pages/" . $row1['url'] . ">" . $row1['submenu'] . "</a>";
                    //                 echo "<div class='dropdown-divider'></div>";
                    //             }
                    //             echo "</div>";
                    //         }
                    //         echo "</li>";
                    //     } else {
                    //         echo "<li class='nav-item'>";
                    //         echo "<a class='nav-link' href=pages/" . $row['url'] . ">" . $row['menue'] . "</a>";
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
            <div class="card">
                <div class="card-header text-white bg-info">
                    <div class="d-flex">
                        <div class="mr-auto p-2"><b>Patient Profile Section</b></div>
                        <div class="p-2">
                            <!-- <button class="btn text-dark" style="background-color:#E5E4E2;" data-toggle="modal"
                                data-target=".bd-example-modal-lg">
                                <i class="fas fa-plus"></i>
                                Add Patient
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
            <section class="section profile" style="padding-top:20px">
                <div class="row">
                    <div class="col-xl-3">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="../../assets/images/1.jpg" alt="Profile" class="rounded-circle">
                                <h2></h2>
                                <h3></h3>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-9">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <div>
                                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i>
                                        Patient Profile</button>
                                    <button type="button" class="btn btn-info"><i class="fa-solid fa-syringe"></i>
                                        Previous Medicine</button>
                                    <button type="button" class="btn btn-success"><i
                                            class="fa-solid fa-file-prescription"></i> Add Medicine</button>
                                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-flask-vial"></i>
                                        Lab Test</button>
                                </div>
                                <hr>
                                <div class="tab-content pt-2">
                                    <!-- Patient Profile Start -->
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fa-solid fa-book"></i> Patient Details</h5>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card-body">

                                                        <p class="card-text">Patient ID:</p>
                                                        <p class="card-text">Patient Name:</p>
                                                        <p class="card-text">Guardian Name:</p>
                                                        <p class="card-text">Age:</p>
                                                        <p class="card-text">Gender:</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <p class="card-text">Blood Group:</p>
                                                    <p class="card-text">Bed Group:</p>
                                                    <p class="card-text">Bed ID:</p>
                                                    <p class="card-text">Referral Doctor:</p>
                                                    <p class="card-text">Consult Doctor:</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Patient Profile End -->
                                </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
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