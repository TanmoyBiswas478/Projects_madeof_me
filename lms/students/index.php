<?php
// session_start();
// if(empty($_SESSION['type']))
// {
//  echo "<script>alert('Sorry Userid and Password Mismatch');</script>";
//  echo "<script>window.location.href='../index.html';</script>";
// }
// ?>
<!doctype html>
<html lang="en">

<head>
<title>LMS Portal</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fw/css/all.css">

    <!-- Angular JS  -->
    <script src="../assets/js/angular.min.js"></script>
    <script src="../assets/js/angular-router.min.js"></script>
    <script src="../assets/js/angular-cookies.min.js"></script>
  </head>
  <body ng-app="myApp" style="background:#D8D8DA !important">

  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #774081 !important;">
    <a class="navbar-brand" href="#" style="color: #fff !important;">Student Dashboard</a>
    <a href="index.php" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php" style="color: #fff !important;"><i class="fa-solid fa-house-chimney"></i> Home <span
              class="sr-only">(current)</span></a>
        </li>

        <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff !important;">
              <i class="fa-solid fa-people-roof"></i> Masters Entry
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#!/role"><i class="fa-solid fa-angles-right"></i> Role Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/location"><i class="fa-solid fa-angles-right"></i> Branch Section</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/staff"><i class="fa-solid fa-angles-right"></i> Staff Entry</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/ttype"><i class="fa-solid fa-angles-right"></i> Training Type</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/training"><i class="fa-solid fa-angles-right"></i> Traning Section</a>
              </div>
          </li>  -->

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="a href=" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff !important;">
              <i class="fa-solid fa-person-chalkboard"></i> Training Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#!/assignment"><i class="fa-solid fa-angles-right"></i> View Assignment</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/materials"><i class="fa-solid fa-angles-right"></i> View Materials</a>
                
              </div>
          </li> 

          <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="a href=" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff !important;">
              <i class="fa-solid fa-comment-dollar"></i> Transtion Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#!/fees"><i class="fa-solid fa-angles-right"></i> Fees Collection</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/pending"><i class="fa-solid fa-angles-right"></i> Fees Pending</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/pending"><i class="fa-solid fa-angles-right"></i> Todays Collection</a>
              </div>
          </li>  -->

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="a href=""" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff !important;">
              <i class="fa-solid fa-chalkboard-user"></i> Examination Section
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#!/upload"><i class="fa-solid fa-angles-right"></i> Upload Assignment</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!/exam"><i class="fa-solid fa-angles-right"></i> Online Examination</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="fa-solid fa-angles-right"></i> Marks Statement</a>
              </div>
          </li> 

          <li class="nav-item dropdown">
              <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="a href='' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false" style="color: #fff !important;">
              <i class="fa-solid fa-circle-info"></i> Details Section
              </a> -->
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="#">Staff Details</a>
                <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#!/fees"><i class="fa-solid fa-angles-right"></i> Fees Details</a>
                <!-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="fa-solid fa-angles-right"></i> Batch Wise Details</a> -->
              </div>
          </li> 

          <li class="nav-item">
              <a class="nav-link" style="color: #fff !important;" href="#!/Payment"><i class="fa-solid fa-indian-rupee-sign"></i> Monthly Payment</a>
         </li>

          
          <li class="nav-item">
              <a class="nav-link" style="color: #fff !important;" href="#!/cp"><i class="fa-solid fa-unlock"></i> Change Password</a>
         </li>

          <!-- <li class="nav-item">
              <a class="nav-link" style="color: #fff !important;" href="../assets/api/logout.php"><i class="fa-solid fa-chart-line"></i> Reports</a>
         </li> -->



        <li class="nav-item">
              <a class="nav-link" style="color: #fff !important;" href="../assets/api/logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </li>
        

      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <a href="" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</a>
          </form> -->

    </div>
  </nav>

  <div ng-view="">
        
      </div>


  


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="controller/main.js"></script>
    <script src="controller/validation.js"></script>
</body>

</html>