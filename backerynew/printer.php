<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    @media print {
      @page {
        size: 3in 11in;
        margin: 0;
      }
      body {
        margin: 0;
        font-size: 10pt;
        line-height: 1.2;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center mb-4">Invoice</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p class="mb-1">Company Name</p>
        <p class="mb-1">Address</p>
        <p class="mb-1">Phone</p>
        <p class="mb-1">Email</p>
        <p class="mb-1">Website</p>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Item 1</td>
              <td>$10.00</td>
              <td>2</td>
              <td>$20.00</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Item 2</td>
              <td>$20.00</td>
              <td>1</td>
              <td>$20.00</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Item 3</td>
              <td>$30.00</td>
              <td>1</td>
              <td>$30.00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 text-right">
        <p class="mb-1">Subtotal: $70.00</p>
      </div>
    </div>
  </div>
</body>
</html>
