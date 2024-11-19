<?php 
session_start();
if(empty($_SESSION['type']))
{
 echo "<script>alert('Sorry Userid and Password Mismatch');</script>";
 echo "<script>window.location.href='../index.html';</script>";
}
include '../assets/api/connect.php';
$tname="%".$_GET['tname']."%";
?>

<!doctype html>
<html lang="en">
<head>
<title>Training Registration Portal</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fw/css/all.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #774081 !important;">
    <a class="navbar-brand" href="#" style="color: #fff !important;">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php" style="color: #fff !important;">View All Registration <span
              class="sr-only">(current)</span></a>
        </li>
        <!-- <li class="nav-item">
              <a class="nav-link" href="#">Download Course Data</a>
            </li> -->
        <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->

      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->

    </div>
  </nav>

  
  <div class="table-responsive" style="padding: 20px; !important">
    <table class="table table-bordered">
      <thead>
        <tr style="background: #774081 !important; color: #fff !important;">
         <td>#</td>
         <td>Institute Name</td>
         <td>Department Name</td>
         <td>Year of Student</td>
         <td>Training Name</td>
         <td>Name</td>
         <td>Father's Name</td>
         <td>Mother's Name</td> 
         <td>Aadhaar No</td>
         <td>Whatsapp No</td>
         <td>Contact No</td>
         <td>email</td>
         <td>Gender</td>
         <td>Caste</td> 
         <td>Image</td>
         <td>Signature</td>
         <td>Thumb</td>
         <td>Aadhaar</td>
         <td>PRTC</td>
         <td>Caste Docs</td>
        </tr>
      </thead>
      <tbody>
        <?php 
        $x=1;
        $sql="select * from reg where tname like '".$tname."'";
        $res=mysqli_query($con,$sql) or die(mysqli_error($con));
        while($row=mysqli_fetch_assoc($res))
        {
          echo "<tr>";
          echo "<td class='text-center'>".$x."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['iname']."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['dept']."</td>";
          echo "<td>".$row['year']."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['tname']."</td>";
          echo "<td style='text-transform: uppercase;'>".$row['name']."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['fname']."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['mname']."</td>";
          echo "<td>".$row['aadhaar']."</td>";
          echo "<td>".$row['wph']."</td>";
          echo "<td>".$row['ph']."</td>";
          echo "<td style='text-transform: lowercase;'>".$row['email']."</td>";
          echo "<td style='text-transform: capitalize;'>".$row['gender']."</td>";
          echo "<td style='text-transform: uppercase;'>".$row['cast']."</td>";
          echo "<td class='text-center''><img src=../img/".$row['img']." width='50' height='50'></td>";
          echo "<td class='text-center'><img src=../sig/".$row['sig']." width='30' height='40'></td>";
          echo "<td class='text-center''><img src=../thumb/".$row['thumb']." width='50' height='50'></td>";
          echo "<td class='text-center''><img src=../aadhaar/".$row['aadhaar_img']." width='50' height='50'></td>";
          echo "<td class='text-center'><img src=../prtc/".$row['prtc_img']." width='30' height='40'></td>";
          echo "<td class='text-center''><img src=../cast/".$row['cast_img']." width='50' height='50'></td>";
          echo "</tr>";
          $x=$x+1;
        }
        mysqli_close($con);
        ?>
      </tbody>
    </table>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>
