<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Dummy data
$data = [
    [
        'fi' => '', 'fn' => '', 'sf' => '', 'ai' => '', 'pp' => '', 'ur' => '',
        'denomination' => 'TOTAL APROBADO',
        'personal_services' => '541,094,455', 'operation_expense' => '625,812,596', 'subsidies' => '', 'other_current' => '103,410,317',
        'current_sum' => '1,270,317,368',
        'pensions' => '', 'physical_investment' => '', 'investment_subsidies' => '', 'other_investment' => '', 'investment_sum' => '',
        'total' => '1,270,317,368',
        'percent_current' => '100.0', 'percent_pensions' => '', 'percent_investment' => ''
    ],
    [
        'fi' => '', 'fn' => '', 'sf' => '', 'ai' => '', 'pp' => '', 'ur' => '',
        'denomination' => 'TOTAL MODIFICADO',
        'personal_services' => '541,094,455', 'operation_expense' => '625,812,596', 'subsidies' => '', 'other_current' => '103,410,317',
        'current_sum' => '1,270,317,368',
        'pensions' => '', 'physical_investment' => '', 'investment_subsidies' => '', 'other_investment' => '', 'investment_sum' => '',
        'total' => '1,270,317,368',
        'percent_current' => '100.0', 'percent_pensions' => '', 'percent_investment' => ''
    ],
    [
        'fi' => '1', 'fn' => '', 'sf' => '', 'ai' => '', 'pp' => '', 'ur' => '',
        'denomination' => 'Gobierno',
        'personal_services' => '', 'operation_expense' => '', 'subsidies' => '', 'other_current' => '',
        'current_sum' => '',
        'pensions' => '', 'physical_investment' => '', 'investment_subsidies' => '', 'other_investment' => '', 'investment_sum' => '',
        'total' => '',
        'percent_current' => '', 'percent_pensions' => '', 'percent_investment' => ''
    ],
    [
        'fi' => '', 'fn' => '', 'sf' => '', 'ai' => '', 'pp' => '', 'ur' => '',
        'denomination' => 'Aprobado',
        'personal_services' => '14,236,093', 'operation_expense' => '5,270,532', 'subsidies' => '', 'other_current' => '42,790',
        'current_sum' => '19,549,415',
        'pensions' => '', 'physical_investment' => '', 'investment_subsidies' => '', 'other_investment' => '', 'investment_sum' => '',
        'total' => '19,549,415',
        'percent_current' => '100.0', 'percent_pensions' => '', 'percent_investment' => ''
    ],
];


// Start output buffering to capture the HTML
ob_start();
include 'template_public_account.php';
$html = ob_get_clean();

// Create a new spreadsheet object from the HTML
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($html);

// Get the active sheet
$sheet = $spreadsheet->getActiveSheet();

// Set column widths (approximate values, may need adjustment)
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(5);
$sheet->getColumnDimension('C')->setWidth(5);
$sheet->getColumnDimension('D')->setWidth(5);
$sheet->getColumnDimension('E')->setWidth(5);
$sheet->getColumnDimension('F')->setWidth(5);
$sheet->getColumnDimension('G')->setWidth(40);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(15);
$sheet->getColumnDimension('J')->setWidth(15);
$sheet->getColumnDimension('K')->setWidth(15);
$sheet->getColumnDimension('L')->setWidth(15);
$sheet->getColumnDimension('M')->setWidth(15);
$sheet->getColumnDimension('N')->setWidth(15);
$sheet->getColumnDimension('O')->setWidth(15);
$sheet->getColumnDimension('P')->setWidth(15);
$sheet->getColumnDimension('Q')->setWidth(15);
$sheet->getColumnDimension('R')->setWidth(15);
$sheet->getColumnDimension('S')->setWidth(15);
$sheet->getColumnDimension('T')->setWidth(15);
$sheet->getColumnDimension('U')->setWidth(15);

// Apply styles to the header
$headerStyle = [
    'font' => ['bold' => true, 'size' => 8, 'name' => 'Soberana Sans'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'C09339']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
];
$sheet->getStyle('A8:U9')->applyFromArray($headerStyle);

// Apply styles to the subheader
$subheaderStyle = [
    'font' => ['bold' => true, 'size' => 8, 'name' => 'Soberana Sans'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E6B95B']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
];
$sheet->getStyle('H9:L9')->applyFromArray($subheaderStyle);
$sheet->getStyle('M9:Q9')->applyFromArray($subheaderStyle);
$sheet->getStyle('S9:U9')->applyFromArray($subheaderStyle);


// Apply styles to the body
$bodyStyle = [
    'font' => ['size' => 7, 'name' => 'Soberana Sans'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
];
$sheet->getStyle('A10:U100')->applyFromArray($bodyStyle); // Apply to a large range

// Apply left alignment to the denomination column
$sheet->getStyle('G10:G100')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

// Create a new Xlsx writer
$writer = new Xlsx($spreadsheet);

// Set the headers to force a download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Cuenta_Publica_2024.xlsx"');
header('Cache-Control: max-age=0');

// Write the file to the output
$writer->save('php://output');
exit;
