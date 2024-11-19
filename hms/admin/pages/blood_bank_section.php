<?php
  include '../../assets/api/connect.php';
  session_start();
  if (empty($_SESSION['user'])) {
      echo "<script>window.location.href='../index.html';</script>";
  } else {
      $user = $_SESSION['user'];
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ASR Hospitals</title>
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
               $sql ="SELECT * FROM navigation group by menue order by id";
               $res = mysqli_query($con, $sql) or
                   die(mysqli_error($con));
               while ($row = mysqli_fetch_assoc($res)) {
                   if (!empty($row['submenu'])) {
                       echo "<li class='nav-item dropdown'>";
                       echo "<a class='nav-link dropdown-toggle' href='#'
                           id='navbarDropdown' st='button'
                           data-toggle='dropdown' aria-haspopup='true'
                           aria-expanded='false'>";
                       echo $row['menue'] . "</a>";
                       $sql1 = "SELECT * FROM navigation WHERE menue='" .
                           $row['menue'] . "'";
                       $res1 = mysqli_query($con, $sql1) or
                           die(mysqli_error($con));
                       if (mysqli_num_rows($res1) > 0) {
                           echo "<div class='dropdown-menu'
                           aria-labelledby='navbarDropdown'>";
                           while ($row1 = mysqli_fetch_assoc($res1)) {
                               echo "<a class='dropdown-item'
                               href=" . $row1['url'] . ">" . $row1['submenu'] . "</a>";
                               echo "<div class='dropdown-divider'></div>";
                           }
                           echo "</div>";
                       }
                       echo "</li>";
                   } else {
                       echo "<li class='nav-item'>";
                       echo "<a class='nav-link'
                           href=" . $row['url'] . ">" . $row['menue'] . "</a>";
                       echo "</li>";
               
                   }
               }
               if ($user == 'Super Admin') {
                   echo '<li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#"
                           id="navbarDropdown" st="button"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                           Settings
                       </a>
                       <div class="dropdown-menu"
                           aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="menu.php">Menue
                               Section</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item"
                               href="permission.php">User Peremission</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item"
                               href="create_user.php">Create Users</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item"
                               href="active_user.php">Active Users</a>
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
      <h2>Blood Bank</h2>
      <div class="tab">
         <button class="tablinks" onclick="openCity(event, 'Type')">Product Type</button>
         <button class="tablinks" onclick="openCity(event, 'Product')">Product Details</button>
         <button class="tablinks" onclick="openCity(event, 'Donor')">Blood Donor Details</button>
      </div>
      <!-- Product Type Entry -->
      <div id="Type" class="tabcontent">
         <h3>Product Type</h3>
         <div style="padding-top: 20px;" ng-init="p_type_view();">
            <div class="container">
               <p class="text-right">
                  <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg1"><i
                        class="fa-solid fa-plus"></i> Add Product</button>
               </p>
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr class="table-warning text-dark">
                        <th class="text-center">#</th>
                        <th class="text-center" style=" text-transform: uppercase;">Type</th>
                        <th class="text-center" style=" text-transform: uppercase;">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="x in p_type_view_data">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{x.product_type}}</td>
                        <td class="text-center">
                           <button class="btn-success" title="Edit" data-toggle="modal"
                              data-target="#exampleModalCenter" ng-click="p_type_edit(x.id)"><i
                                 class="fa-solid fa-pen-to-square"></i></button>
                           <button class="btn-danger" title="Delete" ng-click="p_type_delete(x.id)"><i
                                 class="fa-sharp fa-solid fa-trash"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- client Model Section  -->
         <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <h2 class="text-center">Product Type Entry Section</h2>
                  <div class="container" style="padding-bottom: 20px !important;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Type</label>
                              <input type="text" class="form-control" ng-model="product_type" id="textInput" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <button type="button" class="btn btn-success" id="myBtn"
                              ng-click="p_type_entry()">Submit</button>
                           &nbsp;
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                           &nbsp;
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Update model section -->
         <div class="modal fade bd-example-modal-lg1" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Update Product
                        Type
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Type</label>
                              <input type="text" class="form-control" ng-model="product_type" id="textInput" required>
                              <input type="hidden" class="form-control" ng-model="idd">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal"
                        ng-click="p_type_update()">Update</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- End of Product section  -->
      </div>
      <!-- Product Type END -->
      <!-- Product Section Entry -->
      <div id="Product" class="tabcontent">
         <h3>Product Details</h3>
         <div style="padding-top: 20px;" ng-init="product_view();">
            <div class="container">
               <p class="text-right">
                  <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg2"><i
                        class="fa-solid fa-plus"></i> Add Product</button>
               </p>
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr class="table-warning text-dark">
                        <th class="text-center">#</th>
                        <th class="text-center" style=" text-transform: uppercase;">Name</th>
                        <th class="text-center" style=" text-transform: uppercase;">Type</th>
                        <th class="text-center" style=" text-transform: uppercase;">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="x in product_view_data">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{x.product_name}}</td>
                        <td class="text-center">{{x.product_type}}</td>
                        <td class="text-center">
                           <button class="btn-success" title="Edit" data-toggle="modal" data-target="#productEditModal"
                              ng-click="product_edit(x.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                           <button class="btn-danger" title="Delete" ng-click="product_delete(x.id)"><i
                                 class="fa-sharp fa-solid fa-trash"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- client Model Section  -->
         <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <h2 class="text-center">Product Entry Section</h2>
                  <div class="container" style="padding-bottom: 20px !important;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Type</label>
                              <select class="form-control" ng-model="product_type" id="textInput" required>
                                 <option></option>
                                 <option ng-repeat="y in p_type_view_data">{{y.product_type}}</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Name</label>
                              <input type="text" class="form-control" ng-model="product_name" id="textInput" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <button type="button" class="btn btn-success" id="myBtn"
                              ng-click="product_entry()">Submit</button>
                           &nbsp;
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                           &nbsp;
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Update model section -->
         <div class="modal fade bd-example-modal-lg2" id="productEditModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Update Product
                        Section
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Type</label>
                              <select class="form-control" ng-model="product_type" id="textInput" required>
                                 <option></option>
                                 <option ng-repeat="y in p_type_view_data">{{y.product_type}}</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Product Name</label>
                              <input type="text" class="form-control" ng-model="product_name" id="textInput" required>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal"
                        ng-click="product_update()">Update</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- End of Product section  -->
      </div>
      <div id="Donor" class="tabcontent">
         <h3>Blood Donor Details</h3>
         <div style="padding-top: 20px;" ng-init="donor_view();">
            <div class="container">
               <p class="text-right">
                  <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg5">
                     <i class="fa-solid fa-plus"></i> Add Blood Donor
                  </button>
               </p>
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr class="table-warning text-dark">
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="17%">Donar Name</th>
                        <th class="text-center" width="5%">Blood Group</th>
                        <th class="text-center" width="12%">Date Of Birth</th>
                        <th class="text-center" width="5%">Gender</th>
                        <th class="text-center" width="5%">Contact Number</th>
                        <th class="text-center" width="15%">Guardian Name</th>
                        <th class="text-center" width="13%">Address</th>
                        <th class="text-center" width="13%">Report</th>
                        <th class="text-center" width="10%">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="x in donor_view_data">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{x.donor_name}}</td>
                        <td class="text-center">{{x.b_gr}}</td>
                        <td class="text-center">{{x.dob}}</td>
                        <td class="text-center">{{x.gender}}</td>
                        <td class="text-center">{{x.ph}}</td>
                        <td class="text-center">{{x.g_name}}</td>
                        <td class="text-center">{{x.address}}</td>
                        <td class="text-center">{{x.report}}</td>
                        <td class="text-center">
                           <button class="btn-success" title="Edit" data-toggle="modal" data-target="#donorEditModal"
                              ng-click="donor_edit(x.id)">
                              <i class="fa-solid fa-pen-to-square"></i>
                           </button>
                           <button class="btn-danger" title="Delete" ng-click="donor_delete(x.id)">
                              <i class="fa-sharp fa-solid fa-trash"></i>
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Client Model Section -->
         <div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <h2 class="text-center">Add Blood Donor</h2>
                  <div class="container" style="padding-bottom: 20px !important;">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Donor Name</label>
                              <input type="text" class="form-control" ng-model="donor_name"
                                 style=" text-transform: uppercase;">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Date Of Birth</label>
                              <input type="date" class="form-control" ng-model="dob">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Blood Group</label>
                              <select class="form-control" ng-model="b_gr">
                                 <option></option>
                                 <option>A+</option>
                                 <option>A-</option>
                                 <option>B+</option>
                                 <option>B-</option>
                                 <option>O+</option>
                                 <option>O-</option>
                                 <option>AB+</option>
                                 <option>AB-</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Gender</label>
                              <select class="form-control" id="formGroupExampleInput"
                                 style="text-transform: capitalize;" ng-model="gender">
                                 <option ng-repeat="">Select</option>
                                 <option>Male</option>
                                 <option>Female</option>
                                 <option>Others</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Guardian Name</label>
                              <input type="text" class="form-control" ng-model="g_name"
                                 style=" text-transform: uppercase;">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Contact Number</label>
                              <input type="text" class="form-control" ng-model="ph" style=" text-transform: uppercase;">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Address</label>
                              <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                 ng-model="address"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Report</label>
                              <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                 ng-model="report"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <button type="button" class="btn btn-success" id="myBtn"
                              ng-click="donor_entry()">Submit</button> &nbsp;
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                           &nbsp;
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Update model section -->
         <div class="modal fade bd-example-modal-lg6" id="donorEditModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Update
                        Blood Donor List
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Donor Name</label>
                              <input type="text" class="form-control" ng-model="donor_name"
                                 style=" text-transform: uppercase;">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Date Of Birth</label>
                              <input type="date" class="form-control" ng-model="dob">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Blood Group</label>
                              <select class="form-control" ng-model="b_gr">
                                 <option></option>
                                 <option>A+</option>
                                 <option>A-</option>
                                 <option>B+</option>
                                 <option>B-</option>
                                 <option>O+</option>
                                 <option>O-</option>
                                 <option>AB+</option>
                                 <option>AB-</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Gender</label>
                              <select class="form-control" id="formGroupExampleInput"
                                 style="text-transform: capitalize;" ng-model="gender">
                                 <option ng-repeat="">Select</option>
                                 <option>Male</option>
                                 <option>Female</option>
                                 <option>Others</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Guardian Name</label>
                              <input type="text" class="form-control" ng-model="g_name"
                                 style=" text-transform: uppercase;">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Contact Number</label>
                              <input type="text" class="form-control" ng-model="ph" style=" text-transform: uppercase;">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Address</label>
                              <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                 ng-model="address"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="formGroupExampleInput">Report</label>
                              <textarea class="form-control" type="text" id="exampleFormControlTextarea1"
                                 ng-model="report"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal"
                        ng-click="donor_update()">Update</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- End of Blood Donor section -->
      </div>
      <script>
         function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
               tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
               tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
         }
      </script>
      <script>
         function validateTextInput(event) {
            const input = event.target.value;
            const pattern = /^[A-Za-z\s]+$/; // Regular expression to match only text and spaces
            const errorMessage = document.getElementById("errorMessage");

            if (!pattern.test(input)) {
               errorMessage.style.display = "block";
               event.target.value = ""; // Clear the input field if it contains any invalid characters
            } else {
               errorMessage.style.display = "none";
            }
         }
      </script>
      <!-- Bootstrap JS (optional if you need dropdowns, modals, etc.) -->
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