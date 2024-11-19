<?php 
$con=mysqli_connect("localhost","root","","nielit_oes");
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Total'],
          <?php
          $sql1= "SELECT * FROM students_details WHERE `Course_type_code`='Q' and category='SC'";
          $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
          $sc=mysqli_num_rows($result1);

          $sql1= "SELECT * FROM students_details WHERE `Course_type_code`='Q' and category='ST'";
          $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
          $st=mysqli_num_rows($result1);

          $sql1= "SELECT * FROM students_details WHERE `Course_type_code`='Q' and category='GEN'";
          $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
          $gen=mysqli_num_rows($result1);

          $sql1= "SELECT * FROM students_details WHERE `Course_type_code`='Q' and category='OBC'";
          $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
          $obc=mysqli_num_rows($result1);

          echo "['SC',".$sc."],";
          echo "['ST',".$st."],";
          echo "['GEN',".$gen."],";
          echo "['OBC',".$obc."]";
          ?>
          
          
        ]);

        var options = {
          title: 'Category wise Details Section',
          pieHole: 0.2,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 100%; height: 400px;"></div>
  </body>
</html>