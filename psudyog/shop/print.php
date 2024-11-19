<?php 
session_start();
include '../assets2/api/connect.php';
$sinv=$_GET['invno'];
$sql="select * from shop where sname='".$_SESSION['sname']."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $gst=$row['gstno'];
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
 $ttax=$row['tax'];
 $cgsta=$row['cgsta'];
 $sgsta=$row['sgsta'];
 $igsta=$row['igsta'];
 $total=$row['total'];
 $tmode=$row['tmode'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $sname; ?></title>
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
<td valign="top" width="13%" height="40"><?php echo $gst;?></td>
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
  <table width="100%" cellpadding="0" cellspacing="0"  border="2" style="font-size:13.5px;">
  <thead>
  <tr>
  <th width="5%" rowspan="2" class="text-center" height="40">Sl No</th>
  <th width="20%" rowspan="2" class="text-center">Description of Good</th>
  
  <th width="5%" rowspan="2" class="text-center">HSN</th>
  <th width="5%" rowspan="2" class="text-center">Qty</th>
  <th width="5%" rowspan="2" class="text-center">Unit</th>
  <th width="8%" rowspan="2" class="text-center">Rate</th>
  
  <th width="10%" rowspan="2" class="text-center">Taxable Pay</th>
  <th width="10%" colspan="2" class="text-center">CGST</th>
  <th width="10%" colspan="2" class="text-center">SGST</th>
  <th width="10%" colspan="2" class="text-center">IGST</th>
  <th width="10%" rowspan="2" class="text-center">Total Amt</th>
  <tr>
  <th width="6%" class="text-center" height="40">%</th>
  <th width="6%" class="text-center">Amt</th>
  <th width="6%" class="text-center">%</th>
  <th width="6%" class="text-center">Amt</th>
  <th width="6%" class="text-center">%</th>
  <th width="6%" class="text-center">Amt</th>
  </tr>
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
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $i;
	 echo "</b></td>";
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
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['product'];
	 echo "</b></td>";
	 echo "</tr>";
	 
	}
	?>
	</table>	</td>
	
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['hsn'];
	 echo "</b></td>";
	 echo "</tr>";
	 
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['qty'];
	 echo "</b></td>";
	 echo "</tr>";
	  
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td >";
	 echo $row['unit'];
	 echo "</td>";
	 echo "</tr>";
	}
	?>
	</table>	</td>
    
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['rate'];
	 echo "</b></td>";
	 echo "</tr>";
	  
	}
	?>
	</table>	</td>

	
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['tax'];
	 echo "</b></td>";
	 echo "</tr>";
	  
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['cgst']."%";
	 echo "</b></td>";
	 echo "</tr>";
	 
	}
	?>
	</table>	</td>
	
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['cgstp'];
	 echo "</b></td>";
	 echo "</tr>";
	 
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['sgst']."%";
	 echo "</b></td>";
	 echo "</tr>";
	 
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['sgstp'];
	 echo "</b></td>";
	 echo "</tr>";
	  
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['igst']."%";
	 echo "</b></td>";
	 echo "</tr>";
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['igstp'];
	 echo "</b></td>";
	 echo "</tr>";
	}
	?>
	</table>	</td>
    <td class="text-center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0" class="table-borderless">
	<?php 
	$sql="select * from sales where sinv='".$sinv."'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
	 echo "<tr>";
	 echo "<td style='height:40px;word-wrap: break-word;'><b>";
	 echo $row['total'].".00";
	 echo "</b></td>";
	 echo "</tr>";
	}
	?>
	</table>	</td>
  </tr>
  <tr>
    <th class="text-right" colspan="6" height="30">Grand Total:</th>
    <th class="text-center">
	<?php echo $ttax; ?>	</th>
    <th class="text-center" colspan="2">
	<?php echo $cgsta; ?>	</th>
    <th class="text-center" colspan="2">
	<?php echo $sgsta; ?>	</th>
    <th class="text-center" colspan="2">
	<?php echo $igsta; ?>	</th>
    <th class="text-center">
	<?php echo $total.".00"; ?>	</th>
   </tr>
  </thead>
  </table>
  </td>
</tr>
<tr>
  <td valign="top" height="40">
  <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;">
  <tr>
    <td valign="middle" height="40">&nbsp;</td>
    <td valign="middle" height="40">&nbsp;</td>
  </tr>
  <tr>
  <td valign="middle" width="80%" height="40">
  Mode of Payment: <?php echo $tmode; ?>  </td>
  <td valign="middle" width="20%" height="40">
  For <span class="text26"><?php echo $sname;?> </span> </td>
  </tr>
  <tr>
    <td valign="bottom" height="60" colspan="2"><strong>Terms & Condition</strong>
    <ul>
    	<li>Product once sold will not be returned or exchanged under any circumstance.
        <li>Please visit nearby Authorised Service centre  in case of DOA for authorization and
replacement within 7 days of purchase.</li>
<li>Keep a copy of this invoice to claim any future serve on the product at your service centres.</li>
<li>In case of TV , purchased unpacking will be done  by a service engineer and if any dispute arise than it will be provided to the company and a lead time is needed to execute the process !!</li>
    </ul>
    </td>
  </tr>
  <tr>
    <td valign="bottom" height="60" colspan="2" class="text-center">
     <b>This is Computer Generate Invoice & Doesnot require any Signature</b>
    </td>
  </tr>
  </table>
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
<?php mysqli_close($con); ?>