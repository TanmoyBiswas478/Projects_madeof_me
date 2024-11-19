<?php
$con=mysqli_connect("localhost","root","","nielit_oes");?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>3D column with stacking and grouping</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style id="compiled-css" type="text/css">
      #categorywisecnt {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    /* EOS */
  </style>

  <script id="insert"></script>


   </head>
<body>
    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="categorywisecnt"></div>
    <p class="highcharts-description">
       
    </p>
</figure>

    <script type="text/javascript">//<![CDATA[


Highcharts.chart('categorywisecnt', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 0,
            beta: 0,
            viewDistance: 45,
            depth: 20
        }
    },

    title: {
        text: ''
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: ['Course Name', 'SC', 'ST', 'GEN', 'OBC'],
        labels: {
            skew3d: true,
            style: {
                fontSize: '14px'
            }
        }
    },

    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'No. of Candidates',
            skew3d: true
        }
    },

    tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}:{point.stackTotal}'
    },

    plotOptions: {
        column: {
            stacking: 'normal',
            depth: 20,
                    dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    series: [{
        name: 'CCTV Camera Equipment Installation, Service and Maintenance',
        data: [
            <?php 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCTV' and category='SC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $sc=mysqli_num_rows($result1); 
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCTV' and category='ST'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $st=mysqli_num_rows($result1);
             
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCTV' and category='GEN'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $gen=mysqli_num_rows($result1);
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCTV' and category='OBC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $obc=mysqli_num_rows($result1);    
            ?>
            ]
            ,
        stack: 'male'
    }, {
        name: 'Cyber Forensic',
        data: [
            <?php 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CECF' and category='SC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $sc=mysqli_num_rows($result1); 
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CECF' and category='ST'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $st=mysqli_num_rows($result1);
             
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CECF' and category='GEN'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $gen=mysqli_num_rows($result1);
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CECF' and category='OBC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $obc=mysqli_num_rows($result1);    
            ?>
            ]
        
        stack: 'female'
    }, {
        name: 'DSP using MATLAB',
        data: [
            <?php 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='DSPM' and category='SC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $sc=mysqli_num_rows($result1); 
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='DSPM' and category='ST'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $st=mysqli_num_rows($result1);
             
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='DSPM' and category='GEN'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $gen=mysqli_num_rows($result1);
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='DSPM' and category='OBC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $obc=mysqli_num_rows($result1);    
            ?>
            ]
        
        stack: 'aaa'
    }, {
        name: 'Installation and Repair of Consumer Electronics Products',
        data: [
            <?php 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCEP' and category='SC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $sc=mysqli_num_rows($result1); 
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCEP' and category='ST'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $st=mysqli_num_rows($result1);
             
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCEP' and category='GEN'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $gen=mysqli_num_rows($result1);
 
             $sql1= "SELECT `course_code` FROM students_details WHERE `Course_type_code`='Q' and gender='Male' and course_code='CCEP' and category='OBC'";
             $result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
             $obc=mysqli_num_rows($result1);    
            ?>
            ]
        stack: 'bbb'
    }]
});



  //]]></script>

 

</body>
</html>

