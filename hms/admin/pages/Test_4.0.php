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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add Staff
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">#</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">#</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pacent Section
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="PacentSection.php">Pacent Section</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Undefined</a>
                        </div>
                    </li> -->

                    <li class='nav-item'>
                        <a class='nav-link' href="#">Logout</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    Welcome to Admin
                </form>
            </div>
        </nav>


        <!-- <h2 class="text-center"><u>Add Section</u></h2> -->
        <div class="container">
            <p class="text-right">
                <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add Charges</button>
            </p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="table-warning text-dark">
                        <th class="text-center">#</th>
                        <th class="text-center" style=" text-transform: uppercase;">Name</th>
                        <th class="text-center" style=" text-transform: uppercase;">Charge Chatagory</th>
                        <th class="text-center" style=" text-transform: uppercase;">Charge Type</th>
                        <th class="text-center" style=" text-transform: uppercase;">Unit</th>
                        <th class="text-center" style=" text-transform: uppercase;">Tax</th>
                        <th class="text-center" style=" text-transform: uppercase;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr ng-repeat="x in unit_name_view">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">{{x.unit_name}}</td>
                        <td class="text-center">
                            <button class="btn-success" title="View" data-toggle="modal" data-target="#exampleModalCenter" ng-click="unit_name_delete(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-download" title="Download" ng-click="unit_name_delete(x.id)"><i class="fa-sharp fa-solid fa-trash"></i></button>
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
                <h2 class="text-center">Add staff</h2>
                <div class="container" style="padding-bottom: 20px !important;">

                    <!-- PAY role Part Start -->

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">EPF No</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Basic Salary</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Contract Type</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option> </option>
                                    <option>Permanent</option>
                                    <option>Probation</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Depertment</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div> -->

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Work Shift</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Work Location</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">input ur</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Mother Name</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div> -->

                    </div>


                    <!-- leaves part Start-->


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Casual Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Privelage Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Sick Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Maternity Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Paternity Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Fever Leave</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                    </div>


                    <!-- Bank section Start-->


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Account Holder Name</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Bank Account No</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Bank Name</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">IFSC Code</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Branch Name</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Specialization</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Note</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div> -->

                    </div>

                    <!-- upload part Start -->


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Resume </label>
                                <input type="file" class="form-control" ng-model="unit_name_temp1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Joining Letter</label>
                                <input type="file" class="form-control" ng-model="unit_name_temp1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Other Documents</label>
                                <input type="file" class="form-control" ng-model="unit_name_temp1">
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Reference Contact</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div> -->

                    </div>


                    <!-- <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tax Chatagory</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tax</label>
                                <select class="form-control" ng-model="bed_type">
                                    <option ng-repeat="z in bed_type_data"> </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Standard Charges</label>
                                <input type="text" class="form-control" ng-model="unit_name" style=" text-transform: uppercase;" ng-model="unit_name">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Descryption</label>
                                <textarea class="form-control" type="text" id="exampleFormControlTextarea1" ng-model="symptoms_description"></textarea>
                            </div>
                        </div>

                    </div> -->



                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-success" id="myBtn" ng-click="unit_name_entry()">Submit</button> &nbsp;
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Update model section -->
    <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Unit Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Unit</label>
                                <input type="text" class="form-control" style=" text-transform: uppercase;" ng-model="name">
                                <input type="hidden" class="form-control" ng-model="idd">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">-->

    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->

    <!--<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="unit_name_update()">Update</button>
                </div>
            </div>
        </div>
    </div>
    </div> -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="../controller/main.js"></script>
</body>

</html>