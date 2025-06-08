<!doctype html>
<html lang="en">
  <head>
    <title>Celebration Indian's Cake Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/fw/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
     <!-- Angular JS  -->
     <script src="../assets/js/angular.min.js"></script>
     <script src="../assets/js/angular-router.min.js"></script>
     <script src="../assets/js/angular-cookies.min.js"></script>
 
  </head>
  <body ng-app="myApp">
      <!-- Navbar Section  -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">CICS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-people-arrows"></i> Master Entry
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#!/role"><i class="fas fa-angle-double-right"></i> Role Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/shop"><i class="fas fa-angle-double-right"></i> Outlet Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/staff"><i class="fas fa-angle-double-right"></i> Staff Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/vendor"><i class="fas fa-angle-double-right"></i> Vendore Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/item"><i class="fas fa-angle-double-right"></i> Item Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/receipe"><i class="fas fa-angle-double-right"></i> Receipe Entry</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-bookmark"></i> Transaction Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#!/purchase"><i class="fas fa-angle-double-right"></i> Purchase Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/req"><i class="fas fa-angle-double-right"></i> View Requsition</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/staff"><i class="fas fa-angle-double-right"></i> Micilinious Section</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/vendor_pay"><i class="fas fa-angle-double-right"></i> Vendore Payment</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-boxes"></i> Stock Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#!/stock"><i class="fas fa-angle-double-right"></i> Stock View</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/stockexp"><i class="fas fa-angle-double-right"></i> Expairy Stock</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/stocko"><i class="fas fa-angle-double-right"></i> Outletwise Stock</a>
              </div>
            </li>


          

           

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-address-card"></i> Report Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#!/purchaserep"><i class="fas fa-angle-double-right"></i> Purchase Report</a>
                <!-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/requsitionrep"><i class="fas fa-angle-double-right"></i> Requsition Report </a> -->
                <!-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/complete"><i class="fas fa-angle-double-right"></i> Miscellaneous Report</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/salesrep"><i class="fas fa-angle-double-right"></i> Sales Report</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/vendor_ledger"><i class="fas fa-angle-double-right"></i> Vendor Ledger</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/tc"><i class="fas fa-angle-double-right"></i> Collection Report</a>
              </div>
            </li>

            <li class="nav-item">
             <a class="nav-link" href="#"> <i class="fas fa-key"></i> Change Password</a>
            </li>

            <li class="nav-item">
             <a class="nav-link" href="#"> <i class="fas fa-database"></i> Backup DB</a>
            </li>

      
            <li class="nav-item">
             <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
          <!--div class="d-flex">
          <div class="p-2">
            <span style="color:#fff;"><i class="fas fa-user-md"></i> Doctor Name</span>
          </div>
          </div-->

        </div>
      </nav>
      <!-- End of Navbar Section -->

      <div ng-view>





       </div>


      <!-- Footer Section -->
      <!--nav class="navbar fixed-bottom navbar-light bg-light">
        <a target="_blank" href="https://softwareworld.co.in" style="text-align: center !important;">Developed & Hosted by Software World</a>
      </nav-->
      <!-- End of Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Custom scripts for all pages-->
    <script src="controller/main.js"></script>
    <script src="controller/validation.js"></script>
  </body>
</html>