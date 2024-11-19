<?php 
session_start();
include '../assets2/api/connect.php';
$sinv='MNLS/23-24/1';
$sql="select * from shop where sname='M/s GHOSH ENTERPRISE'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $gstno=$row['gstno'];
 $phone=$row['phone'];
 $sname=$row['sname'];
 $address=$row['address'];
}

$sql="select * from sales_master where sinv='".$sinv."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $invdate=$row['invdate'];
 $name=$row['name'];
 $ph=$row['ph'];
 $gstno=$row['gstno'];
 $add='NA';

}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $vsname; ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div id="print">
<div class="container">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td valign="top" width="100%" height="40">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td valign="top" width="8%" height="40">GST No </td>
<td valign="top" width="13%" height="40"><?php echo $gstno;?></td>
<td valign="top" width="57%" height="40" class="text-center"><strong>Invoice</strong></td>
<td valign="top" width="8%" height="40">Phone No: </td>
<td valign="top" width="14%" height="40"><?php echo '+91-'.$phone; ?></td>
</tr>
</table></td>
</tr>
<tr>
  <td valign="bottom" height="20" class="text-center">
  <h3><?php echo $sname; ?></h3>  </td>
</tr>
<tr>
  <td valign="top" height="25" class="text-center">
  <h5><?php echo $address; ?></h5>  </td>
</tr>
<tr>
  <td valign="top" height="40">
  <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;">
  <tr>
  <td valign="middle" width="15%" height="40"><strong>Invoice No:</strong> </td>
  <td valign="middle" width="35%" height="40">
  <?php echo $sinv; ?>
  </td>
  <td valign="middle" width="15%" height="40"><strong>Date of Invoice:</strong> </td>
  <td valign="middle" width="35%" height="40">
  <?php echo $invdate; ?>
  </td>
  </tr>
  <tr>
    <td valign="middle" height="40"><span class="text"><strong>Buyer's Name: </strong></span></td>
    <td valign="middle" height="40">
	<?php echo $name; ?>
	</td>
    <td valign="middle" height="40"><span class="text"><strong>Mobile:</strong></span></td>
    <td valign="middle" height="40">
	<?php echo $ph; ?>
	</td>
  </tr>
  <tr>
    <td valign="middle" height="40"><span class="text"><strong>Buyer's Address: </strong></span></td>
    <td valign="middle" height="40"><?php echo $add; ?></td>
    <td valign="middle" height="40"><span class="text"><strong>Customer GSTIN: </strong></span></td>
    <td valign="middle" height="40"><?php echo $gstno; ?></td>
  </tr>
  </table>
  </td>
</tr>
<tr>
  <td valign="top" height="40">
  <table width="100%" cellpadding="0" cellspacing="0" class="table-bordered" style="font-size:15px;">
  <thead>
  <tr><th width="3%" rowspan="2" class="text-center" height="40">Sl No</th>
  <th width="15%" rowspan="2" class="text-center">Description of Service</th>
  <th width="10%" rowspan="2" class="text-center">HSN Code</th>
  <th width="5%" rowspan="2" class="text-center">Qty</th>
  <th width="5%" rowspan="2" class="text-center">Unit</th>
  <th width="8%" rowspan="2" class="text-center">Rate</th>
  <!-- <th width="5%" rowspan="2" class="text-center">Disc %</th>
  <th width="8%" rowspan="2" class="text-center">Disc Amount</th> -->
  <th width="8%" rowspan="2" class="text-center">Taxable Pay</th>
  <th width="8%" colspan="2" class="text-center">CGST</th>
  <th width="8%" colspan="2" class="text-center">SGST</th>
  <th width="8%" colspan="2" class="text-center">IGST</th>
  <th width="10%" rowspan="2" class="text-center">Total Amt</th>
  </tr>
  </thead>
  <tbody>
  
  <tr>
    <th class="text-center" height="800" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$n=mysqli_num_rows($result);
	for($i=1;$i<=$n;$i++)
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $i;
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</th>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['product'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
   <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['hsn'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['qty'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['unit'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['rate'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
       
 <td class="text-center" valign="top">
 <table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['tax'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
<!--    <td class="text-center" valign="top">-->
<!--	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['cgst']."%";
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
<!--	</table>-->
<!--	</td>-->
 <!--   <td class="text-center" valign="top">-->
	<!--<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
	<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['cgstp'];
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
	<!--</table>-->
	<!--</td>-->
 <!--   <td class="text-center" valign="top">-->
	<!--<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
	<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['sgst']."%";
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
	<!--</table>-->
	<!--</td>-->
 <!--   <td class="text-center" valign="top">-->
	<!--<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
	<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['sgstp'];
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
	<!--</table>-->
	<!--</td>-->
 <!--   <td class="text-center" valign="top">-->
	<!--<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
	<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['igst']."%";
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
	<!--</table>-->
	<!--</td>-->
 <!--   <td class="text-center" valign="top">-->
	<!--<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">-->
	<?php 
// 	$sql="select * from sales where sinv='".$sinv."'";
// 	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
// 	while($row=mysqli_fetch_array($result))
// 	{
// 	 echo "<tr>";
// 	 echo "<td height=40>";
// 	 echo $row['igstp'];
// 	 echo "</td>";
// 	 echo "</tr>";
// 	}
	?>
	<!--</table>-->
	<!--</td>-->
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td height=40>";
	 echo $row['total'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>
	</td>
  </tr>
  <tr>
   
    <th class="text-right" colspan="5">Grand Total:</th>
    
    <th class="text-center">
	<?php echo $total; ?>
	</th>
    
   </tr>
  </tbody>
  </table>
  </td>
</tr>
<tr>
  <td valign="middle" height="100">
  <!--table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;">
  <tr>
    <td valign="middle" height="40">&nbsp;</td>
    <td valign="middle" height="40">&nbsp;</td>
  </tr>
  <tr>
  <td valign="middle" width="50%" height="40">
  Mode of Payment: cash/Cheque/Debit Card/Credit Card  </td>
  <td valign="middle" width="50%" height="40" class="text-right">
  For <?php echo $vsname; ?>  </td>
  </tr>
  <tr>
    <td valign="bottom" height="60"><span class="text">Customer Signature</span></td>
    <td valign="bottom" height="60" class="text-right">Authorised Signature </td>
  </tr>
  </table-->
  <center>This is Computer Generated Bill No Signature Required</center>
  </td>
</tr>
<tr>
  <td valign="top" height="40"></td>
</tr>
<tr>
  <td valign="top" height="40"></td>
</tr>
</table>
</div>
</div>
<center>
<input type="button" class="btn btn-info" value="Print" onClick="printDiv('print')">
</center>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
	 window.location='sales.php';
}
</script>