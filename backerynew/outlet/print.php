<?php 
include '../assets/api/connect.php';
//$invno=$_GET['invno'];
$invno='INV/23-24/117';
$sql="select sinv,invdate,name,tmode,user,TIME(doe) AS timed from sales_master where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res)){
  $sinv=$row['sinv'];
  $invdate=$row['invdate'];
  $name=$row['name'];
  $user=$row['user'];
  $timed=$row['timed'];
  $timed=date("h:i A", strtotime($timed));
  $invdate=date("d-m-Y", strtotime($invdate));
  $tmode=$row['tmode'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thermal Printer Invoice</title>
  <style>
    @font-face {
      font-family: BarcodeFont;
      src: url('path/to/barcode-font.ttf'); /* Replace with the path to your barcode font */
    }
    body {
      font-family: Arial, sans-serif;
      font-size: 8.5px;
    }
    .container {
      width: 4in; /* Set width to 4 inches */
      margin: 0 auto;
    }
    .header {
      text-align: center;
      margin-bottom: 10px;
    }
    .logo {
      max-width: 100px; /* Adjust the logo size */
      margin-bottom: 5px;
    }
    .company-info {
      text-align: center;
    }
    table {
      width: 95%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }
    th, td {
      border: 1px solid #000;
      padding: 5px;
      text-align: left;
    }
    tfoot td {
      border-top: 1px solid #000;
      font-weight: bold;
    }
    .footer {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="../logo.png" alt="Company Logo" class="logo">
      <div class="company-info">
        <p><b>Celebration Indians Cake Shop<br>
        MADHYA BANAMALIPUR, NEAR LALBAHADUR CLUB,<br>
        AGARTALA, TRIPURA - 799001<br>FSSAI NO. 22520051000097(outlet of CFI)<br>
        GSTIN NO: 16BEDPD6471G1ZO
        </b></p>
        <!-- <p>Address Line 2</p>
        <p>Phone: XXX-XXX-XXXX</p> -->
      </div>
      <h2>Invoice</h2>
    </div>
    <div class="invoice-info">
  <div style="display: flex; padding-bottom: 5px;">
    <div style="flex: 3;"><b>PAYMENT MODE:</b></div>
    <div style="flex: 2;"><?php echo $tmode;?></div>
    <div style="flex: 1;"><b>DATE:</b></div>
    <div style="flex: 3;"><?php echo $invdate; ?></div>
  </div>
  
  
  <div style="display: flex; padding-bottom: 5px;">
    <div style="flex: 3;"><b>Bill No:</b></div>
    <div style="flex: 2;"><?php echo $sinv; ?></div>
    <div style="flex: 1;"><b>Time</b></div>
    <div style="flex: 3;"><?php echo $timed;?></div>
  </div>

  <div style="display: flex; padding-bottom: 5px;">
    <div style="flex: 3;"><b>User:</b></div>
    <div style="flex: 2;"><?php echo $user;?></div>
    <div style="flex: 1;"></div>
    <div style="flex: 3;"></div>
  </div>
  
</div>

    <table>
      <thead>
        <tr>
          <th style="text-align: center;">Sl</th>
          <th style="text-align: center;">Item</th>
          <th style="text-align: center;">Qty</th>
          <th style="text-align: center;">Price</th>
          <th style="text-align: center;">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $x=1;
        $sql1="select product,qty,unit,rate,tax from sales where sinv='".$invno."'";
        $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));
        while($row=mysqli_fetch_assoc($res1))
        {
         echo "<tr>";
         echo "<td style='text-align: center;'>".$x."</td>";
         echo "<td>".$row['product']."</td>";
         echo "<td>".$row['qty']." ".$row['unit']."</td>";
         echo "<td style='text-align:right;'>&#8377;".$row['rate']."</td>";
         echo "<td style='text-align:right;'>&#8377;".$row['tax']."</td>";
         echo "</tr>";
         $x=$x+1;
        }
        $sql1="select sum(tax) subtotal from sales where sinv='".$invno."'";
        $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));
        while($row=mysqli_fetch_assoc($res1))
        {
          $subtotal=$row['subtotal'];
        }
       ?>
       
        
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">Subtotal</td>
          <td style="text-align:right;">&#8377;<?php echo $subtotal;?></td>
        </tr>
      </tfoot>
    </table>
    
    
    <h5>Tax Breakup</h5>


 <table>
      <thead>
        <tr>
          <th style="text-align: center;">CGST%</th>
          <th style="text-align: center;">CGST Amt</th>
          <th style="text-align: center;">SGST%</th>
          <th style="text-align: center;">SGST Amt</th>
          <th style="text-align: center;">Total GST</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $y=0;
        $sql2="SELECT SUM(cgstp) AS total_cgst, cgst AS cgst_percent, SUM(sgstp) AS total_sgst, sgst AS sgst_percent, SUM(cgstp) + SUM(sgstp) AS total_gst FROM sales WHERE sinv = '".$invno."' GROUP BY cgst, sgst";
        $res2=mysqli_query($con,$sql2) or die(mysqli_error($con));
        while($row=mysqli_fetch_assoc($res2))
        {
         echo "<tr>";
         echo "<td style='text-align: center;'>".$row['cgst_percent']."%</td>";
         echo "<td style='text-align: right;'>&#8377;".$row['total_cgst']."</td>";
         echo "<td style='text-align: center;'>".$row['cgst_percent']."%</td>";
         echo "<td style='text-align: right;'>&#8377;".$row['total_cgst']."</td>";
         echo "<td style='text-align:right;'>&#8377;".$row['total_gst']."</td>";
         echo "</tr>";
         $y=$y+$row['total_gst'];
        }
        ?>
      </tbody>
      <tfoot>
      <tr>
          <td colspan="4">Grand Total</td>
          <td style="text-align:right;" id="totalAmount">&#8377;<?php echo round($y+$subtotal);?>.00</td>
        </tr>
      <tr>
          <td colspan="5" id="totalInWords" style="text-transform: capitalize !important; text-align: center;"></td> <!-- Placeholder for total amount in words -->
        </tr>
        <tfoot>
    </table>


    <div class="footer">
      <p>Thanking you for choosing<br>
