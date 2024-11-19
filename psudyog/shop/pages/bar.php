<?php 
header("Content-Security-Policy: frame-ancestors 'self' *");
session_start();
include '../../assets2/api/connect.php';

// Fetch month-wise purchase totals
$sql_purchase = "SELECT DATE_FORMAT(invdate, '%M-%Y') AS month_year, SUM(total) AS purchase_total
                 FROM purchase_master
                 GROUP BY DATE_FORMAT(invdate, '%Y-%m')";
$result_purchase = mysqli_query($con, $sql_purchase) or die(mysqli_error($con));

// Fetch month-wise sales totals
$sql_sales = "SELECT DATE_FORMAT(invdate, '%M-%Y') AS month_year, SUM(total) AS sales_total
              FROM sales_master
              GROUP BY DATE_FORMAT(invdate, '%Y-%m')";
$result_sales = mysqli_query($con, $sql_sales) or die(mysqli_error($con));

// Initialize array to hold data
$data = array();
$data[] = ['Month', 'Purchase Total', 'Sales Total'];

// Combine purchase and sales data into a single array
while ($row_purchase = mysqli_fetch_assoc($result_purchase)) {
    $month_year = $row_purchase['month_year'];
    $purchase_total = floatval($row_purchase['purchase_total']);
    
    // Check if there's a corresponding sales total for the same month
    $sql_sales = "SELECT SUM(total) AS sales_total
                  FROM sales_master
                  WHERE DATE_FORMAT(invdate, '%Y-%m') = '$month_year'";
    $result_sales = mysqli_query($con, $sql_sales) or die(mysqli_error($con));
    $row_sales = mysqli_fetch_assoc($result_sales);
    $sales_total = isset($row_sales['sales_total']) ? floatval($row_sales['sales_total']) : 0;

    // Add month, purchase total, and sales total to the data array
    $data[] = [$month_year, $purchase_total, $sales_total];
}

// Convert data array to JSON format
$data_json = json_encode($data);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var data = google.visualization.arrayToDataTable(<?php echo $data_json; ?>);

        var options = {
          title : 'Month-wise Purchase and Sales Totals',
          vAxis: {title: 'Total'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {1: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 400px;"></div>
  </body>
</html>
