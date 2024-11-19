<?php
ob_start();
session_start();
include "Excel/PHPExcel.php";
include "Excel/PHPExcel/IOFactory.php";

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();

// Get the active sheet
$sheet = $objPHPExcel->getActiveSheet();

// Set cell values
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'Age');
$sheet->setCellValue('C1', 'Email');

// Sample data
$data = [
    ['John Doe', 30, 'john@example.com'],
    ['Jane Smith', 25, 'jane@example.com'],
    ['Mike Johnson', 35, 'mike@example.com']
];

// Populate data
$row = 2;
foreach ($data as $rowData) {
    $column = 'A';
    foreach ($rowData as $cellData) {
        $sheet->setCellValue($column . $row, $cellData);
        $column++;
    }
    $row++;
}

// Create Excel writer object
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

// Set headers to force download the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="example.xlsx"');
header('Cache-Control: max-age=0');

// Write Excel file to output
$objWriter->save('php://output');

// Terminate script
exit;

?>