CELEBRATION INDIAN'S CAKE SHOP<br>
Customer Query Contact: +91-9233823192<br>
website: www.celebrationfoods.co.in
</p>
    </div>
  </div>

  <script>
  
    // This function prints the content of the page when called
    function printPage() {
      window.print(); // This triggers the browser's print functionality
    }

    // Call the printPage function when the page is loaded
    window.onload = function() {
      printPage();
      setTimeout(convertToPDF, 2000); // Delay PDF conversion to ensure content is fully loaded
    };

    // Function to convert HTML to PDF
    function convertToPDF() {
      const doc = new jsPDF(); // Create a new jsPDF instance
      const html = document.querySelector('html'); // Select the HTML element
      doc.html(html, {
        callback: function (doc) {
          doc.save('invoice.pdf'); // Save the PDF with the filename 'invoice.pdf'
        }
      });
    }

    // Call the printPage function when the page is loaded
    window.onload = printPage;
  
    // Function to convert number to words
    function numberToWords(number) {
      const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
      const tens = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
      const teens = ['', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

      let numStr = '';

      if (number === 0) {
        return 'zero';
      }

      if (number >= 1000) {
        numStr += numberToWords(Math.floor(number / 1000)) + ' thousand ';
        number %= 1000;
      }

      if (number >= 100) {
        numStr += ones[Math.floor(number / 100)] + ' hundred ';
        number %= 100;
      }

      if (number >= 20) {
        numStr += tens[Math.floor(number / 10)] + ' ';
        number %= 10;
      }

      if (number > 0) {
        if (number < 10) {
          numStr += ones[number];
        } else {
          numStr += teens[number - 10];
        }
      }

      return numStr;
    }

    // Convert total amount to words and display
    const totalAmountElement = document.getElementById('totalAmount');
    const totalInWordsElement = document.getElementById('totalInWords');
    const totalAmount = parseFloat(totalAmountElement.innerText.replace('₹', '')); // Extract numeric value

    totalInWordsElement.innerText = 'Total in words: ' + numberToWords(totalAmount) + ' rupees only';
  </script>
</body>
</html>
