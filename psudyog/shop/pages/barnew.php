<?php
//$con = mysqli_connect("localhost", "root", "", "salessoft") or die(mysqli_error($con));
$con=new mysqli("localhost","software_admin","Soft@2017","software_salessoft");

// Retrieve distinct financial years dynamically
$sql = "SELECT DISTINCT(fy) fy FROM purchase_master order by fy ASC;";
$res = mysqli_query($con, $sql) or die(mysqli_error($con));

// Initialize arrays to store financial year labels and corresponding data
$client = [];
$tw = [];
$pw=[];

while ($row = mysqli_fetch_array($res)) {
    $client[] = "'" . $row['fy'] . "'"; // Add financial year label to the array
    $sql = "SELECT SUM(`total`) total FROM `purchase_master` WHERE fy='" . $row['fy'] . "'";
    $res2 = mysqli_query($con, $sql) or die(mysqli_error($con));
    $total = mysqli_fetch_array($res2)['total'];
    $tw[] = $total; // Add total purchase data to the array

    $sql = "SELECT SUM(`total`) total FROM `sales_master` WHERE fy='" . $row['fy'] . "'";
    $res2 = mysqli_query($con, $sql) or die(mysqli_error($con));
    $total = mysqli_fetch_array($res2)['total'];
    $pw[] = $total; // Add total purchase data to the array
}



// Convert arrays to strings for JavaScript use
$client = implode(",", $client);
$tw = implode(",", $tw);
$pw=implode(",", $pw);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>3D column with stacking and grouping</title>
    <!-- Your other HTML head content here -->

    <!-- Include Highcharts and related modules -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
    <!-- Your HTML body content here -->

    <figure class="highcharts-figure">
        <div id="categorywisecnt"></div>
        <p class="highcharts-description"></p>
    </figure>

    <script type="text/javascript">
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
                text: 'Graphical Report of Purchase & Sales year wise'
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: [<?php echo $client; ?>],
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
                    text: '',
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
                name: 'Total Purchase',
                data: [<?php echo $tw; ?>],
                stack: 'male'
            }, {
                name: 'Total Sales',
                data: [<?php echo $pw; ?>], // You need to retrieve and set $pw dynamically as well
                stack: 'female'
            }]
        });
    </script>
</body>
</html>
