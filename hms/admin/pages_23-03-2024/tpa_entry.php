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
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-danger"><b>TPA Section</b></h2>
                    <!-- <ol>
                <li><a href="#"><button class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Back</button></a></li>
            </ol> -->
                </div>
            </div>
        </section><!-- End Breadcrumbs Section -->
        <div style="padding-top: 20px;" ng-init="tpa_view()">
            <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
            <div class="container">
                <p class="text-right">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                            class="fa-solid fa-plus"></i> Add TPA</button>
                </p>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="table-warning text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center" style=" text-transform: uppercase;">TPA Name</th>
                            <th class="text-center" style=" text-transform: uppercase;">Code</th>
                            <th class="text-center" style=" text-transform: uppercase;">Phone</th>
                            <th class="text-center" style=" text-transform: uppercase;">Address</th>
                            <th class="text-center" style=" text-transform: uppercase;">Contact person name</th>
                            <th class="text-center" style=" text-transform: uppercase;">Contact person phone</th>
                            <th class="text-center" style=" text-transform: uppercase;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in tpa_view_data">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{x.name}}</td>
                            <td class="text-center">{{x.code}}</td>
                            <td class="text-center">{{x.phone}}</td>
                            <td class="text-center">{{x.address}}</td>
                            <td class="text-center">{{x.contact_prsn_nme}}</td>
                            <td class="text-center">{{x.contact_prsn_ph}}</td>
                            <td class="text-center">
                                <button class="btn-success" title="edit" data-toggle="modal"
                                    data-target="#exampleModalCenter" ng-click="tpa_edit(x.id)"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-danger" title="Delete" ng-click="tpa_delete(x.id)"><i
                                        class="fa-sharp fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Client Model Section -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h2 class="text-center">TPA Entry Section</h2>
                    <div class="container" style="padding-bottom: 20px !important;">

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">TPA Name <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" ng-model="name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Code <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" ng-model="code" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact No. <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" ng-model="phone" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Address</label>
                                    <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                        ng-model="address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact Person Name</label>
                                    <input type="text" class="form-control" ng-model="contact_prsn_nme" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact Person Phone</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="contact_prsn_ph">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-success" id="myBtn"
                                    ng-click="tpa_entry()">Submit</button> &nbsp;
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Model Section  -->
        <!-- Update model section -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update TPA Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">TPA Name <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" ng-model="name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Code <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" ng-model="code" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact No. <span
                                            style="color:red; font-size: 8px; vertical-align: text-top;"><i
                                                class="fa-solid fa-star-of-life"></i></span></label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" ng-model="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Address</label>
                                    <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                        ng-model="address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact person name</label>
                                    <input type="text" class="form-control" ng-model="contact_prsn_nme" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact person phone</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        style=" text-transform: uppercase;" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="contact_prsn_ph">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            ng-click="tpa_update()">Update</button>
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
</body>

</html>