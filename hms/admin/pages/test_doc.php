<!doctype html>
<html lang="en">

<head>
    <title>Admin Section</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- fontawesome link section  -->
    <link rel="stylesheet" href="../../assets/fw/css/all.min.css">
    <script src="../../assets/js/angular.min.js"></script>
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
                        <a class='nav-link' href="#">Logout</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    Welcome Doctor
                </form>
            </div>
        </nav>


        <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->
        <div class="container">
            <p class="text-right">
                <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add Doctor</button>
            </p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="table-warning text-dark">
                        <th class="text-center">#</th>
                        <th class="text-center">Complaints</th>
                        <th class="text-center">Present History</th>
                        <th class="text-center">Past History</th>
                        <th class="text-center">CVS</th>
                        <th class="text-center">CNS</th>
                        <th class="text-center">General Examination</th>
                        <th class="text-center">Provisional Diagnosis</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in doctor_view_data">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">{{x.}}</td>
                        <td class="text-center">
                            <button class="btn-success" title="edit" data-toggle="modal" data-target="#exampleModalCenter" ng-click="doctor_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-danger" title="Delete" ng-click="doctor_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
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
                <h2 class="text-center">Doctor Section</h2>
                <div class="container" style="padding-bottom: 20px !important;">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Complaints</label>
                                <textarea class="form-control" class="form-control" style="text-transform: capitalize;"></textarea required
                                ng-model="regis_no" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Present History </label>
                                <textarea class="form-control" class="form-control" style="text-transform: capitalize;"></textarea required
                                ng-model="regis_no" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Past History </label>
                                <textarea class="form-control" class="form-control" style="text-transform: capitalize;"></textarea required
                                ng-model="regis_no" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">CVS</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="specialization" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">CNS</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="qulification" required>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">General Examination</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="specialization" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Provisional Diagnosis</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="qulification" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container">
                            <div class="col-lg-14 ">
                                <!-- <div class="card-header"> -->
                                    <h3>Advice Test</h3>
                                <!-- </div> -->
                                <div style="padding-top: 10px;" ng-init="st_view()">
                                    <div class="card-body p-1">
                                        <form action="#" method="POST" id="add_form">
                                            <div id="show_item">
                                                <div class="row">
                                                    <div class="col-md-10 nb-3">
                                                        <input type="text" name="product_name[]" class="form-control"
                                                        placeholder="Advice Test" required>
                                                    </div>
                                                    <div class="col-md-2 nb-3" d-grid>
                                                        <button type="button" class="btn btn-success add_item_btn">Add More</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <input type="submit" value="Submit" class="btn btn-primary w-25" id="add_btn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-success" ng-click="doctor_entry()">Submit</button> &nbsp;
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Update Model Section  -->
        <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Doctor Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Registration No</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        ng-model="resgis_no" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Doctor Name</label>
                                    <input type="text" class="form-control" style="text-transform: uppercase;"
                                        ng-model="name" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Address</label>
                                    <textarea class="form-control" ng-model="doctoraddress"
                                        style="text-transform: capitalize;"></textarea required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Phone No</label>
                            <input type="text" class="form-control" ng-model="mobile" maxlength="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-model="ph" required>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="email" class="form-control" id="formGroupExampleInput" style="text-transform: lowercase;" ng-model="email" required>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Specialization</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="specialization" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Degree</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="qulification" required>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            ng-click="doctor_update()">Update</button>
                    </div>
                </div>
            </div>
        </div> -->





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
            $(document).ready(function(){
            // Function to add items
            $(".add_item_btn").click(function(e){
                e.preventDefault();
                $("#show_item").prepend('<div class="row">' +
                                        '<div class="col-md-10 nb-3">' +
                                            '<input type="text" name="product_name[]" class="form-control"' +
                                        'placeholder="Advice Test" required>' +
                                        '</div>' +
                                        // '<div class="col-md-3 nb-3">' +
                                        //     '<input type="number" name="product_price[]" class="form-control"' +
                                        //         'placeholder="Item Price" required>' +
                                        // '</div>' +
                                        // '<div class="col-md-3 nb-3">' +
                                        //     '<input type="number" name="product_quantity[]" class="form-control"' +
                                        //         'placeholder="Item Quantity" required>' +
                                        // '</div>' +
                                        '<div class="col-md-2 nb-3" d-grid>' +
                                            '<button type="button" class="btn btn-danger remove_item_btn">Remove</button>' +
                                        '</div>' +
                                    '</div>');
            });

            // Function to remove items
            $("#show_item").on("click", ".remove_item_btn", function() {
                $(this).closest('.row').remove();
                console.log("Item removed"); // Add this line for debugging
            });
        });

    </script>

</body>

</html>