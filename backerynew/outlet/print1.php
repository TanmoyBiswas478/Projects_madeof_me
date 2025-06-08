<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Template</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container bill-container">
        <div class="text-center mb-3">
            <img src="path/to/logo.png" alt="Company Logo" class="img-fluid mb-2">
            <h6 class="mb-0">CELEBRATION INDIAN'S CAKE SHOP</h6>
            <small>MADHYA BANAMALIPUR, NEAR LALBAHADUR CLUB, AGARTALA, TRIPURA - 799001</small>
            <p class="mb-1">FSSAI NO. 22520051000097 (outlet of CFI) GSTIN NO: 16BEDPD6471G1ZO</p>
            <h6 class="mb-0">ORDER SLIP</h6>
        </div>
        <div>
            <p><strong>PAYMENT MODE:</strong> CASH/CARD/PHONE</p>
            <p><strong>DATE:</strong> 31.01.2024</p>
            <p><strong>PAY/GPAY/PAYTM</strong></p>
            <p><strong>NAME:</strong></p>
            <p><strong>CONTACT:</strong></p>
            <p><strong>SLIP NO:</strong></p>
            <p><strong>DELIVERY DATE:</strong></p>
            <p><strong>USER:</strong></p>
            <p><strong>DELIVERY TIME:</strong></p>
        </div>
        <div>
            <p><strong>CUSTOMER NOTE:</strong> HAPPY BIRTH DAY PRIYA</p>
            <p><strong>CAKE FLAVOR*:</strong></p>
            <p><strong>FILLING FLAVOR*:</strong></p>
            <p><strong>ICING FLAVOR*:</strong></p>
            <p><strong>SHAPE*:</strong></p>
            <p><strong>PICKUP OR DELIVERY?*:</strong></p>
            <p><strong>REFERENCE PICTURES UPLOAD:</strong></p>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>PRODUCT</th>
                    <th>Weight</th>
                    <th>QTY</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>VANILA CAKE</td>
                    <td>500 gm</td>
                    <td>1</td>
                    <td>350.00</td>
                    <td>350.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>BALLOON 100 PCS</td>
                    <td></td>
                    <td>1</td>
                    <td>100.00</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">SUB TOTAL</td>
                    <td>450.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">DISCOUNT</td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">TOTAL</td>
                    <td>450.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">DELIVERY CHARGE</td>
                    <td>50.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">AMOUNT</td>
                    <td>500.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">ADVANCE PAID</td>
                    <td>200.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">BALANCE DUES</td>
                    <td>300.00</td>
                </tr>
                <tr>
                    <td colspan="6">Total In words: FIVE HUNDRED ONLY</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <p>Thanking you for choosing</p>
            <h6>CELEBRATION INDIAN'S CAKE SHOP</h6>
            <p>Customer Query Contact: 9233823192</p>
            <p>Website: www.celebrationfoods.co.in</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
