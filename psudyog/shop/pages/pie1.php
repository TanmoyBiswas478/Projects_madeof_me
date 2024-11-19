<?php
header("Content-Security-Policy: frame-ancestors 'self' *"); 
session_start();
include '../../assets2/api/connect.php';

// Retrieve purchase total
$sql_purchase = "SELECT SUM(total) AS purchase_total FROM purchase_master";
$result_purchase = mysqli_query($con, $sql_purchase) or die(mysqli_error($con));
$row_purchase = mysqli_fetch_assoc($result_purchase);
$purchase_total = $row_purchase['purchase_total'];

// Retrieve sales total
$sql_sales = "SELECT SUM(total) AS sales_total FROM sales_master";
$result_sales = mysqli_query($con, $sql_sales) or die(mysqli_error($con));
$row_sales = mysqli_fetch_assoc($result_sales);
$sales_total = $row_sales['sales_total'];

// Calculate profit
$profit = $sales_total - $purchase_total;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Category', 'Total'],
        ['Purchase', <?php echo $purchase_total; ?>],
        ['Sales', <?php echo $sales_total; ?>],
        ['Profit', <?php echo $profit; ?>]
    ]);

    var options = {
        title: 'Purchase, Sales, and Profit',
        bar: { groupWidth: '100%' },
        chartArea: {width:600, height: 250},
        legend: { position: 'labeled'},
        pieStartAngle: 100,
        pieSliceTextStyle: { fontSize:16 },
        is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart_3d" style="width: 100%; height: 360px;"></div>
</body>
</html>
