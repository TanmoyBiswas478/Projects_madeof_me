<?php
$con=mysqli_connect("localhost","root","","backery") or die(mysqli_error($con));
$string="";
$sql="select shop from shop";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res))
{
 $string=$string."'".$row['shop']."',";
}               
$client=substr($string, 0, -1);


$string1="";
$sql="SELECT sum(`total`) total FROM `sales_master` WHERE `shop`='Mobile Service Center'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res))
{
 $string1=$string1.$row['total'].",";
}               
$tw=substr($string1, 0, -1); 

$string2="";
               $sql="SELECT sum(`total`) total FROM `sales_master` WHERE `shop`='Rajput Solution'";
               $res=mysqli_query($con,$sql) or die(mysqli_error($con));
               while($row=mysqli_fetch_array($res))
               {
                $string2=$string2.$row['total'].",";
               }               
               $pw=substr($string2, 0, -1); 



?>


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
        categories: [<?php echo $client;?>],
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
            text: 'No. of Works',
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
        name: 'Mobile Service Center',
        data: [<?php echo $tw;?>],
        stack: 'male'
    }, {
        name: 'Rajput Solution',
        data: [<?php echo $pw;?>],
        stack: 'female'
    }]
});



  //]]></script>

 

</body>
</html>

