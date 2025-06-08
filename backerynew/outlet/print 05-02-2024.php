<?php
require("fpdf182/fpdf.php");
$javascript = <<<JS
<script type="text/javascript">
    function printAndClose() {
        window.print();
        window.close();
    }
</script>
JS;
//$con=mysqli_connect("localhost","root","","backery") or die(mysqli_error($con));
$con=new mysqli("localhost","fortheye_admin","Soft@2017","fortheye_backery");
$invno=$_GET['invno'];
//$invno='INV/23-24/66';
$pdf = new FPDF ('P','mm',array(80,170));
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,8,'Celebration Indians Cake Shop',1,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,'Agartala Tripura(West)',0,1,'C');
$pdf->Cell(60,5,'Contact : +91-8415822519',0,1,'C');
// Set the line width and color
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(0, 0, 0);

// *** Collect some to data into table *** 
$sql="select invdate,name,ph from sales_master where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $invdate=$row['invdate'];
 $name=$row['name'];
 $ph=$row['ph'];
}

// Draw a horizontal line at the current position
$pdf->Line(1, 30, 100, 30);
$pdf->Ln(5);

// Set the invoice number on the left side of the page
$pdf->Cell(10, 6, 'Inv: '.$invno, 0, 0);

// Set the bill to information on the right side of the page
$pdf->Cell(50, 6, 'Bill To: '.$name, 0, 1, 'R');

$pdf->Cell(50, 6, 'Date: '.$invdate, 0, 2);

$pdf->SetX(10);
$pdf->SetFont('Courier','B',6);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(34,5,'PRODUCT',1,0,'C'); //100
$pdf->Cell(11,5,'QTY',1,0,'C');
$pdf->Cell(8,5,'PRC',1,0,'C');
$pdf->Cell(12,5,'TOTAL',1,1,'C');

$sql="select * from sales where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($res))
{
 $pdf->SetX(10);   
 $pdf->SetFont('Helvetica','B',5);
 $pdf->Cell(34,5,$row['product'],1,0,'C'); //100
 //$pdf->Cell(34, 'auto', $row['product'], 1, 0, 'C');
 // Calculate the height required for the text
//$textHeight = $pdf->GetStringHeight(34, $row['product']);

// Set the height of the cell dynamically
//$pdf->Cell(34, $textHeight, $row['product'], 1, 0, 'C');
 $pdf->Cell(11,5,$row['qty'],1,0,'C');
 $pdf->Cell(8,5,$row['rate'],1,0,'C');
 $pdf->Cell(12,5,$row['total'],1,1,'C');
}

$sql="select sum(total) gtotal from sales where sinv='".$invno."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_assoc($res))
{
 $gtoal=$row['gtotal'];
}

$pdf->SetX(10);
$pdf->SetFont('courier','B',8);
$pdf->Cell(20,5,'',0,0,'L'); //100
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,5,'Grand Total',1,0,'C');
$pdf->Cell(20,5,$gtoal,1,1,'C');

$pdf->Cell(20,5,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(65,5,'Thankyou for choosing',0,1,'C');//100


$pdf->SetX(3);
$pdf->SetFont('Courier','B',12);
$pdf->Cell(75,5,'Celebration Indians Cake Shop',0,1,'C');



$pdf->SetX(3);
$pdf->SetFont('Courier','B',12);
$pdf->Cell(75,5,"Hope you liked it",0,1,'C');

$pdf->SetX(7);
$pdf->Cell(20,7,'-------------------------',0,1,'');




$pdf->SetX(7);
$pdf->SetFont('Courier','BI',8);
$pdf->Cell(75,3,'Powered By : Software World',0,1,'');


$pdf->SetX(7);
$pdf->SetFont('Courier','BI',8);
$pdf->Cell(75,3,'Contact at : +91-7005261744',0,1,'');
$pdf->Output();
?>